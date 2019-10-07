<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use File;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.pages.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.product.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('image')){
            $file = $request->image;
            $file_name = $file->getClientOriginalName();
            $file_name = date('D_m_yyyy').'-'.rand().'-'.str_slug($file_name);
                if($file->move('img/upload/product',$file_name)){
                    $data = $request->all();
                    $data['image'] = $file_name;
                    Product::create($data);
                    return redirect()->route('product.index');
                }
        }
        else{
            return back()->with('error', 'Bạn chưa chọn ảnh');
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.pages.product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $data = $request->all();
        if($request->hasFile('image')){
            $file = $request->image;
            $file_name = $file->getClientOriginalName();
            $file_name = date('D_m_yyyy').'-'.rand().'-'.str_slug($file_name);
                if($file->move('img/upload/product',$file_name)){
                    $data['image'] = $file_name;
                    if(File::exists('img/upload/product'.$product->image)){
                        //Xóa file
                        unlink('img/upload/product'.$product->image);
                    }
                }
        }
        else{
            $data['image'] = $product->image;
        }
        
        if($product->update($data)){
            return redirect()->route('product.index')->with('thongbao','Đã cập nhật thành công');
        }
        else{
            return redirect()->route('product.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json(['success' => 'Xóa thành công']);
    }
}
