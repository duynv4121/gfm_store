@extends('admin.layout.index')
@section('title','Thêm phí vận chuyển')
@section('content')
<div class="content-wrapper">
    <div class="content mt-2">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3><strong>Thêm phí vận chuyển</strong> </h3>
                        </div>
                        <div class="card-body card-block">
                            <form action="{{route('feeship.store')}}" method="post" enctype="multipart/form-data"
                                class="form-horizontal">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <!-- @method('PATCH') -->
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Chọn tỉnh thành</label></div>
                                    <div class="col-12 col-md-9">
                                        <select name="city" id="city" class="form-control choose city">
                                            <option value="0">Chọn Thành phố/Tỉnh</option>
                                            @foreach ($citys as $val)
                                                <option value="{{$val->id}}">{{$val->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Chọn quận huyện</label></div>
                                    <div class="col-12 col-md-9">
                                        <select name="district" id="district" class="form-control choose district">
                                        </select>
                                        @error('district')<small class="alert-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="select" class=" form-control-label">Chọn xã phường</label></div>
                                    <div class="col-12 col-md-9">
                                        <select name="village" id="village" class="form-control village">
                                        </select>
                                        @error('village')<small class="alert-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="name" class=" form-control-label">Phí vận chuyển</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" value="{{old('feeship')}}" name="feeship" placeholder="Phí vận chuyển" class="form-control">
                                        @error('feeship')<small class="alert-danger">{{ $message }}</small>@enderror
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