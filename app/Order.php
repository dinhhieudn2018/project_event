<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $fillable = ['idUser', 'name', 'address', 'email', 'phone', 'total_price', 'message', 'status',];

    public function user(){
    	return $this->belongsTo('App\User','idUser','id');
    }
    public function products(){
    	return $this->belongsToMany('App\Product','order_details','idOrder','idProduct')->withPivot('quantity');
    }
}
