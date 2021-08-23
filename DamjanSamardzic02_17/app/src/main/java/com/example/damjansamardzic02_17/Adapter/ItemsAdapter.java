package com.example.damjansamardzic02_17.Adapter;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import android.widget.Filter;
import android.widget.Filterable;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.damjansamardzic02_17.Objects.Supplement;
import com.example.damjansamardzic02_17.Objects.Supplier;
import com.example.damjansamardzic02_17.R;

import java.util.ArrayList;
import java.util.Collection;
import java.util.List;

public class ItemsAdapter extends RecyclerView.Adapter<ItemsAdapter.ItemsViewHolder> implements Filterable {
    private ArrayList<Supplement> IitemsList;
    private ArrayList<Supplement> IitemsListAll;
    private String userId;

    private OnItemClickListener mListener;

    private ArrayList<Supplier> SupplierList;

    @Override
    public Filter getFilter() {
        return filter;
    }

    Filter filter=new Filter() {
        @Override
        protected FilterResults performFiltering(CharSequence charSequence) {
            List<Supplement> filteredList=new ArrayList<>();
            if(charSequence.toString().isEmpty()){
                filteredList.addAll(IitemsListAll);
            }else{
                for(Supplement s: IitemsListAll){
                    if(s.getName().toLowerCase().contains(charSequence.toString().toLowerCase())){
                        filteredList.add(s);
                    }
                }
            }
            FilterResults filterResults=new FilterResults();
            filterResults.values=filteredList;

            return filterResults;
        }

        @Override
        protected void publishResults(CharSequence constraint, FilterResults filterResults) {
            IitemsList.clear();
            IitemsList.addAll((Collection<? extends Supplement>) filterResults.values);
            notifyDataSetChanged();

        }
    };

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

    public ItemsAdapter(ArrayList<Supplement> itemsList){

        this.IitemsList=itemsList;
        this.IitemsListAll=new ArrayList<>(itemsList);
    }
    @NonNull
    @Override
    public ItemsViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {

        View v= LayoutInflater.from(parent.getContext()).inflate(R.layout.items,parent,false);
        ItemsViewHolder ivh=new ItemsViewHolder(v,this.mListener);
        return ivh;
    }

    @Override
    public void onBindViewHolder(@NonNull ItemsViewHolder holder, int position) {

        Supplement currentItem=IitemsList.get(position);


        holder.mTextView1.setText(currentItem.getName());
        holder.mTextView2.setText(currentItem.getCompany());
      holder.mTextView3.setText("Price: "+currentItem.getPrice());



    }

    @Override
    public int getItemCount() {
        return IitemsList.size();
    }



}
