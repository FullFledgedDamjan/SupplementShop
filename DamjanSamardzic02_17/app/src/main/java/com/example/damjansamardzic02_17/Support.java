package com.example.damjansamardzic02_17;

import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.google.android.material.floatingactionbutton.FloatingActionButton;

public class Support extends AppCompatActivity {
private long backPressedTime;
private Toast backToast;

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
        setContentView(R.layout.activity_support);

        FloatingActionButton floatingActionButton = findViewById(R.id.goBackFloatAdd);
        floatingActionButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish();
            }
        });
    }
}
