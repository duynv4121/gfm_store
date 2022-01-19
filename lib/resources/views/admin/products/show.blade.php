@extends('admin.layout.index')
@section('title','Sản phẩm')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Sản phẩm</li>
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
                            <h3 class="card-title">Danh sách sản phẩm</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{url('admin/product/destroy')}}" method="post" >
                            @csrf
                            @method('DELETE')
                            @can('xoa san pham')
                            <div class="delete_ch" style="width=120px;">
                                <div>
                                    <label for="checkAll" class="btn btn-danger mb-2 float-left select" style=" font-weight:400;"> Chọn tất cả </label>
                                    <label for="checkAll" class="btn btn-danger mb-2 float-left unselect" style="display:none;font-weight:400;"> Bỏ chọn</label>
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
                                                            <h3 class="card-title mb-3" style="font-weight: bold;"></h3>
                                                            Bạn có chắc chắn muốn xóa?
                                                            <button type="submit" name="deleteCheckbox" class="btn btn-danger mb-2" style="margin-left: 5px">Xóa</button>
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
                            @endcan
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="30px">
                                            X
                                        </th>
                                        <th>ID</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá gốc</th>
                                        <th>Giá bán</th>
                                        <th>Giá KM</th>
                                        <th>Số lượng</th>
                                        <th>Loại sản phẩm</th>
                                        <th>Chi tiết</th>
                                        @can('cap nhat san pham')
                                        <th>Cập nhật</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product as $row)
                                    <tr>
                                        <td><input type="checkbox" name="checkbox[]" class="checkbox" value="{{$row->id}}" id=""></td>
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{number_format($row->price_cost),' '}}đ</td>
                                        <td>{{number_format($row->price),' '}}đ</td>
                                        <td>{{number_format($row->price_sales),' '}}đ</td>
                                        <td>{{$row->quanlity}}</td>
                                        <td>{{$row->child_cate_name}}</td>
                                        <td><button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#largeModalProduct{{$row->id}}" style="margin-left:5px">Chi tiết</button></td>
                                        <div class="modal fade" id="largeModalProduct{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
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
                                                                <div class="card-body row">
                                                                    <h3 class="card-title mb-3" style="font-weight: bold;"></h3>
                                                                    <img src="{{asset('public/admin/images/product')}}/{{$row->image}}" width="350px" height="250px">
                                                                    <ul class="list">
                                                                        <li>
                                                                            <h5 style="font-weight: bold;"><span>Tên sản phẩm</span>: <b class="text-danger">{{$row->name}}</b>
                                                                            </h5>
                                                                        </li>
                                                                        <li>
                                                                            <h5 style="font-weight: bold;">
                                                                                <span>Giá</span>: <b class="text-danger">{{number_format($row->price)}}VNĐ</b></h5>
                                                                        </li>
                                                                        <li>
                                                                            <h5 style="font-weight: bold;"><span>Giá khuyến mãi</span>: <b class="text-danger">{{number_format($row->price_sales)}} VNĐ</b></h5>
                                                                        </li>
                                                                        <li>
                                                                            <h5 style="font-weight: bold;"><span>Số lượng</span>: <b class="text-danger">{{$row->quanlity}}</b>
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
                                        @can('cap nhat san pham')
                                        <td><a href="{{url('admin/product')}}/{{$row->id}}/edit" class="btn btn-warning">Cập nhật</a></td>
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