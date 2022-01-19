@extends('admin.layout.index')
@section('title','Thêm Slide Banner')
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
                            <h3><strong>Thêm banner mới</strong> </h3>
                        </div>
                        <div class="card-body card-block">
                            <form action="{{route('slide-banner.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <!-- @method('PATCH') -->
                               <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="col col-md-6">
                                                <label for="name" class=" form-control-label">Tiêu đề</label>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <input type="text" id="text-input" value="{{old('slide_title')}}" name="slide_title" placeholder="........" class="form-control">
                                                @error('slide_title')<small class="alert-danger">{{ $message }}</small>@enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col col-md-6">
                                                <label for="name" class=" form-control-label">Mô tả ảnh</label>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <input type="text" id="text-input" value="{{old('slide_description')}}" name="slide_description" placeholder="........" class="form-control">
                                                @error('slide_description')<small class="alert-danger">{{ $message }}</small>@enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col col-md-6"><label for="select" class="form-control-label">Tình trạng</label></div>
                                            <div class="col-12 col-md-12">
                                                <select name="slide_status" id="select" class="form-control">
                                                    <option value="0">Ẩn </option>
                                                    <option value="1">Hiện</option> 
                                                </select>
                                            </div>
                                        </div>
                                        <div class=" form-group">
                                            <div class="col-12 col-md-12">
                                                <label class=" form-control-label">Nội dung</label>
                                                <textarea name="slide_content" class="form-control">{{old('slide_content')}}</textarea>
                                                @error('slide_content')<small class="alert-danger">{{ $message }}</small>@enderror
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="col col-md-6"><label for="file-input" class=" form-control-label">Ảnh banner</label></div>
                                            <div class="col-12 col-md-12">
                                                <input type="file" id="img" name="slide_image" class="form-control-file hidden" onchange="changeImg(this)">
                                                <img id="avatar" class="thumbnail" style="cursor: pointer;" width="370px" height="320px" src={{asset('admin/images/avatar/no-img.png')}}> <br>
                                                @error('slide_image')<small class="alert-danger">{{ $message }}</small>@enderror
                                            </div>
                                        </div>
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