 <table class="table table-bordered table-hover table1">
   <thead>
      <tr style="background-color: #3c8dbc;color:white;">
        <th class="text-center">ID</th>
        <th class="text-center">Tên KH</th>
        <th class="text-center">Điện thoại</th>
        <th class="text-center">Địa chỉ</th>
        <th class="text-center">Tiền thanh toán</th>
        <th class="text-center">Ngày đặt</th>
        <th class="text-center">Tình trạng</th>
        
        <th class="text-center">
          <a href="{{ route('order.index') }}" class="btn btn-sm btn-success">
              <span class="glyphicon glyphicon"></span>&nbsp;Thao tác
          </a>
        </th>
      </tr>
  </thead>
  <tbody>
  
   @forelse($orders as $value)
    <tr id="{{-- {{ $value->id }} --}}">
        <td class="text-center">{{ $value->id }}</td>
        <td class="text-center">{{ $value->name }}</td>
        <td class="text-center">{{ $value->phone }}</td>
        <td class="text-center">{{ $value->address }}</td>
        <td class="text-center">{{ number_format($value->total_price) }}</td>

        <td class="text-center">{{ Carbon\Carbon::createFromTimestamp(strtotime($value->created_at))->format('Y-m-j h:m:s') }}</td>

        <td class="text-center">
          @if($value->status == 1) <!-- đơn hàng chờ duyệt -->
            <span class="label label-default label-draft">Chờ duyệt</span>
          @elseif($value->status == 2) <!-- đơn hàng đang chuyển -->
            <span class="label label-primary label-draft">Đang chuyển hàng</span>
          @elseif($value->status == 3) <!-- đơn hàng đã thanh toán -->
            <span class="label label-success label-draft">Đã thanh toán</span>
          @else($value->status == 4) <!-- đơn hàng đã hủy -->
            <span class="label label-danger label-draft">Đã hủy</span>
          @endif
        </td>
        <td class="text-center">
          <a href="{{ route('order.edit',$value->id) }}" class="btn btn-info btn-xs" style="margin:2px !important">
              <i class="fa fa-eye fa-fw"></i><span>Xem</span>
          </a>
          
            <a  class="btn btn-danger btn-xs delProduct" data-id="{{-- {{ $value->id }} --}}" style="margin:2px !important"  data-toggle="modal" data-target="#modal-default">
              <i class="glyphicon glyphicon-trash fa-fw"></i><span>Xóa</span>
          </a>
        </td>
    </tr>
    @empty
      <tr class="text-center">
          <td colspan="8" id="not-order">Không có đơn hàng nào</td>
      </tr>    
    @endforelse
  </tbody>  
</table>
<div class="pull-right">{{-- {{ $services->links() }} --}}</div>