<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class ProductDetailController extends Controller
{
    public function show($id){ // show chi tiết sản phẩm
    	$product = Product::find($id);
    	return view('client.pages.product-detail',compact('product'));
    }
}
