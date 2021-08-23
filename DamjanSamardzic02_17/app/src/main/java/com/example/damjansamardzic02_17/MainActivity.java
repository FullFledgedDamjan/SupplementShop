package com.example.damjansamardzic02_17;

import  androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.example.damjansamardzic02_17.API.API;
import com.example.damjansamardzic02_17.Objects.User;

import java.util.List;


import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class MainActivity extends AppCompatActivity {
    private long backPressedTime;
    private Toast backToast;

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
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        Button buttonLogin = (Button) findViewById(R.id.buttonLogin);
        buttonLogin.setOnClickListener(v -> login());

        Button toRegister = (Button) findViewById(R.id.btnRegister);
        toRegister.setOnClickListener(v -> openRegister());
    }
        public void openRegister() {
            Intent intent = new Intent(this, RegisterActivity.class);
            startActivity(intent);
            finish();
        }

    public void login(){
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://192.168.43.222/DamjanSamardzic02_177/api/users/")
                .addConverterFactory(GsonConverterFactory.create())
                .build();

        API jsonApiUsers = retrofit.create(API.class);
        Call<List<User>> call = jsonApiUsers.getUsers();
        call.enqueue(new Callback<List<User>>() {
            @Override
            public void onResponse(Call<List<User>> call, Response<List<User>> response) {
                if(!response.isSuccessful()){
                    Toast toast = Toast.makeText(getApplicationContext(),
                            response.code(),
                            Toast.LENGTH_SHORT);
                    toast.show();
                    return;
                }

                List<User> users = response.body();
                EditText username = findViewById(R.id.editText);
                EditText password = findViewById(R.id.editPassword);

                for (User user : users){
                    if(user.getUsername().equalsIgnoreCase(username.getText().toString()) && user.getPassword().equalsIgnoreCase(password.getText().toString())){
                        int userId = user.getId();
                        boolean isAdmin = false;
                        if(user.getUsername().equalsIgnoreCase("admin")) {
                            isAdmin = true;
                        }
                        Toast toast = Toast.makeText(getApplicationContext(),
                                "Successfully logged in!",
                                Toast.LENGTH_SHORT);
                        toast.show();
                        Intent intent = new Intent(getApplicationContext(), SecondActivity.class);
                        intent.putExtra("EXTRA_SESSION_ID", userId + "");
                        intent.putExtra("EXTRA_SESSION_ADMIN", isAdmin + "");
                        startActivity(intent);
                        return;
                    }
                }
                Toast toast = Toast.makeText(getApplicationContext(),
                        "Wrong Information",
                        Toast.LENGTH_SHORT);
                toast.show();
            }

            @Override
            public void onFailure(Call<List<User>> call, Throwable t) {
                Toast toast = Toast.makeText(getApplicationContext(),
                        "Failure",
                        Toast.LENGTH_SHORT);
                toast.show();
            }
        });
    }
}

