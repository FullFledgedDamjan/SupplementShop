package com.example.damjansamardzic02_17;

import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.example.damjansamardzic02_17.API.API;
import com.example.damjansamardzic02_17.Objects.JsonResponse;
import com.example.damjansamardzic02_17.Objects.Supplement;
import com.google.android.material.floatingactionbutton.FloatingActionButton;



import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class SupplementActivity extends AppCompatActivity {
    private String userId;
    private String isAdmin;
    private Button button;
    private Button btnBuy;
    Supplement supplement;
    private long backPressedTime;
    private  Toast backToast;

    @Override
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
        setContentView(R.layout.activity_supplement);

        Intent intent = getIntent();
        supplement = intent.getParcelableExtra("Supplement item");

        userId = getIntent().getStringExtra("EXTRA_SESSION_ID");
        isAdmin = getIntent().getStringExtra("EXTRA_SESSION_ADMIN");

        String text1 = supplement.getName();
        String text2 = supplement.getPrice()+"";
        String text3 = supplement.getCompany();

        TextView textView1 = findViewById(R.id.text1_phone_activity);
        textView1.setText(text1);

        TextView textView2 = findViewById(R.id.text2_phone_activity);
        textView2.setText(text2);

        TextView textView3 = findViewById(R.id.text3_phone_activity);
        textView3.setText(text3);

        if (isAdmin.equalsIgnoreCase("true")) {
            btnBuy = (Button) findViewById(R.id.btnBuy);
            btnBuy.setVisibility(View.GONE);

            button = (Button) findViewById(R.id.delete_sup);
            button.setOnClickListener(v -> {
                delete();
                Intent intent1 = new Intent(getBaseContext(), SecondActivity.class);
                intent1.putExtra("EXTRA_SESSION_ID", userId);
                intent1.putExtra("EXTRA_SESSION_ADMIN", isAdmin);

                startActivity(intent1);
                finish();
            });
        } else {
            button = (Button) findViewById(R.id.delete_sup);
            button.setVisibility(View.GONE);


            btnBuy = (Button) findViewById(R.id.btnBuy);
            btnBuy.setOnClickListener(v -> {
                buy();
                Intent intent1 = new Intent(getBaseContext(), SecondActivity.class);
                intent1.putExtra("EXTRA_SESSION_ID", userId);
                intent1.putExtra("EXTRA_SESSION_ADMIN", isAdmin);
                startActivity(intent1);

                finish();
            });
        }

        FloatingActionButton floatingActionButton = findViewById(R.id.goBackFloatAdd4);
        floatingActionButton.setOnClickListener(v -> {
            Intent intent1 = new Intent(getBaseContext(), SecondActivity.class);
            intent1.putExtra("EXTRA_SESSION_ID", userId);
            intent1.putExtra("EXTRA_SESSION_ADMIN", isAdmin);
            startActivity(intent1);
            finish();
        });

        Button btn=findViewById(R.id.confirmBtn);
        TextView text=(TextView) findViewById(R.id.text4_phone_activity);
        final TextView newPrice=(TextView) findViewById(R.id.text2_phone_activity);
        btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                newPrice.setTextColor(Color.rgb(0,0,0));
                text.setTextColor(Color.rgb(0,0,0));
                if(text.getText().toString().equalsIgnoreCase("Dedi")){
                    double a=Integer.parseInt(newPrice.getText().toString())*0.7;

                    newPrice.setTextColor(Color.rgb(139,0,0));

                    newPrice.setText(String.format("New price: %.2f", a));

                    text.setText("Discount 30%");
                    btn.setEnabled(false);
                }else{
                    text.setTextColor(Color.rgb(139,0,0));
                    text.setText("Incorrect promo code");
                }


            }
        });
    }

    public void delete() {
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://192.168.43.222/DamjanSamardzic02_177/api/supplement/")
                .addConverterFactory(GsonConverterFactory.create())
                .build();

        API jsonApiManu = retrofit.create(API.class);
        Call<JsonResponse> call = jsonApiManu.deleteSupplement(supplement.getName());
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



    public void buy() {
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://192.168.43.222/DamjanSamardzic02_177/api/supplement/")
                .addConverterFactory(GsonConverterFactory.create())
                .build();

        API jsonApiManu = retrofit.create(API.class);
        Call<JsonResponse> call = jsonApiManu.buySupplement(supplement.getId(),userId);
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
                        "Success",
                        Toast.LENGTH_SHORT);
                toast.show();
            }
        });
    }
}
