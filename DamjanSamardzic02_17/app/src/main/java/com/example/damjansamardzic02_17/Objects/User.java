package com.example.damjansamardzic02_17.Objects;

public class    User {

    private Integer id;
    private String username;
    private String password;
    private int type;

    public User(String username, String password,int type) {
        this.username = username;
        this.password = password;
        this.type = type;
    }

    public int getId() {
        return id;
    }

    public String getUsername() {
        return username;
    }

    public String getPassword() {
        return password;
    }

    public int getType() {
        return type;
    }
}
