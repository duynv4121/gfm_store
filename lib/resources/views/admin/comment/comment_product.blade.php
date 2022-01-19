@extends('admin.layout.index')
@section('title','Bình luận sản phẩm')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Bình luận sản phẩm</li>
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
                            <h3 class="card-title">Danh sách bình luận</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th width="160px">Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng bình luận</th>
                                        <th>Thời gian bình luận gần nhất</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>
                                            <img src="{{asset('public/admin/images/product')}}/{{$row->image}}" width="150px" height="150px">
                                        </td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->total}}</td>
                                        <td>{{date('d/m/Y H:i',strtotime($row->created_at))}}</td>
                                        <td><a href="{{url('admin/comment')}}/{{$row->product_id}}/detail" class="btn btn-warning">Chi tiết</a></td>   
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection