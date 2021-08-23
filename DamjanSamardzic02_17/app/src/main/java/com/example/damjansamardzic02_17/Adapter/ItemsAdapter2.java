package com.example.damjansamardzic02_17.Adapter;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.damjansamardzic02_17.Objects.Supplement;
import com.example.damjansamardzic02_17.R;

import java.util.ArrayList;

public class ItemsAdapter2 extends RecyclerView.Adapter<ItemsAdapter2.ItemsViewHolder> {
    private ArrayList<Supplement> IitemsList;
    private OnItemClickListener mListener;


    public interface OnItemClickListener {
        void onItemClick(int position);
    }
    public void setOnItemClickListener(OnItemClickListener listener) {
        this.mListener =  listener;
    }


    public static class ItemsViewHolder extends RecyclerView.ViewHolder{

        public TextView mTextView1;
        public TextView mTextView2;
        public TextView mTextView3;
        public TextView mTextView4;


        public ItemsViewHolder(@NonNull View itemView, final OnItemClickListener listener) {
            super(itemView);

            mTextView1=itemView.findViewById(R.id.textView);
            mTextView2=itemView.findViewById(R.id.textView2);
            mTextView3=itemView.findViewById(R.id.textView3);




            itemView.setOnClickListener(v -> {
                if(listener != null) {
                    int position = getAdapterPosition();
                    if(position != RecyclerView.NO_POSITION) {
                        listener.onItemClick(position);
                    }
                }
            });
        }
    }

    public ItemsAdapter2(ArrayList<Supplement> itemsList){
    this.IitemsList=itemsList;
    }
    @NonNull
    @Override
    public ItemsViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {

        View v= LayoutInflater.from(parent.getContext()).inflate(R.layout.items,parent,false);
        ItemsViewHolder ivh=new ItemsViewHolder(v,this.mListener);
//        return new ItemsViewHolder(v);
        return ivh;
    }

    @Override
    public void onBindViewHolder(@NonNull ItemsViewHolder holder, int position) {

        Supplement currentItem=IitemsList.get(position);
         double a=0;

        holder.mTextView1.setText(currentItem.getName());
        holder.mTextView2.setText(currentItem.getCompany()+"");
      holder.mTextView3.setText("Price : "+currentItem.getPrice());


    }

    @Override
    public int getItemCount() {
        return IitemsList.size();
    }




}
