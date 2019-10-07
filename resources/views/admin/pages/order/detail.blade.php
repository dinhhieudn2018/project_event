@extends('admin.layout.master')
@section('sub-content')
	Đơn hàng
@endsection

@section('action')
	Chi tiết
@endsection
@section('content')

	<div class="col-lg-12 " >
        <form action="{{ route('order.update',$order->id) }}" method="POST">
            @method('put')
            @csrf
            
               
            <div class="row">
                <div class="col-lg-5">
                    <div class="box-header mb-3">
                        <h4>Thông tin đơn hàng (Mã: {{ $order->id }})</h4>  
                    </div> 
                    <div class="form-group">
                         <label for="name" class="col-lg-3 pr-0">Tên</label>
                        <input type="text" class="form-control" name="name" id="name"  value="{{ $order->name }}" >  
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 ">Số điện thoại</label>
                        <input type="text" class="form-control" name="phone" id="phone" class="none-style" value="{{ $order->phone }}">
                    </div> 
                  
                    <div class="form-group">
                        <label class="col-lg-3 pr-0">Địa chỉ</label>
                        <textarea type="text" class="form-control" name="address" id="address"  >{{ $order->address }} </textarea>
                    </div> 
                    <div class="form-group">
                        <label class="col-lg-3 pr-0">Ngày đặt</label>
                        <input type="text" class="form-control"  value="{{ $order->created_at }}" readonly="">
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 pr-0">Ghi chú</label>
                        <textarea type="text" class="form-control" name="message" id="message" class="none-style" >{!! $order->message !!} </textarea>
                    </div>                   
                </div>
                <div class="col-lg-7">
                    <div class="box-header" style="margin-left: 70px;">
                      <label style="font-size: 18px;font-weight: bold;">Tình trạng</label>&nbsp&nbsp
                            <select name="status">
                                <option value="1" @if($order->status == 1) selected="" @endif>Chờ duyệt</option>
                                <option value="2" @if($order->status == 2) selected="" @endif>Đang chuyển hàng</option>
                                <option value="3" @if($order->status == 3) selected="" @endif>Đã thanh toán</option>
                                <option value="4" @if($order->status == 4) selected="" @endif>Đã hủy</option>
                            </select>   
                    </div> 

                    <table class="table table-bordered table-hover text-center">
                        <thead>
                        <tr>
                            <td>Mã SP</td>
                            <td>Sản phẩm</td>
                            <td>Số lượng</td>
                            <td>Giá</td>  
                        </tr>
                        </thead>
                        <tbody>                            
                            @forelse($order->products as $key => $product)
                            <tr>
                                <td>{{  $product->id}}</td>
                                <td>
                                    <a href="{{ route('product.edit',$product->id) }}">{{  $product->name}}</a>
                                </td>
                                <td>
                                    <input type="number"  class='quantity' min="1" name="product[{{$product->id}}][quantity]"  
                                    value="{{  $product->pivot->quantity }}" style="width: 50px">
                                </td>
                                <td>
                                    {{  number_format($product->price) }}&nbsp;VNĐ
                                    <input type="text" name="price" class="priceA" price='{{$product->price}}' data-price="{{$key}}"  value="{{ $product->price }}" style="display: none">
                                </td>
                            </tr>
                            @empty
                            @endforelse                          
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2"><strong>Tổng tiền</strong></td>
                            <td colspan="2" id="total"><strong><span>{{ number_format($order->total_price) }} VNĐ</span></strong></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-lg-7 text-center">
	                @if($order->status != 2 && $order->status != 3)
	                   
	                    <button type="submit" class="btn btn-success">Cập nhật</button>
	                @endif

	                <a href="{{ route('order.index') }}" class="btn btn-outline-secondary">Quay lại</a>
                    @if(Session::has('ok'))
                    <div style="color: red;font-weight: bold;text-align: center; font-size: 30px;">
                        {{ Session::get('ok') }}
                    </div>
                    @endif
            </div>
            </div>
        </form>
        
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        // $(document).ready(function(){
        //     var total_pay = 0;
        //         $('input.price').each(function (i, obj) {
        //             var price = $(obj).val();
        //             total_pay += +price;
        //         });
        //         $('.total_pay').text(total_pay);

        //     $(".quantity").on('change', function() {
        //         var index = $(this).attr('data-quantity');
        //         var ipt_price = $("input[data-price='" + index + "']");
        //         var quantity = $(this).val();
        //         var price = quantity * ipt_price.attr('price');
        //         ipt_price.val(price);
               
        //     });
        // });
    </script>
@endsection