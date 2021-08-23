package com.example.damjansamardzic02_17;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.ItemTouchHelper;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import android.content.Intent;
import android.os.Bundle;

import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.example.damjansamardzic02_17.API.API;
import com.example.damjansamardzic02_17.Adapter.ItemsAdapter2;
import com.example.damjansamardzic02_17.Objects.JsonResponse;
import com.example.damjansamardzic02_17.Objects.Supplement;
import com.example.damjansamardzic02_17.Objects.Supplier;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.io.Serializable;
import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class ShoppingCartActivity extends AppCompatActivity {
    private RecyclerView recyclerView;
    private ItemsAdapter2 adapter;
    private RecyclerView.LayoutManager layoutManager;
    private SwipeRefreshLayout swipeRefreshLayout;
    private String userId;
    private String isAdmin;
    private String str;
    private double a;
    Supplement supplement;
    ArrayList<Supplement> supplementsList = new ArrayList<>();
    ArrayList<Supplier> suppliersList = new ArrayList<>();
    Call<List<Supplement>> call;
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
        setContentView(R.layout.activity_shopping_cart);

        userId = getIntent().getStringExtra("EXTRA_SESSION_ID");
        isAdmin = getIntent().getStringExtra("EXTRA_SESSION_ADMIN");


        userId = getIntent().getStringExtra("EXTRA_SESSION_ID");
//        for(Supplement s1: supplementsList){
//            a=2.0;
//            a+=s1.getPrice();
//        }

        Toast toast = Toast.makeText(getApplicationContext(),
                "Your shopping cart,swipe to remove item",
                Toast.LENGTH_SHORT);

        toast.show();
        addData();
        TextView cost=findViewById(R.id.textView4);
        cost.setText("Total cost: "+a);

        Button btn=findViewById(R.id.btnCalculate);
        btn.setOnClickListener(v -> {
            supplementsList=new ArrayList<>();
            addData();
            cost.setText("Total cost: "+a);
            a=0;
            adapter.notifyDataSetChanged();
            swipeRefreshLayout.setRefreshing(false);
        });

        swipeRefreshLayout = findViewById(R.id.swipeRefresh);
        swipeRefreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                supplementsList=new ArrayList<>();

                addData();
                TextView cost=findViewById(R.id.textView4);
                cost.setText("Total cost: "+a);
                a=0;
                adapter.notifyDataSetChanged();
                swipeRefreshLayout.setRefreshing(false);
            }
        });
        FloatingActionButton floatingActionButton = findViewById(R.id.goBackFloatAdd3);
        floatingActionButton.setOnClickListener(v -> {
            Intent intent1 = new Intent(getBaseContext(), SecondActivity.class);
            intent1.putExtra("EXTRA_SESSION_ID", userId);
            intent1.putExtra("EXTRA_SESSION_ADMIN", isAdmin);
          //  startActivity(intent1);
            finish();
        });

//        TextView cost=findViewById(R.id.textView4);
//        cost.setText("Total cost: "+a);

        Button btnPurchase = findViewById(R.id.btnPurchase);
        btnPurchase.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getBaseContext(), ConfirmPurchase.class);
                intent.putExtra("EXTRA_SESSION_ID", userId);

                startActivity(intent);
                finish();
                return;
            }
        });
    }



    public void addData(){


        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://192.168.43.222/DamjanSamardzic02_177/api/")
                .addConverterFactory(GsonConverterFactory.create())
                .build();


        API jsonApiSupplements = retrofit.create(API.class);

        Call<List<Supplement>> call = jsonApiSupplements.getSupplementsSold();


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

                            a+=s.getPrice();
                            str=s.getName();
                    }
                }



                Intent intent = new Intent(getApplicationContext(), ConfirmPurchase.class);
                intent.putExtra("supplementsList",(Serializable) supplementsList);

                recyclerView = findViewById(R.id.recyclerView2);
                recyclerView.setHasFixedSize(true);
                layoutManager = new LinearLayoutManager(getApplicationContext());
                adapter = new ItemsAdapter2(supplementsList);

                recyclerView.setLayoutManager(layoutManager);
                new ItemTouchHelper(itemTouchHelperCallBack).attachToRecyclerView(recyclerView);
                recyclerView.setAdapter(adapter);

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

    ItemTouchHelper.SimpleCallback itemTouchHelperCallBack = new ItemTouchHelper.SimpleCallback(0,ItemTouchHelper.RIGHT | ItemTouchHelper.LEFT) {
        @Override
        public boolean onMove(@NonNull RecyclerView recyclerView, @NonNull RecyclerView.ViewHolder viewHolder, @NonNull RecyclerView.ViewHolder target) {
            return false;
        }

        @Override
        public void onSwiped(@NonNull RecyclerView.ViewHolder viewHolder, int direction) {
            Supplement s= supplementsList.get(viewHolder.getAdapterPosition());
            supplementsList.remove(viewHolder.getAdapterPosition());
            adapter.notifyDataSetChanged();

            Retrofit retrofit = new Retrofit.Builder()
                    .baseUrl("http://192.168.43.222/DamjanSamardzic02_177/api/supplement/")
                    .addConverterFactory(GsonConverterFactory.create())
                    .build();






            API jsonApiManu = retrofit.create(API.class);
            Call<JsonResponse> call = jsonApiManu.deleteFromSupplier(s.getName());



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



    };

}
