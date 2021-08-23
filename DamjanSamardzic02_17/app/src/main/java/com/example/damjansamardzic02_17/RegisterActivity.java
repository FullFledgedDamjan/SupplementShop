package com.example.damjansamardzic02_17;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.example.damjansamardzic02_17.API.API;
import com.example.damjansamardzic02_17.Objects.JsonResponse;
import com.example.damjansamardzic02_17.Objects.User;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class RegisterActivity extends AppCompatActivity {
    private long backPressedTime;
    private  Toast backToast;

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
        setContentView(R.layout.activity_register);

        Button loginButton = (Button) findViewById(R.id.registerButton);
        loginButton.setOnClickListener(v -> register());

        Button toRegister = (Button) findViewById(R.id.toLogin);
        toRegister.setOnClickListener(v -> openLogin());
    }

    public void openLogin() {
        Intent intent = new Intent(this, MainActivity.class);
        startActivity(intent);
        finish();
    }

    public void register(){

        EditText username = findViewById(R.id.txtUsername);

        EditText password = findViewById(R.id.txtPassword);
        User user = new User(username.getText().toString(), password.getText().toString(),1);

        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://192.168.43.222/DamjanSamardzic02_177/api/users/")
                .addConverterFactory(GsonConverterFactory.create())
                .build();

        API jsonApiUsers = retrofit.create(API.class);
        Call<JsonResponse> call = jsonApiUsers.createUser(user);
        call.enqueue(new Callback<JsonResponse>() {
            @Override
            public void onResponse(Call<JsonResponse> call, Response<JsonResponse> response) {
                if(!response.isSuccessful()){
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

                if(responseJ.getMessage().equalsIgnoreCase("Successfully registered!")) {
                    openLogin();
                }
            }

            @Override
            public void onFailure(Call<JsonResponse> call, Throwable t) {
                Toast toast = Toast.makeText(getApplicationContext(),
                        "Failed to register",
                        Toast.LENGTH_SHORT);
                toast.show();
            }
        });
    }
}
