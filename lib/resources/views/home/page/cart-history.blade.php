@include('home.layout.header')
@include('home.aside.menu')
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('home/img/banner/banner4.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Cart History</h2>
                        <div class="breadcrumb__option">
                            <a href="{{asset('/')}}">Home</a>
                            <span>Cart History</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 style="margin-bottom: 20px; margin-top: 100px;">Chi tiết đơn hàng của bạn</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $stt = 1;
                            @endphp
                            @foreach ($orderDetail as $val)
                                <tr>
                                    <td>{{$stt++}}</td>
                                    <td class="shoping__cart__item">
                                        @foreach ($product as $row)
                                            @if($row->id == $val->product_id)
                                                <img style="width: 150px; height: 100px;" src="{{asset('admin/images/product')}}/{{$row->image}}" alt="">
                                            @endif
                                        @endforeach
                                       {{$val->product_name}}
                                    </td>
                                    <td class="shoping__cart__price ">
                                        {{number_format($val->product_price)}}
                                    </td>
                                    <td class="shoping__cart__price ">
                                        {{$val->product_quanlity}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
@include('home.layout.footer')





