package com.example.damjansamardzic02_17.Objects;

import android.os.Parcel;
import android.os.Parcelable;

public class Supplement implements Parcelable {

    private Integer id;
    private String name;
    private String model;
    private String modelPrice;
    private int price;
    private String producer;
    private int companyInt;
    private int userId;
    private int supplementType;
    private int user;



//    public Supplement(String name, int price, int company,int userId) {
//        this.name = name;
//        this.price = price;
//        this.companyInt = companyInt;
//        this.userId=userId;
//
//    }
//
//    public Supplement(String name, int price, String company,int userId) {
//        this.name = name;
//        this.price = price;
//        this.company = company;
//        this.userId=userId;
//
//    }


    public Supplement(String name, int price, String producer,int user,int supplementType) {
        this.name = name;
        this.price = price;
        this.producer = producer;
        this.user=user;
        this.supplementType=supplementType;
    }


    protected Supplement(Parcel in) {
        if (in.readByte() == 0) {
            id = null;
        } else {
            id = in.readInt();
        }
        name = in.readString();
        price = in.readInt();
        producer = in.readString();
        user = in.readInt();
    }


    public static final Creator<Supplement> CREATOR = new Creator<Supplement>() {
        @Override
        public Supplement createFromParcel(Parcel in) {
            return new Supplement(in);
        }

        @Override
        public Supplement[] newArray(int size) {
            return new Supplement[size];
        }
    };

    public Integer getId() {
        return id;
    }

    public String getName() {
        return name;
    }

    public String getModel() {
        return model;
    }

    public String getModelPrice() {
        return modelPrice;
    }

    public int getPrice() {
        return price;
    }

    public String getCompany() {
        return producer;
    }

    public int getUser() {
        return user;
    }

    public int getSupplementType() {
        return supplementType;
    }

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel dest, int flags) {
        if (id == null) {
            dest.writeByte((byte) 0);
        } else {
            dest.writeByte((byte) 1);
            dest.writeInt(id);
        }
        dest.writeString(name);
        dest.writeInt(price);
        dest.writeString(producer);
        dest.writeInt(user);
    }
}
