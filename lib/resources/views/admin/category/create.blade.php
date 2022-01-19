@extends('admin.layout.index')
@section('title','Thêm danh mục')
@section('content')
    <div class="content-wrapper">
        <div class="content mt-2">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3><strong>Danh mục</strong></h3>
                            </div>
                            <div class="card-body card-block">
                                <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="name" class=" form-control-label">Tên danh mục</label></div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="name" value="{{old('name')}}" placeholder="........" class="form-control">
                                            @error('name')<small class="alert-danger">{{ $message }}</small>@enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="file-input" class=" form-control-label">Ảnh đại diện</label></div>
                                        <div class="col-12 col-md-9">
                                            <input type="file" id="img" name="img" class="form-control-file hidden" onchange="changeImg(this)">
                                            <img id="avatar" class="thumbnail" style="cursor: pointer;" width="200px" height="200px" src={{asset('public/admin/images/avatar/no-img.png')}}><br>
                                            @error('img')<small class="alert-danger">{{ $message }}</small>@enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label class=" form-control-label">Ẩn hiện</label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="status" class="form-control">
                                                <option value="1">Hiện</option> 
                                                <option value="0">Ẩn </option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <input class="btn btn-success float-right" type="submit" value="Thêm">
                                </form>      
                            </div>          
                        </div><!-- .content -->
                    </div><!-- .content -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                            <h3><strong>Loại sản phẩm</strong> </h3>
                            </div>
                            <div class="card-body card-block">
                                <form action="{{route('child-category.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <!-- @method('PATCH') -->
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="name" class=" form-control-label">Tên loại sản phẩm</label></div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" value="{{old('child_cate_name')}}" name="child_cate_name" placeholder="........" class="form-control">
                                            @error('child_cate_name')<small class="alert-danger">{{ $message }}</small>@enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="select" class=" form-control-label">Ẩn hiện</label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="status" id="select" class="form-control">
                                                <option value="1">Hiện</option> 
                                                <option value="0">Ẩn </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="select" class=" form-control-label">Danh mục cha</label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="category" id="select" class="form-control">
                                                @foreach ($category as $val)
                                                    <option value="{{$val->id}}">{{$val->name}}</option> 
                                                @endforeach                                           
                                            </select>
                                        </div>
                                    </div>
                                <br>
                                <input class="btn btn-success float-right" type="submit" value="Thêm">
                                </form>      
                            </div>          
                        </div><!-- .content -->
                    </div><!-- .content -->
                </div><!-- .content -->
            </div><!-- .content -->
        </div><!-- .content -->
    </div><!-- .content -->
@endsection