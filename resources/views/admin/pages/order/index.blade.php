@extends('admin.layout.master')

@section('sub-content')
	Đơn hàng
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
    #not-order{
      font-size: 20px;
      font-weight: bold;
      color: red; 
      text-align: center;
    }
  </style>
	<div class="container" style="padding-top: 30px;width: 100%">
  
  <div class="form-group">
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Bộ lọc:</legend>
                <div class="row control-group">
                    <div class="col-sm-2 form-group">
                        <label for="">Trạng thái:</label>
                        <select class="filter form-control select2 select2-hidden-accessible" id="status" style="width:100% !important;">
                                <option value="">Tất cả</option>
                                <option value="1">Chờ duyệt</option>
                                <option value="2">Đang chuyển hàng</option>
                                <option value="3">Đã thanh toán</option>
                                <option value="4">Đã hủy</option>
                        </select>
                    </div>
                    <div class="col-sm-3 form-group">
                        <label for="">Thời gian từ:</label>
                      
                          <div class="form-group">
                          

                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="datepickerfrom" data-date-format='yyyy-mm-dd'>
                            </div>
                            <!-- /.input group -->
                          </div>
                    </div>
                    <div class="col-sm-3 form-group">
                        <label for="">Thời gian đến:</label>
                      
                          <div class="form-group">
                          

                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="datepickerto" data-date-format='yyyy-mm-dd'>
                            </div>
                            <!-- /.input group -->
                          </div>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label for="">Tìm kiếm:</label>
                        <input type="text" class="form-control" name="search" id="search" placeholder="Nhập từ khóa" value="">
                    </div>
                   
                </div>
            </fieldset>
        </div>

  <div id="content" class="table-responsive">
    @include('admin.ajax.ajax_order')

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
      // cài tùy chọn thời gian from - to
      $('#datepickerfrom').datepicker({
        autoclose: true
      })
      $('#datepickerto').datepicker({
        autoclose: true
      })
   
      function callAjax(){
          var status = $('#status').val();
          var search = $('#search').val(); //lấy giá trị người dùng gõ
          var datefrom = $('#datepickerfrom').datepicker({ dateFormat: 'yyyy-mm-dd' }).val();
          var dateto = $('#datepickerto').datepicker({ dateFormat: 'yyyy-mm-dd' }).val();
          console.log(datefrom,dateto);
          $.ajax({
            url : '{{ route('ajax-order') }}',
            type : 'GET',
            dataType : 'JSON',
            data : {
              status : status,
              search : search,
              datefrom : datefrom,
              dateto : dateto
            },
            success: function(data){
              $('#content').html(data.view);
            }
          });
      }
      $('.filter').on('change', function (){ //chọn option select

          callAjax();
      });
      
      $('#datepickerto').on('change', function (){ //chọn datepicker

          callAjax();
      });
      $('#search').on('keyup',function(){ //bắt sự kiện khi người dùng gõ từ khóa

          callAjax();
      });
    });
  </script>
@endsection
