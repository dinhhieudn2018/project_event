@extends('client.layout.master')

@section('content')
	<div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="/">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <form class="col-md-12" method="post">
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Image</th>
                    <th class="product-name">Product</th>
                    <th class="product-price">Price</th>
                    <th class="product-quantity">Quantity</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Remove</th>
                  </tr>
                </thead>
                <tbody>
                  @if(Cart::count() > 0)
                  @foreach($cart as $value)
                  <tr id="del-item_{{ $value->rowId }}">
                    <td class="product-thumbnail">
                      <img src="img/upload/product/{{ $value->options->image }}" alt="Image" class="img-fluid">
                    </td>
                    <td class="product-name">
                      <h2 class="h5 text-black">{{ $value->name }}</h2>
                    </td>
                    <td>{{ number_format($value->price) }}</td>
                    <td>
                      <div class="input-group mb-3" style="max-width: 120px;">
                        <input type="number" name="qty" class="qty form-control" value="{{ $value->qty }}" min="1" max="10" data-id="{{ $value->rowId }}">
                      </div>

                    </td>
                    <td>{{ number_format($value->price * $value->qty) }}</td>
                    <td><a  data-id="{{ $value->rowId }}" class="btn btn-primary btn-sm del-cart">X</a></td>
                  </tr>
                  @endforeach
                 @else
                 <tr class="text-center">
                          <td colspan="6" >  Bạn chưa mua sản phẩm nào </td>
                      </tr>

                  @endif
                </tbody>
              </table>
            </div>
          </form>
        </div>
        
        <div class="row">
          @if(Auth::check())
          <div class="col-md-6">
            <div class="row mb-5">
              <div class="col-md-8 mb-3 mb-md-0">
                <button class="btn btn-primary btn-sm btn-block">Checkout</button>
              </div>
              
            </div>
            <form action="{{ route('cart.store') }}" method="post">
              @csrf
            
            <div class="p-3 p-lg-5 border">  
               <div class="form-group row">
                <div class="col-md-12">
                  <label for="name" class="text-black">Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="name" name="name" required="" value="{{ Auth::user()->name }}">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="phone" class="text-black">Phone <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="phone" name="phone" required="" value="{{ Auth::user()->phone }}">
                </div>
              </div>
              
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="address" class="text-black">Address <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Street address" required="" value="{{ Auth::user()->address }}">
                </div>
              </div>
              
              <div class="form-group">
                <label for="message" class="text-black">Order Notes</label>
                <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
              </div>
              <button class="btn btn-primary btn-sm btn-block" type="submit">proceed to checkout</button>
            </div>
            </form>
          </div>
          @else
            <p style="font-weight: bold;">
              Vui lòng <a href="login">ĐĂNG NHẬP</a> để đặt hàng
            </p>
          @endif
          <div class="col-md-6 pl-5">
            <div class="row justify-content-end">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Total quantity</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black">{{ Cart::count() }}</strong>
                  </div>
                </div>
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">Total</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black">{{ number_format($price) }}</strong>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('script')
  <script type="text/javascript">
    
    $(document).ready(function(){
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      //cập nhật số lượng
      $('.qty').blur(function(){
        let rowId = $(this).data('id');
        $.ajax({
          url : 'cart/'+rowId,
          type : 'put',
          dataType : 'json',
          data : {
            qty : $(this).val(),
            _method: 'put',
          },
          success : function(data){
            console.log(data);
            if(data.error){
              toastr.error(data.error, 'Thông báo', {timeOut: 5000});
            }
            else{
              toastr.success(data.result, 'Thông báo', {timeOut: 5000});
              window.location.reload(true);
            } 
          }
        });
      });
      //xóa sản phẩm khỏi giỏ hàng
      $(".del-cart").click(function() {
        var rowId = $(this).data('id');
       
          $.ajax({
          url : 'cart/'+rowId,
          type : 'delete',
          dataType : 'json',
          
          success : function(data){
              console.log(data);
              toastr.success(data.result, 'Thông báo', {timeOut: 5000});
              // window.location.reload(true);
              $("#del-item_" + rowId).remove();
            }
          });
        });
        
      });
      
   
  </script>
@endsection