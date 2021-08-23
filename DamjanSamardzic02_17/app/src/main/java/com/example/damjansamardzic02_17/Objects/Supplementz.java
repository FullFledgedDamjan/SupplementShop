package com.example.damjansamardzic02_17.Objects;

import com.google.gson.annotations.SerializedName;

public class Supplementz {

    @SerializedName("id") private int id;
    @SerializedName("name") private String name;
    @SerializedName("company") private String company;
    @SerializedName("price") private int price;
    @SerializedName("user") private int user;
    @SerializedName("supplementType") private int supplementType;

    public int getId() {
        return id;
    }

    public String getName() {
        return name;
    }

    public String getCompany() {
        return company;
    }

    public int getPrice() {
        return price;
    }

    public int getUser() {
        return user;
    }

    public int getSupplementType() {
        return supplementType;
    }
}
