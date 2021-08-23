package com.example.damjansamardzic02_17;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.basgeekball.awesomevalidation.AwesomeValidation;
import com.basgeekball.awesomevalidation.ValidationStyle;
import com.basgeekball.awesomevalidation.utility.RegexTemplate;
import com.example.damjansamardzic02_17.API.API;

import com.example.damjansamardzic02_17.Objects.Company;
import com.example.damjansamardzic02_17.Objects.JsonResponse;
import com.example.damjansamardzic02_17.Objects.Supplement;

import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class AddSupplementActivity extends AppCompatActivity {
    private Spinner spinner;
    private EditText model;
    private EditText user;
    private EditText price;
    private EditText supplementType;
    private Button button;
    private String userId;
    private String isAdmin;
    private long backPressedTime;
    private Toast backToast;
    AwesomeValidation awesomeValidation;
    int a;


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
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_add_supplement);

        userId = getIntent().getStringExtra("EXTRA_SESSION_ID");
        isAdmin = getIntent().getStringExtra("EXTRA_SESSION_ADMIN");

        model = findViewById(R.id.supplement_model);
        spinner = findViewById(R.id.spinner);
        price = findViewById(R.id.supplement_price);
       // user = findViewById(R.id.UserId);
        supplementType=findViewById(R.id.supplement_supplementType);

        button = findViewById(R.id.create_supplement);




        button.setOnClickListener(v -> {


            awesomeValidation = new AwesomeValidation(ValidationStyle.BASIC);
            awesomeValidation.addValidation(this,R.id.supplement_model, RegexTemplate.NOT_EMPTY,R.string.invalid_name);
            awesomeValidation.addValidation(this,R.id.supplement_price, RegexTemplate.NOT_EMPTY,R.string.invalid_price);
            awesomeValidation.addValidation(this,R.id.supplement_supplementType, RegexTemplate.NOT_EMPTY,R.string.invalid_type);



            if(awesomeValidation.validate()) {
                int a=0;
                a =Integer.parseInt( this.supplementType.getText().toString());
                int price = Integer.parseInt(this.price.getText().toString());
                if(a>0 && a<3 && price>0){
                    createSup(v);
                    Intent intent = new Intent(getBaseContext(), SecondActivity.class);
                    intent.putExtra("EXTRA_SESSION_ID", userId);
                    intent.putExtra("EXTRA_SESSION_ADMIN", isAdmin);
                    startActivity(intent);
                    finish();
                }else{
                    Toast.makeText(getApplicationContext(), "Invalid input",Toast.LENGTH_SHORT).show();
                }

            }else{
                Toast.makeText(getApplicationContext(), "Invalid input",Toast.LENGTH_SHORT).show();
            }



        });
        getManufacturers();

        FloatingActionButton floatingActionButton = findViewById(R.id.goBackFloatAdd);
//        Intent intent = new Intent(getBaseContext(), SecondActivity.class);
//        startActivity(intent);
        floatingActionButton.setOnClickListener(v -> {
            Intent intent = new Intent(getBaseContext(), SecondActivity.class);
            intent.putExtra("EXTRA_SESSION_ID", userId);
            intent.putExtra("EXTRA_SESSION_ADMIN", isAdmin);
            startActivity(intent);
            finish();
        });
    }

    private void getManufacturers() {
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://192.168.43.222/DamjanSamardzic02_177/api/company/")
                .addConverterFactory(GsonConverterFactory.create())
                .build();

        API jsonApiManu = retrofit.create(API.class);
        Call<List<Company>> call = jsonApiManu.getCompany();
        call.enqueue(new Callback<List<Company>>() {
            @Override
            public void onResponse(Call<List<Company>> call, Response<List<Company>> response) {
                if (!response.isSuccessful()) {
                    Toast toast = Toast.makeText(getApplicationContext(),
                            response.code(),
                            Toast.LENGTH_SHORT);
                    toast.show();
                    return;
                }
                List<Company> manufacturerList = response.body();
                ArrayAdapter<Company> adapter = new ArrayAdapter<>(getApplicationContext(), android.R.layout.simple_spinner_item, manufacturerList);
                adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);

                spinner.setAdapter(adapter);
            }

            @Override
            public void onFailure(Call<List<Company>> call, Throwable t) {
                Toast toast = Toast.makeText(getApplicationContext(),
                        "Failure",
                        Toast.LENGTH_SHORT);
                toast.show();
            }
        });
    }

    private void createSup(View v) {
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://192.168.43.222/DamjanSamardzic02_177/api/supplement/")
                .addConverterFactory(GsonConverterFactory.create())
                .build();

        API jsonApiSup = retrofit.create(API.class);


        Spinner mySpinner =findViewById(R.id.spinner);
        int manuIdd=mySpinner.getSelectedItemPosition()+1;
        String manuId = manuIdd+"";
        int price = Integer.parseInt(this.price.getText().toString());
       int id=Integer.parseInt(userId);
        String model = this.model.getText().toString();
        int supplementTypez =Integer.parseInt( this.supplementType.getText().toString());


        Supplement supplement = new Supplement(model, price,manuId,id,supplementTypez);


        Call<JsonResponse> call = jsonApiSup.createSupplement(supplement);
        call.enqueue(new Callback<JsonResponse>() {
            @Override
            public void onResponse(Call<JsonResponse> call, Response<JsonResponse> response) {
                if (!response.isSuccessful()) {
                    Toast toast = Toast.makeText(getApplicationContext(),
                           "created",
                            Toast.LENGTH_SHORT);
                    toast.show();
                    return;
                }
                JsonResponse responseJ = response.body();

                Toast toast = Toast.makeText(getApplicationContext(),
                        "kekw",
                        Toast.LENGTH_SHORT);
                toast.show();
            }

            @Override
            public void onFailure(Call<JsonResponse> call, Throwable t) {
                Toast toast = Toast.makeText(getApplicationContext(),
                        "Supplement created",
                        Toast.LENGTH_SHORT);
                toast.show();
            }
        });
    }

    public int getSelectedManu(View v) {
        return ((Company) spinner.getSelectedItem()).getId();
    }


}
