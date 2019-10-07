<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'price', 'status', 'title', 'image', 'quantity', 'sales'];

    public function order(){
        return $this->belongsToMany('App\Order','order_details','idProduct','idOrder')->withPivot('quantity');
    }
}
