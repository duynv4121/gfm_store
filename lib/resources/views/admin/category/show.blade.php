@extends('admin.layout.index')
@section('title','Danh mục')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Danh mục</li>
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
                            <h3 class="card-title">Danh sách danh mục</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{url('admin/category/destroy')}}" method="post" >
                                @csrf
                                @method('DELETE')
                                @can('xoa danh muc')
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
                                @endcan
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="30px">X</th>
                                            <th>ID</th>
                                            <th>Tên danh mục</th>
                                            <th>Ảnh</th>
                                            <th>Tình trạng</th>
                                            @can('cap nhat danh muc')
                                            <th>Cập nhật</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <style>
                                        #category_order .ui-state-highlight{
                                            padding: 24px;
                                            background-color: #7fad39;
                                            border: 1px dotted #ccc;
                                            cursor: pointer;
                                            margin-top: 12px;
                                        }
                                    </style>
                                    <tbody id="category_order">
                                        @foreach($category as $row)
                                        <tr id="{{$row->id}}">
                                            <td><input type="checkbox" name="checkbox[]" class="checkbox" value="{{$row->id}}" id=""></td>
                                            <td>{{$row->id}}</td>
                                            <td>{{$row->name}}</td>
                                            <td width="300px">
                                                <img src="{{asset('public/admin/images/category')}}/{{$row->image}}" width="250px" height="200px">
                                            </td>
                                            <td>@if($row->status > 0)Hiện @else Ẩn @endif</td>
                                            @can('cap nhat danh muc')
                                            <td><a href="{{url('admin/category')}}/{{$row->id}}/edit" class="btn btn-warning">Cập nhật</a></td>
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