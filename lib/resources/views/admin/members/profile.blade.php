@extends('admin.layout.index')
@section('title','Thông tin thành viên')
@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mt-5 pt-5">
                <div class="row z-depth-3">
                    <div class="col-sm-4 rounded-left" style="background-color: #212529">
                        <div class="card-block text-center text-white mt-3">
                            <img src="{{asset('public/admin/images/avatar/'.Auth::user()->image)}}" width="100%" height="100%" alt="User Image">
                            <div class="font-weight-bold mt-4">{{Auth::user()->fullname}}</div>
                            <p>{{$role->name}}</p>
                        </div>
                    </div>
                    <div class="col-sm-8 bg-white rounded-right">
                        <h3 class="mt-3 text-center">Thông tin thành viên</h3>
                        <hr class="badge-primary mt-0 w-25">
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="font-weight-bold">Tên:</p>
                                <h6 class="text-muted">{{Auth::user()->fullname}}</h6>
                            </div>
                            <div class="col-sm-6">
                                <p class="font-weight-bold">Email</p>
                                <h6 class="text-muted">{{Auth::user()->email}}</h6>
                            </div>
                        </div>
                        <h4 class="mt-3">Project</h4>
                        <hr class="bg-primary">
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="font-weight-bold">Vai trò:</p>
                                <h6 class="text-muted">{{$role->name}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 