package com.example.damjansamardzic02_17;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.SearchView;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;


import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.Toast;

import com.example.damjansamardzic02_17.API.API;
import com.example.damjansamardzic02_17.Activities.Items;
import com.example.damjansamardzic02_17.Adapter.ItemsAdapter;
import com.example.damjansamardzic02_17.Objects.Supplement;
import com.example.damjansamardzic02_17.Objects.Supplier;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class SecondActivity extends AppCompatActivity {
    private RecyclerView recyclerView;
    private ItemsAdapter adapter;
    private RecyclerView.LayoutManager layoutManager;
    private SwipeRefreshLayout swipeRefreshLayout;
    private String userId;
    private String isAdmin;
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

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_second);
        userId = getIntent().getStringExtra("EXTRA_SESSION_ID");
        isAdmin = getIntent().getStringExtra("EXTRA_SESSION_ADMIN");




        addData();
        FloatingActionButton floatingActionButton2 = findViewById(R.id.floatButton2);
        floatingActionButton2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getBaseContext(), ShoppingCartActivity.class);
                intent.putExtra("EXTRA_SESSION_ID", userId);
                intent.putExtra("EXTRA_SESSION_ADMIN", isAdmin);
                startActivity(intent);
//                finish();
                return;
            }
        });
        if(isAdmin.equalsIgnoreCase("true")) {
            FloatingActionButton floatingActionButton = findViewById(R.id.floatButton);
            floatingActionButton.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Intent intent = new Intent(getBaseContext(), AddSupplementActivity.class);
                    intent.putExtra("EXTRA_SESSION_ID", userId);
                    intent.putExtra("EXTRA_SESSION_ADMIN", isAdmin);
                    startActivity(intent);
                    finish();
                    return;
                }
            });
        }else{
            FloatingActionButton floatingActionButton = findViewById(R.id.floatButton);
            floatingActionButton.hide();
        }

        swipeRefreshLayout = findViewById(R.id.swipeRefresh);
        swipeRefreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                addData();
                adapter.notifyDataSetChanged();
                swipeRefreshLayout.setRefreshing(false);
            }
        });
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.main_menu, menu);
        MenuItem item=menu.findItem(R.id.action_search);
        SearchView searchView=(SearchView)item.getActionView();
        searchView.setOnQueryTextListener(new SearchView.OnQueryTextListener() {
            @Override
            public boolean onQueryTextSubmit(String query) {
                return false;
            }

            @Override
            public boolean onQueryTextChange(String newText) {
                adapter.getFilter().filter(newText);
                return false;
            }
        });
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(@NonNull MenuItem item) {
        switch (item.getItemId()) {
            case R.id.support:
                Intent intent = new Intent(this, Support.class);
                startActivity(intent);
                return true;

            case R.id.logout:
                finish();
                return true;

            default: return super.onOptionsItemSelected(item);
        }
    }

    public void addData(){


        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://192.168.43.222/DamjanSamardzic02_177/api/")
                .addConverterFactory(GsonConverterFactory.create())
                .build();



        API jsonApiSupplements = retrofit.create(API.class);
        Call<List<Supplement>> call = jsonApiSupplements.getSupplementsOnSale();





        call.enqueue(new Callback<List<Supplement>>() {
            @Override
            public void onResponse(Call<List<Supplement>> call, Response<List<Supplement>> response) {
                if(!response.isSuccessful()){
                    Toast toast = Toast.makeText(getApplicationContext(),
                            response.code(),
                            Toast.LENGTH_SHORT);
                    toast.show();
                    return;
                }
                List<Supplement> supplements = response.body();
                ArrayList<Supplement> supplementsList = new ArrayList<>();



                supplementsList.addAll(supplements);




                recyclerView = findViewById(R.id.recyclerView);
                recyclerView.setHasFixedSize(true);
                layoutManager = new LinearLayoutManager(getApplicationContext());
                adapter = new ItemsAdapter(supplementsList);

                recyclerView.setLayoutManager(layoutManager);
                recyclerView.setAdapter(adapter);
                adapter.setOnItemClickListener(new ItemsAdapter.OnItemClickListener() {
                    @Override
                    public void onItemClick(int position) {
                        Intent intent = new Intent(SecondActivity.this, SupplementActivity.class);
                        intent.putExtra("Supplement item", supplementsList.get(position));
                        intent.putExtra("EXTRA_SESSION_ID", userId);
                        intent.putExtra("EXTRA_SESSION_ADMIN", isAdmin);
                        startActivity(intent);
                        finish();
                        return;
                    }
                });
            }

            @Override
            public void onFailure(Call<List<Supplement>> call, Throwable t) {
                Toast toast = Toast.makeText(getApplicationContext(),
                        "Failure",
                        Toast.LENGTH_SHORT);
                toast.show();
            }
        });
    }
}
