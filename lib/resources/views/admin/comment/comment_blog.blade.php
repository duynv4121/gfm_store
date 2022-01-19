@extends('admin.layout.index')
@section('title','Bình luận bài viết')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Bình luận bài viết</li>
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
                            <h3 class="card-title">Bảng bình luận bài viết</h3>
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
                                        <th>Chi tiết bình luận</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>
                                            <img src="{{asset('public/admin/images/blog')}}/{{$row->image}}" width="150px" height="150px">
                                        </td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->total}}</td>
                                        <td>{{date('H:i d/m/Y',strtotime($row->created_at))}}</td>
                                        <td><a href="{{url('admin/commentblog')}}/{{$row->blog_id}}/detail" class="btn btn-warning">Chi tiết</a></td>   
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