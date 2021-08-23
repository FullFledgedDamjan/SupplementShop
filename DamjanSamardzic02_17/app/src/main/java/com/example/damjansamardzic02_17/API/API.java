package com.example.damjansamardzic02_17.API;

import android.provider.ContactsContract;

import com.example.damjansamardzic02_17.Objects.Company;
import com.example.damjansamardzic02_17.Objects.JsonResponse;
import com.example.damjansamardzic02_17.Objects.Supplement;
import com.example.damjansamardzic02_17.Objects.Supplier;
import com.example.damjansamardzic02_17.Objects.User;

import java.util.List;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.DELETE;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.Query;

public interface API {

    @GET("readUsers.php")
    Call<List<User>> getUsers();

    @POST("createUser.php")
    Call<JsonResponse> createUser(@Body User user);

    @DELETE("deleteSupplement.php")
    Call<JsonResponse> deleteSupplement(@Query("name") String name);

    @DELETE("deleteSupplementZ.php")
    Call<JsonResponse> deleteFromSupplier(@Query("name") String name);

    @DELETE("buySupplement.php")
    Call<JsonResponse> buySupplement(@Query("supplement") int supId,@Query("user") String userId);

    @POST("createSupplement.php")
    Call<JsonResponse> createSupplement(@Body Supplement supplement);

    @GET("readCompany.php")
    Call<List<Company>> getCompany();

//    @GET("/readSupplier.php/")
//    Call<List<Supplier>> getSupplier( );

    @GET("AjaxShop.php")
    Call<List<Supplement>> getSupplementsOnSale( );

    @GET("ReadAjaxShop.php")
    Call<List<Supplement>> getSupplementsSold( );

//    @GET("supplement/readSupplementsWithCompany.php")
//    Call<List<Supplement>> getSupplements( );








}
