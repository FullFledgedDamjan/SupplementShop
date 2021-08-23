package com.example.damjansamardzic02_17.Objects;

import android.os.Parcel;
import android.os.Parcelable;

public class Supplier implements Parcelable {
    private Integer id;
    private int user;
    private int supplement;

public Supplier(int user,int supplement){
    this.user=user;
    this.supplement=supplement;

}

    public static final Creator<Supplier> CREATOR = new Creator<Supplier>() {
        @Override
        public Supplier createFromParcel(Parcel in) {
            return new Supplier(in);
        }

        @Override
        public Supplier[] newArray(int size) {
            return new Supplier[size];
        }
    };

    @Override
    public int describeContents() {
        return 0;
    }

    public Integer getId() {
        return id;
    }

    public int getUser() {
        return user;
    }

    public int getSupplement() {
        return supplement;
    }

    public static Creator<Supplier> getCREATOR() {
        return CREATOR;
    }

    protected Supplier(Parcel in) {
        if (in.readByte() == 0) {
            id = null;
        } else {
            id = in.readInt();
        }
        user = in.readInt();
        supplement = in.readInt();
    }

    @Override
    public void writeToParcel(Parcel dest, int flags) {
        if (id == null) {
            dest.writeByte((byte) 0);
        } else {
            dest.writeByte((byte) 1);
            dest.writeInt(id);
        }
        dest.writeInt(user);
        dest.writeInt(supplement);
    }

    }

