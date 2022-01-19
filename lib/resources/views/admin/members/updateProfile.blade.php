@extends('admin.layout.index')
@section('title','Cập nhật thông tin')
<style>
    .hidden {
    display: none !important;
    visibility: hidden !important;
    }
</style>
@section('content')
<div class="content-wrapper">
    <div class="container">
        <form method="POST" enctype="multipart/form-data">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 mt-5 pt-5">
                    <div class="row z-depth-3">
                        <div class="col-sm-4 rounded-left" style="background-color: #212529">
                            <div class="card-block text-center text-white mt-3">
                                <img src="{{asset('public/admin/images/avatar/'.$user->image)}}" id="avatar" style="cursor: pointer;" width="100%" height="350px" alt="User Image">
                                <input type="file" id="img" name="img" class="form-control-file hidden" onchange="changeImg(this)">
                                <div class="font-weight-bold mt-4">{{$user->fullname}}</div>
                                <p>{{$role->name}}</p>
                            </div>
                        </div>
                        <div class="col-sm-8 bg-white rounded-right">
                            <h3 class="mt-3 text-center">Cập nhật thông tin</h3>
                            <hr class="badge-primary mt-0 w-25">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="font-weight-bold">Tên:</p>
                                    <input type="text" name="fullname" class="form-control" value="{{$user->fullname}}">
                                    {{-- <p class="font-weight-bold">Mật khẩu cũ</p>
                                    <input type="password" name="old_password" class="form-control"> --}}
                                    <p class="font-weight-bold">Mật khẩu mới</p>
                                    <input type="password" name="new_password" class="form-control" value="{{$user->password}}"> <br>
                                    <input type="submit" class="btn btn-primary" value="Cập nhật">                                    
                                </div>
                            </div>
                            <hr class="bg-primary">
                        </div>
                    </div>
                </div>
            </div>
            @csrf
        </form>
    </div>
</div>
@endsection 