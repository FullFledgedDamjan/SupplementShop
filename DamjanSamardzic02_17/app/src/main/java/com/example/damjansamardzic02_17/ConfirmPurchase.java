package com.example.damjansamardzic02_17;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.ItemTouchHelper;
import androidx.recyclerview.widget.LinearLayoutManager;

import android.content.Intent;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.Toast;

import com.basgeekball.awesomevalidation.AwesomeValidation;
import com.basgeekball.awesomevalidation.ValidationStyle;
import com.basgeekball.awesomevalidation.utility.RegexTemplate;
import com.example.damjansamardzic02_17.API.API;
import com.example.damjansamardzic02_17.Adapter.ItemsAdapter2;
import com.example.damjansamardzic02_17.Objects.JsonResponse;
import com.example.damjansamardzic02_17.Objects.Supplement;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.io.Serializable;
import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class ConfirmPurchase extends AppCompatActivity implements AdapterView.OnItemSelectedListener {
    private long backPressedTime;

    private String userId;
    private String isAdmin;
    private Toast backToast;
    private Button purchase;
    private String str;
    AwesomeValidation awesomeValidation;

    ArrayList<Supplement> supplementsList = new ArrayList<>();


    public void onBackPressed() {

        if(backPressedTime+1500>System.currentTimeMillis()){
            backToast.cancel();
            super.onBackPressed();
            return;
        }else{
            backToast=  Toast.makeText(getBaseContext(), "Press back again to exit app",Toast.LENGTH_SHORT);
            backToast.show();
        }
        backPressedTime=System.currentTimeMillis();
    }


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        setContentView(R.layout.activity_confirm_purchase);
        Intent i = getIntent();
        List<Supplement> list=new ArrayList<>();
        list = (List<Supplement>) i.getSerializableExtra("LIST");

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_confirm_purchase);
        userId = getIntent().getStringExtra("EXTRA_SESSION_ID");
        isAdmin = getIntent().getStringExtra("EXTRA_SESSION_ADMIN");
        Spinner spinner=findViewById(R.id.spinner2);
        ArrayAdapter<CharSequence> adapter= ArrayAdapter.createFromResource(this,R.array.payingMethod,android.R.layout.simple_spinner_item);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinner.setAdapter(adapter);
        spinner.setOnItemSelectedListener(this);
data();

        FloatingActionButton floatingActionButton = findViewById(R.id.goBackFloatAdd2);
        floatingActionButton.setOnClickListener(v -> {
            Intent intent1 = new Intent(getBaseContext(), ShoppingCartActivity.class);
            intent1.putExtra("EXTRA_SESSION_ID", userId);
            intent1.putExtra("EXTRA_SESSION_ADMIN", isAdmin);
            startActivity(intent1);
            finish();
        });



        Button btn =(Button) findViewById(R.id.mrs);

        btn.setOnClickListener(v -> {
            awesomeValidation = new AwesomeValidation(ValidationStyle.BASIC);
            awesomeValidation.addValidation(this,R.id.editText2, RegexTemplate.NOT_EMPTY,R.string.invalid_name);
            awesomeValidation.addValidation(this,R.id.editText3, RegexTemplate.NOT_EMPTY,R.string.invalid_surname);
//            awesomeValidation.addValidation(this,R.id.editText4, Patterns.EMAIL_ADDRESS,R.string.Invalid_mail);
            awesomeValidation.addValidation(this,R.id.editText4, RegexTemplate.NOT_EMPTY,R.string.Invalid_mail);
            awesomeValidation.addValidation(this,R.id.editText5, RegexTemplate.NOT_EMPTY,R.string.invalid_code);

            if(awesomeValidation.validate()){

                    if(spinner.getSelectedItemPosition()>0){
                        for(Supplement s1: supplementsList){
                        buy();
                        }

                        //buy();
                        Intent intent = new Intent(getBaseContext(), ShoppingCartActivity.class);
                        intent.putExtra("EXTRA_SESSION_ID", userId);
                        intent.putExtra("EXTRA_SESSION_ADMIN", isAdmin);
                        if(supplementsList.size()>0){
                            Toast.makeText(getApplicationContext(), "Successful purchase",Toast.LENGTH_SHORT).show();
                        }else{
                            Toast.makeText(getApplicationContext(), "Cart is empty",Toast.LENGTH_SHORT).show();
                        }


                        startActivity(intent);

                        finish();
                    }else{
                        Toast.makeText(getApplicationContext(), "Please select your paying method",Toast.LENGTH_SHORT).show();
                    }


            }else{
                Toast.makeText(getApplicationContext(), "Invalid input",Toast.LENGTH_SHORT).show();
            }




        });
    }



    public void data() {
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://192.168.43.222/DamjanSamardzic02_177/api/")
                .addConverterFactory(GsonConverterFactory.create())
                .build();


        API jsonApiSupplements = retrofit.create(API.class);

        Call<List<Supplement>> call = jsonApiSupplements.getSupplementsSold();

        List<Supplement> supList = new ArrayList<>();


        call.enqueue(new Callback<List<Supplement>>() {
            @Override
            public void onResponse(Call<List<Supplement>> call, Response<List<Supplement>> response) {
                if(!response.isSuccessful()){
                    Toast toast = Toast.makeText(getApplicationContext(),
                            "k",
                            Toast.LENGTH_SHORT);
                    toast.show();
                    return;
                }
                List<Supplement> supplements = response.body();
//                ArrayList<Supplement> supplementsList = new ArrayList<>();

                for(Supplement s: supplements){
                    if(s.getUser()==Integer.parseInt(userId)){
                        supplementsList.add(s);
//                        str=s.getName();
                    }
                }



            }

            @Override
            public void onFailure(Call<List<Supplement>> call, Throwable t) {
                Toast toast = Toast.makeText(getApplicationContext(),
                        "not k",
                        Toast.LENGTH_SHORT);
                toast.show();
            }
        });


    }



    public void buy() {
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://192.168.43.222/DamjanSamardzic02_177/api/supplement/")
                .addConverterFactory(GsonConverterFactory.create())
                .build();

        API jsonApiManu = retrofit.create(API.class);


        for(Supplement s1: supplementsList){
            //s=s1.getName();
            str=supplementsList.size()+"";
            Call<JsonResponse> call = jsonApiManu.deleteSupplement(s1.getName());
            call.enqueue(new Callback<JsonResponse>() {
                @Override
                public void onResponse(Call<JsonResponse> call, Response<JsonResponse> response) {
                    if (!response.isSuccessful()) {
                        Toast toast = Toast.makeText(getApplicationContext(),
                                response.code(),
                                Toast.LENGTH_SHORT);
                        toast.show();
                        return;
                    }

                    JsonResponse responseJ = response.body();

                    Toast toast = Toast.makeText(getApplicationContext(),
                            responseJ.getMessage(),
                            Toast.LENGTH_SHORT);
                    toast.show();
                }

                @Override
                public void onFailure(Call<JsonResponse> call, Throwable t) {
                    Toast toast = Toast.makeText(getApplicationContext(),
                            "Failure",
                            Toast.LENGTH_SHORT);
                    toast.show();
                }
            });
        }


    }

    @Override
    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {

    }

    @Override
    public void onNothingSelected(AdapterView<?> parent) {

    }
}
