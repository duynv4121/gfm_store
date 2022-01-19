@extends('admin.layout.index')
@section('title','Cập nhật danh mục')
<style>
    .hidden {
    display: none !important;
    visibility: hidden !important;
    }
</style>
@section('content')
<div class="content-wrapper">
    <div class="content mt-2">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3><strong>Cập nhật danh mục</strong></h3>
                        </div>
                        <div class="card-body card-block">
                            <form action="{{route('category.update',$category->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                @method('PUT')
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="name" class=" form-control-label">Tên danh mục</label></div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="name" value="{{$category->name}}" class="form-control">
                                            {{-- @error('name'){{ $message }}@enderror --}}
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="file-input" class=" form-control-label">Ảnh đại diện</label></div>
                                        <div class="col-12 col-md-9">
                                            <input type="file" id="img" name="img" class="form-control-file hidden" onchange="changeImg(this)">
                                            <img id="avatar" class="thumbnail" style="cursor: pointer;" width="200px" height="200px" src="{{asset('public/admin/images/category')}}/{{$category->image}}"><br>
                                            {{-- @error('img'){{ $message }}@enderror --}}
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="select" class=" form-control-label">Tình trạng</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="status" id="select" class="form-control">
                                                @if($category->status > 0)
                                                    <option value="1" selected>Hiện</option> 
                                                    <option value="0">Ẩn </option>
                                                @else
                                                    <option value="1">Hiện</option> 
                                                    <option value="0" selected>Ẩn</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                <br>
                                <input class="btn btn-success float-right" type="submit" value="Cập nhật">
                            </form>      
                        </div>          
                    </div><!-- .content -->
                </div><!-- .content -->
            </div><!-- .content -->
        </div><!-- .content -->
    </div><!-- .content -->
</div><!-- .content -->
@endsection