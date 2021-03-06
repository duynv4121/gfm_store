@extends('admin.layout.index')
@section('title','Cập nhật sản phẩm')
@section('content')
<div class="content-wrapper">
    <div class="content mt-2">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                        <h3><strong>Cập nhật sản phẩm</strong> </h3>
                        </div>
                        <div class="card-body card-block">
                            <form action="{{route('product.update', $product->id)}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                {{ method_field('PATCH') }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="name" class=" form-control-label">Tên sản phẩm</label></div>
                                            <div class="col-12 col-md-12"><input type="text" id="text-input" value="{{$product->name}}" name="name_pro" placeholder="........" class="form-control"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="name" class=" form-control-label">Giá gốc</label></div>
                                            <div class="col-12 col-md-12"><input type="text" id="text-input" value="{{$product->price_cost}}" name="price_cost" placeholder="........" class="form-control"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="name" class=" form-control-label">Giá bán</label></div>
                                            <div class="col-12 col-md-12"><input type="text" id="text-input" value="{{$product->price}}" name="price" placeholder="........" class="form-control"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="name" class=" form-control-label">Giá khuyến mãi</label></div>
                                            <div class="col-12 col-md-12"><input type="text" id="text-input" value="{{$product->price_sales}}" name="price_sale" placeholder="........" class="form-control"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="name" class=" form-control-label">Số lượng</label></div>
                                            <div class="col-12 col-md-12"><input type="text" id="text-input" value="{{$product->quanlity}}" name="quantity" placeholder="........" class="form-control"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="name" class=" form-control-label">Ngày nhập sản phẩm</label></div>
                                            <div class="col-12 col-md-12"><input type="date" id="text-input" value="{{$product->add_day}}" name="add_day" placeholder="........" class="form-control" ></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="name" class=" form-control-label">Ngày hết hạn</label></div>
                                            <div class="col-12 col-md-12"><input type="date" id="text-input" value="{{$product->expired_day}}" name="expired_day" placeholder="........" class="form-control" ></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">                                     
                                        <div class="form-group">
                                            <div class="col col-md-6"><label for="file-input" class=" form-control-label">Ảnh  đại diện</label></div>
                                            <div class="col-12 col-md-12">
                                                <input type="file" id="img" name="img" class="form-control-file hidden" onchange="changeImg(this)">
                                                <img id="avatar" class="thumbnail" style="cursor: pointer;" width="200px" height="200px" src={{asset('public/admin/images/product/'.$product->image)}}><br>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col col-md-6"><label for="file-input" class=" form-control-label">Ảnh liên quan</label></div>
                                            <div class="row">
                                                <div class="col-md-12 row">
                                                    @foreach ($Gallrey as $val)
                                                        <div class="col-md-4">
                                                            <img data-id="{{$val->id}}" id="file" style="width: 150px; height: 150px; cursor: pointer;" class="img_preview_gallery img_preview_gallery_{{$val->id}}" src="{{asset('public/admin/images/product')}}/{{$val->name}}" alt="">
                                                            <input hidden name="img_gallery_old_{{$val->id}}" value="{{$val->name}}" >
                                                            <input hidden name="id_gallery_{{$val->id}}" value="{{$val->id}}" >
                                                            <input hidden data-id="{{$val->id}}" name="img_gallery_{{$val->id}}"type="file" class="form-control-file input_file_{{$val->id}}" accept="image/*" multiple>
                                                        </div>
                                                    @endforeach                                          
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col col-md-6"><label for="select" class="form-control-label">An hien</label></div>
                                            <div class="col-12 col-md-12">
                                                <select name="status" id="select" class="form-control">
                                                    <option  @if ($product->status==1) selected @endif value="1">Hiện</option>
                                                    <option  @if ($product->status==0) selected @endif value="0">Ẩn</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col col-md-6"><label for="select" class=" form-control-label">Danh mục</label></div>
                                            <div class="col-12 col-md-12">
                                                <select name="category" id="select_cate" class="form-control">
                                                    @foreach ($cate as $val)
                                                        @if ($val->id == $product->category_id)
                                                            <option selected value="{{$val->id}}">{{$val->name}}</option> 
                                                        @else
                                                            <option value="{{$val->id}}">{{$val->name}}</option> 
                                                        @endif
                                                    @endforeach 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col col-md-6"><label for="select" class=" form-control-label">Danh mục con</label></div>
                                            <div class="col-12 col-md-12">
                                                <select name="child_cate_id" id="chid_cate" class="form-control">
                                                    @foreach ($child_cate as $val)
                                                        @if ($val->id == $product->chid_cate_id)
                                                            <option selected value="{{$val->id}}">{{$val->name}}</option> 
                                                        @else
                                                            <option value="{{$val->id}}">{{$val->name}}</option> 
                                                        @endif
                                                    @endforeach 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col col-md-6"><label for="name" class=" form-control-label">Mô tả</label></div>
                                    <div class="col-12 col-md-12"><textarea name="description" id="noidung" class="ckeditor">{!!$product->description!!}</textarea></div>
                                    <script type="text/javascript">
                                        var editor = CKEDITOR.replace('description',{
                                            language:'vi',
                                            filebrowserImageBrowseUrl: '../../editor/ckfinder/ckfinder.html?Type=Images',
                                            filebrowserFlashBrowseUrl: '../../admin/editor/ckfinder/ckfinder.html?Type=Flash',
                                            filebrowserImageUploadUrl: '../../admin/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                            filebrowserFlashUploadUrl: '../../admin/public/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                        });
                                    </script>
                                </div>
                                <input class="btn btn-success float-right" type="submit" value="Cập nhật">
                                </div>
                            <br>
                            </form>      
                        </div>          
                    </div><!-- .content -->
                </div><!-- .content -->
            </div><!-- .content -->
        </div><!-- .content -->
    </div><!-- .content -->
</div><!-- .content -->
@endsection