package com.example.damjansamardzic02_17.Objects;

import androidx.annotation.NonNull;

public class Company {

    private Integer id;
    private String name;

    public Company(Integer id, String name ) {
        this.id = id;
        this.name = name;

    }

    public Integer getId() {
        return id;
    }

    public String getName() {
        return name;
    }

    @NonNull
    @Override
    public String toString() {
        return name;
    }
}
