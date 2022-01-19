@extends('admin.layout.index')
@section('title','Cập nhật loại sản phẩm')
@section('content')
<div class="content-wrapper">
    <div class="content mt-2">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3><strong>Cập nhật loại sản phẩm</strong> </h3>
                        </div>
                        <div class="card-body card-block">
                            <form action="{{route('child-category.update', $child_cate->id)}}" method="post" enctype="multipart/form-data"
                                class="form-horizontal">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                 @method('PATCH')
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="name" class=" form-control-label">Tên loại sản phẩm</label></div>
                                    <div class="col-12 col-md-9"><input type="text" value="{{$child_cate->name}}" name="name" placeholder="........" class="form-control"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Thuộc danh mục</label></div>
                                    <div class="col-12 col-md-9">
                                        <select name="category" class="form-control">
                                           @foreach ($cate as $val)
                                                @if ($val->id == $child_cate->id_category)
                                                    <option selected value="{{$val->id}}">{{$val->name}}</option> 
                                                @else
                                                    <option value="{{$val->id}}">{{$val->name}}</option> 
                                                @endif  
                                           @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Tình trạng</label></div>
                                    <div class="col-12 col-md-9">
                                        <select name="status" class="form-control">
                                            <option @if ($child_cate->status==1) selected @endif value="1">Hiện</option> 
                                            <option @if ($child_cate->status==0) selected @endif value="0">Ẩn</option> 
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