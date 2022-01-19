@extends('admin.layout.index')
@section('title','Thêm sản phẩm')
@section('content')
    <div class="content-wrapper">
        <div class="content mt-2">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3><strong>Thêm sản phẩm mới</strong> </h3>
                            </div>
                            <div class="card-body card-block">
                                <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <!-- @method('PATCH') -->
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="col col-md-6"><label for="name" class=" form-control-label">Tên loại sản phẩm</label></div>
                                                <div class="col-12 col-md-12">
                                                    <input type="text" id="text-input" name="name" value="{{old('name')}}" placeholder="........" class="form-control">
                                                    @error('name')<small class="alert-danger">{{ $message }}</small>@enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col col-md-6"><label for="name" class=" form-control-label">Giá gốc</label></div>
                                                <div class="col-12 col-md-12">
                                                    <input type="text" id="text-input" name="price_cost" value="{{old('price_cost')}}" placeholder="........" class="form-control">
                                                    @error('price_cost')<small class="alert-danger">{{ $message }}</small>@enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col col-md-6"><label for="name" class=" form-control-label">Giá bán</label></div>
                                                <div class="col-12 col-md-12">
                                                    <input type="text" id="text-input" name="price" value="{{old('price')}}" placeholder="........" class="form-control">
                                                    @error('price')<small class="alert-danger">{{ $message }}</small>@enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col col-md-6"><label for="name" class=" form-control-label">Giá khuyến mãi</label></div>
                                                <div class="col-12 col-md-12">
                                                    <input type="text" id="text-input" name="price_sales" value="{{old('price_sales')}}" placeholder="........" class="form-control">
                                                    @error('price_sales')<small class="alert-danger">{{ $message }}</small>@enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col col-md-6"><label for="name" class=" form-control-label">Số lượng</label></div>
                                                <div class="col-12 col-md-12">
                                                    <input type="text" id="text-input" name="quanlity" value="{{old('quanlity')}}" placeholder="........" class="form-control">
                                                    @error('quanlity')<small class="alert-danger">{{ $message }}</small>@enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col col-md-6"><label for="name" class=" form-control-label">Ngày nhập sản phẩm</label></div>
                                                <div class="col-12 col-md-12">
                                                    <input type="date" id="text-input" name="add_day" value="{{old('add_day')}}" placeholder="........" class="form-control">
                                                    @error('add_day')<small class="alert-danger">{{ $message }}</small>@enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col col-md-6"><label for="name" class=" form-control-label">Ngày hết hạn</label></div>
                                                <div class="col-12 col-md-12">
                                                    <input type="date" id="text-input" name="expired_day" value="{{old('expired_day')}}" placeholder="........" class="form-control">
                                                    @error('expired_day')<small class="alert-danger">{{ $message }}</small>@enderror
                                                </div>
                                            </div>   
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="col col-md-6"><label for="file-input" class=" form-control-label">Ảnh đại diện</label></div>
                                                <div class="col-12 col-md-12">
                                                    <input type="file" id="img" name="img" class="form-control-file hidden" value="{{old('img')}}" onchange="changeImg(this)">
                                                    <img id="avatar" class="thumbnail" style="cursor: pointer;" width="200px" height="200px" src={{asset('public/admin/images/avatar/no-img.png')}}><br>
                                                    @error('img')<small class="alert-danger">{{ $message }}</small>@enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col col-md-6"><label for="file-input" class=" form-control-label">Ảnh liên quan</label></div>
                                                <div class="col-12 col-md-12">
                                                    <input type="file" id="file-input" name="img_gallery[]" class="form-control-file" multiple>
                                                    @error('img_gallery')<small class="alert-danger">{{ $message }}</small>@enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col col-md-6"><label for="select" class="form-control-label">An hien</label></div>
                                                <div class="col-12 col-md-12">
                                                    <select name="status" id="select" class="form-control">
                                                        <option value="1">Hiện</option> 
                                                        <option value="0">Ẩn </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col col-md-6"><label for="select" class=" form-control-label">Danh mục</label></div>
                                                <div class="col-12 col-md-12">
                                                    <select name="category" id="select_cate" class="form-control">
                                                        <option value="0">Chọn danh mục cho sản phẩm</option> 
                                                        @foreach ($cate as $val)
                                                            <option value="{{$val->id}}">{{$val->name}}</option> 
                                                        @endforeach 
                                                    </select>
                                                </div>
                                                @error('category')<small class="alert-danger">{{ $message }}</small>@enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="col col-md-6"><label for="select" class=" form-control-label">Loại sản phẩm</label></div>
                                                <div class="col-12 col-md-12">
                                                    <select name="child_cate_id" id="chid_cate" class="form-control">
                
                                                    </select>
                                                    @error('child_cate_id')<small class="alert-danger">{{ $message }}</small>@enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" form-group">
                                        <div class="col col-md-6"><label for="name" class=" form-control-label">Mô tả</label></div>
                                        <div class="col-12 col-md-12"><textarea name="description" id="noidung" class="ckeditor"></textarea></div>
                                        <script type="text/javascript">
                                            var editor = CKEDITOR.replace('description',{
                                                language:'vi',
                                                filebrowserImageBrowseUrl: '../../admin/editor/ckfinder/ckfinder.html?Type=Images',
                                                filebrowserFlashBrowseUrl: '../../admin/editor/ckfinder/ckfinder.html?Type=Flash',
                                                filebrowserImageUploadUrl: '../../admin/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                                filebrowserFlashUploadUrl: '../../admin/public/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                            });
                                        </script>
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
    </div
@endsection