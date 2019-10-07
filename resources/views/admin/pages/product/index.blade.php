@extends('admin.layout.master')

@section('sub-content')
	Sản phẩm
@endsection

@section('action')
	Danh sách
@endsection

@section('content')
<style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
	<div class="container" style="padding-top: 30px;width: 100%">
       
       <div id="content" class="table-responsive">
  <table class="table table-bordered table-hover table1">
   <thead>
      <tr style="background-color: #3c8dbc;color:white;">
        <th class="text-center">STT</th>
        <th class="text-center">Tên sản phẩm</th>
        <th class="text-center">Giá</th>
        <th class="text-center">Tiêu đề</th>
        <th class="text-center">Hình ảnh</th>
        <th class="text-center">Tình trạng</th>
        
        <th class="text-center">
          <a href="{{ route('product.create') }}" class="btn btn-sm btn-success">
              <span class="glyphicon glyphicon-plus"></span>&nbsp;Thêm
          </a>
        </th>
      </tr>
  </thead>
  <tbody>
   @foreach($products as $value)
    <tr id="product_id_{{ $value->id }}">
        <td class="text-center">{{ $value->id }}</td>
        <td class="text-center">{{ $value->name }}</td>
        <td class="text-center">{{ $value->price }}</td>
        <td class="text-center">{{ $value->title }}</td>
        <td class="text-center">
          <img src="img/upload/product/{{ $value->image }}" style="width: 70px" height="70px">
        </td>
        <td class="text-center">
          @if($value->status == 1)
            <span class="label label-success label-draft">Hiển thị</span>
          @else
            <span class="label label-primary label-draft">Ẩn</span>
          @endif
        </td>
        <td class="text-center">
          <a href="{{ route('product.edit',$value->id) }}" class="btn btn-info btn-xs" style="margin:2px !important">
              <i class="fa fa-eye fa-fw"></i><span>Sửa</span>
          </a>
          
            <a  class="btn btn-danger btn-xs delProduct" data-id="{{ $value->id }}" style="margin:2px !important"  data-toggle="modal" data-target="#modal-default">
              <i class="glyphicon glyphicon-trash fa-fw"></i><span>Xóa</span>
          </a>
         
          
        </td>
    </tr>
    <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Thông báo</h4>
              </div>
              <div class="modal-body">
                <p>Bạn có muốn xóa không ?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary del">Xóa</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
   @endforeach
   
  </tbody>

   
</table>
<div class="pull-right">{{-- {{ $services->links() }} --}}</div>
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
			$(".delProduct").click(function() {
				var id = $(this).data('id');
				$(".del").click(function(){
					$.ajax({
					url : 'admin/product/' +id,
					type : 'delete',
					dataType : 'JSON',
					data : {
						id : id,
					},
					success : function(data){
						console.log(data);
						$("#modal-default").modal('hide');
            $("#product_id_" +id).remove();
						//location.reload();
						}
					});
				});
				
			});
			
		});
	</script>
@endsection