@extends('admin.layout.index')
@section('title','Mã giảm giá')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Mã giảm giá</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Bảng mã giảm giá</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{url('admin/coupon/destroy')}}" method="post" >
                            @csrf
                            @method('DELETE')
                                <div class="delete_ch" style="width=120px;">
                                    <div>
                                        <label for="checkAll" class="btn btn-danger mb-2 float-left select" style=" font-weight:400;"> Chọn tất cả </label>
                                        <label for="checkAll" class="btn btn-danger mb-2 float-left unselect"style="display:none;font-weight:400;"> Bỏ chọn</label>
                                        <input type="checkbox" hidden id="checkAll">
                                    </div>
                                    <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#largeModal1" style="margin-left:5px">Xóa</button>
                                    <div class="modal fade" id="largeModal1" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-md-12">
                                                        <div class="card">                                               
                                                        <div class="card-body">
                                                                <h3 class="card-title mb-3" style="font-weight: bold;"></h3> Bạn có chắc chắn muốn xóa?
                                                                <button type="submit" name="deleteCheckbox" class="btn btn-danger mb-2" style="margin-left: 5px"> Xóa </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="30px">
                                                X
                                            </th>
                                            <th>ID</th>
                                            <th>Tên</th>
                                            <th>Mã giảm giá</th>
                                            <th>Phương thức</th>
                                            <th>Giá trị</th>
                                            <th>Trạng thái</th>
                                            <th>Chi tiết</th>
                                            @can('cap nhat ma giam gia')
                                            <th>Cập nhật</th>
                                            @endcan
                                            @can('gui mail ma giam gia')
                                            <th>Gửi voucher</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($coupon as $row)
                                        <tr>
                                            <td><input type="checkbox" name="checkbox[]" class="checkbox" value="{{$row->id}}" id=""></td>
                                            <td>{{$row->id}}</td>
                                            <td>{{$row->coupon_name}}</td>
                                            <td>{{$row->coupon_code}}</td>
                                            <td>
                                                @if($row->coupon_condition == 1)
                                                Giảm theo %
                                                @else
                                                Giảm theo mệnh giá
                                                @endif

                                            </td>
                                            <td>
                                                @if($row->coupon_condition == 1)
                                                {{$row->coupon_value}}%
                                                @else
                                                {{number_format($row->coupon_value),' '}}đ
                                                @endif
                                            </td>
                                            <td>
                                                @if($row->coupon_status == 0)
                                                <span class="right badge badge-danger">Ngưng hoạt động</span>
                                                @else
                                                <span class="badge badge-info right">Đang hoạt động</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#largeModal1{{$row->id}}">Chi tiết</button>
                                                <div class="modal fade" id="largeModal1{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h3 class="card-title mb-3" style="font-weight: bold;"></h3>
                                                                            <div class="col-md-6 float-left">
                                                                                <ul class="list">
                                                                                    <li>
                                                                                        <h5 style="font-weight: bold;">
                                                                                            <span>Tên</span>: <b class="text-danger">{{$row->coupon_name}}</b>
                                                                                        </h5>
                                                                                    </li>
                                                                                    <li>
                                                                                        <h5 style="font-weight: bold;">
                                                                                            <span>Phương thức</span>:
                                                                                            @if($row->coupon_condition == 1)
                                                                                                Giảm theo %
                                                                                            @else
                                                                                                Giảm theo mệnh giá
                                                                                            @endif
                                                                                        </h5>
                                                                                    </li>
                                                                                    <li>
                                                                                        <h5 style="font-weight: bold;">
                                                                                            <span>Số ượng</span>:{{$row->coupon_quanlity}}
                                                                                        </h5>
                                                                                    </li>
                                                                            
                                                                                    <li>
                                                                                        <h5 style="font-weight: bold;">
                                                                                            <span>Trạng thái</span>:
                                                                                            @if($row->coupon_status == 0)
                                                                                                <span class="right badge badge-danger">Ngưng hoạt động</span>
                                                                                            @else
                                                                                                <span class="badge badge-info right">Đang hoạt động</span>
                                                                                            @endif
                                                                                        </h5>
                                                                                    </li>
                                                                                    <li>
                                                                                        <h5 style="font-weight: bold;">
                                                                                            <span>Ngày bắt đầu</span>:
                                                                                            <b class="text-danger"></b>{{$row->date_start}}
                                                                                        </h5>
                                                                                    </li>
                                                                                    <li>
                                                                                        <h5 style="font-weight: bold;">
                                                                                            <span>Ngày hết hạn</span>:
                                                                                            <b class="text-danger"></b>{{$row->date_end}}
                                                                                        </h5>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            @can('cap nhat ma giam gia')
                                            <td>
                                                <a href="{{url('admin/coupon')}}/{{$row->id}}/edit" class="btn btn-warning">Cập nhật</a>
                                            </td>
                                            @endcan
                                            @can('gui mail ma giam gia')
                                            <td>
                                                <a href="{{url('admin/coupon/send-mail')}}/{{$row->id}}" class="btn btn-default">Gửi voucher</a>
                                            </td>
                                            @endcan
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
    </section>
</div>
<script type="text/javascript">
    var checkAll = document.querySelector('#checkAll')
    var checkBoxs = document.querySelectorAll('.checkbox')
    var selected = document.querySelector('.select')
    var unselected = document.querySelector('.unselect')
    checkAll.onclick = () => {
        checkBoxs.forEach(checkBox => {
            if (checkAll.checked == true) {
                checkBox.checked = true
                selected.style.display = 'none'
                unselected.style.display = 'block'
            } else {
                checkBox.checked = false
                selected.style.display = 'block'
                unselected.style.display = 'none'
            }
        })
    }
</script>
@endsection