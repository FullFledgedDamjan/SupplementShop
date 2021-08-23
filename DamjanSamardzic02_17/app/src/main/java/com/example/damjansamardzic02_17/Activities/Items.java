package com.example.damjansamardzic02_17.Activities;

import com.example.damjansamardzic02_17.Objects.Supplement;

public class Items {

    private int id;
    private String mText1;
    private String mText2;
    private int userId;
    private int cost;

    public Items(int id, String mText1, String mText2,int userId,int cost) {
        this.id=id;
        this.mText1 = mText1;
        this.mText2 = mText2;
        this.userId=userId;

        this.cost=cost;
    }

    public Items(Supplement supplement) {
    }

    public int getId() {
        return id;
    }


    public String getmText1() {
        return mText1;
    }

    public String getmText2() {
        return mText2;
    }

    public int getUserId() {
        return userId;
    }

    public int getCost() {
        return cost;
    }


}
