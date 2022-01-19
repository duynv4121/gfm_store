@extends('admin.layout.index')
@section('title','Khách hàng')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Khách hàng</li>
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
                            <h3 class="card-title">Danh sách khách hàng</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Họ tên</th>
                                        <th>Ảnh đại diện</th>
                                        <th>Email</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user as $row)
                                    <tr>
                                        <td>{{$row->fullname}}</td>
                                        <td class="text-center">
                                            <img src="{{asset('public/admin/images/avatar/'.$row->image)}}" width="100px"; height="100px";>
                                        </td>
                                        <td>{{$row->email}}</td>
                                        <td>
                                            @if ($row->address == null)
                                                Không có
                                            @else
                                                {{$row->address}}
                                            @endif
                                        </td> 
                                        <td>
                                            @if ($row->phone == null)
                                                Không có
                                            @else
                                                {{$row->phone}}
                                            @endif
                                        </td> 
                                        <td>
                                            @if ($row->active == 1)
                                                <a href="{{url('admin/customer/unactive')}}/{{$row->id}}" class="btn btn-warning">Hủy kích hoạt</a>
                                            @else
                                                <a href="{{url('admin/customer/active')}}/{{$row->id}}" class="btn btn-success">Kích hoạt</a>
                                            @endif
                                            
                                        </td>
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
    </section>
</div>
@endsection 