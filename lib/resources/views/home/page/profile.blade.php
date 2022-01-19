@include('home.layout.header')
@include('home.aside.menu')
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('public/home/img/banner/banner4.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Cart History</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Cart History</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shoping-cart spad">
        <div class="container">
            <form action="{{url('update-profile/'.$user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="text-center">
                            <img style="cursor: pointer; width: 360px; height: 360px;" id="imgUploadProfile" src="{{asset('public/admin/images/avatar/'.$user->image)}}" class="avatar-profile img-circle img-thumbnail" alt="avatar">
                            <h6>Chọn ảnh của bạn...</h6>
                            <input style="display: none;" name="imgInfoUser" id="OpenImgUploadProfile" type="file">
                            <input type="hidden" value="{{$user->image}}" name="imgInfoOld">
                        </div>
                        </hr><br>    
                        <ul class="list-group">
                            <li class="list-group-item text-muted">Hoạt động <i class="fa fa-dashboard fa-1x"></i></li>
                            <li class="list-group-item text-right"><span class="pull-left"><strong>Lượt mua hàng</strong></span> {{$count_order}}</li>
                            <li class="list-group-item text-right"><span class="pull-left"><strong>Điểm tích lũy</strong></span> {{$user['level']}}</li>
                            <li class="list-group-item text-right"><span class="pull-left"><strong>Cấp bậc</strong></span>Cấp bậc vàng</li>
                        </ul>
                    </div>    
                    <div class="col-sm-8 tab-pane active" id="home">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="first_name"><h5>Họ và tên</h5></label>
                                <input type="text" class="form-control input-text" name="fullname"  value="{{$user->fullname}}">
                                @error('fullname')<small class="alert-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="mobile"><h5>Số điện thoại</h5></label>
                                <input type="text" class="form-control input-text" name="phone" value="{{($user->phone==null)?"":"$user->phone"}}">
                                @error('phone')<small class="alert-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="address"><h5>Địa chỉ</h5></label>
                                <input type="text" class="form-control input-text" name="address" value="{{($user->address==null)?"":"$user->address"}}">
                                @error('address')<small class="alert-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <button type="submit" class="site-btn edit-info">Chỉnh sửa</button>
                        <button type="button" class="site-btn edit-info" data-toggle="modal" data-target="#changePass" style="margin-left:5px">Đổi mật khẩu</button>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-lg-12">
                    <h4 style="margin-bottom: 20px; margin-top: 100px;">Các đơn hàng của bạn</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã đơn hàng</th>
                                <th>Ngày mua</th>
                                <th>Tình trạng đơn hàng</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $stt = 1;
                            @endphp
                            @foreach ($order as $val)
                                <tr>
                                    <td>{{$stt++}}</td>
                                    <td class="shoping__cart__item">
                                       {{$val->order_code}}
                                    </td>
                                    <td class="shoping__cart__price ">
                                        {{date('d-m-Y', strtotime($val->order_date))}}
                                    </td>
                                    <td class="shoping__cart__price ">
                                        @if ($val->status == 0)
                                            Đang chờ xử lí
                                        @elseif($val->status == 1)
                                            Đã giao hàng
                                        @else
                                            Đơn hàng đã hủy
                                        @endif
                                    </td>
                                    <td class="shoping__cart__total ">
                                        <a class="btn" href="{{url('/history-cart/'.$val->order_code)}}">Xem đơn hàng</a>
                                    </td>

                                    @if ($val->status == 0)
                                        <td class="shoping__cart__total ">
                                            <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#largeModal1" style="margin-left:5px">Hủy đơn hàng</button>
                                            <div class="modal fade" id="largeModal1" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <form action="{{url('cart-cancel/'.$val->order_code)}}" method="post">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-md-12">
                                                                    <div class="form-group shadow-textarea">
                                                                        <textarea name="lido" class="form-control z-depth-1" rows="3" placeholder="Lí do bạn hủy đơn hàng..."></textarea>
                                                                    </div> 
                                                                </div>                                                         
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger mb-2" style="margin-left: 5px"> Hủy đơn hàng </button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        </td>          
                                    @else
                                        <td>

                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="changePass" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <form action="{{url('update-pass-user/' .$user->id)}}" method="post">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label for="first_name">Nhập mật khẩu mới</label>
                                        <input type="password" class="form-control input-text" name="password">
                                        @error('password')<small class="alert-danger">{{ $message }}</small>@enderror
                                    </div>

                                    <div class="col-xs-12">
                                        <label for="first_name">Nhập lại mật khẩu</label>
                                        <input type="password" class="form-control input-text" name="re-password">
                                        @error('re-password')<small class="alert-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>                                                        
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                <button type="submit" class="btn btn-danger mb-2" style="margin-left: 5px">Đổi mật khẩu</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </section>
    <script>
        $(document).ready(function(){
            $('#imgUploadProfile').click(function(){
                $('#OpenImgUploadProfile').click();
                previewURL(this)
                })
    
                function previewURL(input){
                if(input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#imgUploadProfile').attr('src',e.target.result)
                    }
                    reader.readAsDataURL(input.files[0]);
                }
                }
            })
        })
    </script>
@include('home.layout.footer')