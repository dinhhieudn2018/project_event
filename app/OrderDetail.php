<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = "order_details";

    protected $fillable = ['idOrder', 'idProduct', 'quantity',];

    public function order(){
    	return $this->belongsTo('App\Order','idOrder','id');
    }
}
