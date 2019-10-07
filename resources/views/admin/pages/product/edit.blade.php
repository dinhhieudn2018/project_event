@extends('admin.layout.master')
@section('sub-content')
    Sản phẩm
@endsection
@section('action')
    Thêm mới
@endsection
@section('content')
	<div class="container" style="padding-top: 30px">
   <div class="col-lg-12" style="padding-bottom:120px">
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        <form action="{{ route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
          @method('put')
         <input type="hidden" name="_token" value="{{ csrf_token() }}">  
         {{ csrf_field() }}          
         <div class="row">
            <div class="col-md-4">
               <div class="form-group">
                  <label>Tên sản phẩm</label>
                  <input class="form-control" type="text" name="name" placeholder="Xin nhập tên sản phẩm" value="{{$product->name }}">
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>Giá</label>
                  <input class="form-control" type="text" name="price" placeholder="Xin nhập giá" value="{{ $product->price }}">
               </div>
           </div>
           <div class="col-md-4">
               <div class="form-group">
                  <label>Tiêu đề</label>
                  <input class="form-control" type="text" name="title" placeholder="Xin nhập tiêu đề" value="{{ $product->title }}">
               </div>
           </div>
           <div class="col-md-4">
               <div class="form-group">
                  <label>Hình ảnh</label>
                  <input class="form-control" type="file" name="image">
                  <img src="img/upload/product/{{ $product->image }}" style="width: 70px" height="70px">
               </div>
           </div>
           <div class="col-md-4">
               <div class="form-group">
                  <label>Tình trạng</label>
                  {{-- <input class="form-control" type="text" name="status" placeholder="Tình trạng" value=""> --}}
                  <select class="form-control" name="status">
                        <option value="1" @if($product->status == 1) selected="" @endif >Hiển thị</option>
                        <option value="0" @if($product->status == 0) selected="" @endif>Không hiển thị</option>                       
                  </select>
               </div>
           </div>
         </div>
         <div class="text-center">
            <button type="submit" class="btn btn-success">Lưu</button>
            <a href="{{ URL::previous() }}" class="btn btn-default">Quay lại</a>
         </div>
        </form>
   </div>
   <!-- Your code to create an instance of Fine Uploader and bind to the DOM/template
      ====================================================================== -->
</div>
@endsection