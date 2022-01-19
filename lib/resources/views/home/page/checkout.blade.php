@include('home.layout.header')
@include('home.aside.menu')
 <!-- Checkout Section Begin -->
 <section class="breadcrumb-section set-bg" data-setbg="{{asset('public/home/img/banner/banner11.jpg')}}"></section>
 <section class="checkout spad">
    <div class="container">
        <div class="row">
            @if (!Session::get('coupon'))
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Bạn có mã giảm giá không? <a href="{{url('show-cart')}}">Nhấn vào đây</a> để nhập mã.
                    </h6>
                </div>  
            @endif
        </div>
        <div class="checkout__form">
            <h4>Hoàn Thành Thanh Toán</h4>
            <form action="#">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row" style="border: 1px solid #d7d7d7; padding: 10px; border-radius: 5px">
                            <!-- <div > -->
                            <form>
                                @csrf
                                <div class="col-lg-4">
                                    <div class="checkout__input">
                                    <p>Tỉnh / Thành Phố<span>*</span></p>
                                        <select class="form-control choose city" name="city" id="city">
                                            @if (Session::get('location'))
                                                @foreach (Session::get('location') as $val)
                                                    @foreach($citys as $key => $city)
                                                        @if ($val['city_id'] == $city->id)
                                                            <option selected value="{{$city->id}}">{{$city->name}}</option>
                                                        @else
                                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @else
                                                <option value="">Chọn tỉnh thành phố</option>
                                                @foreach($citys as $key => $city)
                                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="checkout__input">
                                        <p>Quận / Huyện<span>*</span></p>
                                            <select class="form-control choose district" name="district" id="district" style="display:block;">
                                                @if (Session::get('location'))
                                                    @foreach (Session::get('location') as $val)
                                                        @foreach($district as $key => $row)
                                                            @if ($val['district_id'] == $row->id)
                                                                <option selected value="{{$row->id}}">{{$row->name}}</option>
                                                            @else
                                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @else
                        
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                <div class="col-lg-4">
                                    <div class="checkout__input">
                                    <p>Xã / Phường<span>*</span></p>
                                        <select class="form-control village" name="village" id="village">
                                            @if (Session::get('location'))
                                                @foreach (Session::get('location') as $val)
                                                    @foreach($village as $key => $row)
                                                        @if ($val['village_id'] == $row->id)
                                                            <option selected value="{{$row->id}}">{{$row->name}}</option>
                                                        @else
                                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @else
                    
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <input type="button" name="calculate_order" class="site-btn check_out calculate_delivery" value="Kiểm tra" >
                            <!-- </div> -->
                        </div>
                        <div class="row mt-3">
                            <input type="hidden" class="id_customer" value="{{Auth::guard('loyal_customer')->id()}}">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Họ<span>*</span></p>
                                    <input type="text" name="last" class="last">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Tên<span>*</span></p>
                                    <input type="text" value="{{($user->fullname==null)?"":"$user->fullname"}}" name="first" class="first">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input mt-4">
                            <p>Địa chỉ cụ thể<span>*</span></p>
                            <input type="text" value="{{($user->address==null)?"":"$user->address"}}" name="address" class="address">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Số điện thoại<span>*</span></p>
                                    <input type="text" value="{{($user->phone==null)?"":"$user->phone"}}"  name="phone" class="phone">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" value="{{($user->email==null)?"":"$user->email"}}"  name="email" class="email">
                                </div>
                            </div>
                        </div> 
                        <div class="checkout__input">
                            <p>Ghi chú<span>*</span></p>
                            <input type="text" name="note" placeholder="Nội dung" style="height:100px" class="note"> 
                        </div>
                        <input type="hidden" class="mark" value="{{$user->level}}">
                        <button type="button" class="btn site-btn doi-diem">Đổi điểm tích lũy</button>

                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Đơn hàng của bạn</h4>
                            <div class="checkout__order__products">Sản phẩm <span>Tổng</span></div>
                            @php $total = 0; @endphp
                            @if(Session::get('cart'))
                                @foreach(Session::get('cart') as $cart)
                                    @php
                                        $subtotal = $cart['product_price'] * $cart['product_amount'];
                                        $total += $subtotal;
                                    @endphp
                                    <!-- {{number_format($subtotal)}} đ -->
                                @endforeach           
                            @endif
                                <ul>
                                    <li>Giá tạm thời <span>{{number_format($total),' '}} đ</span></li>

                                    <hr>

                                    <div class="checkout__order__products">Số tiền giảm thêm</div>
                                   
                                    @if(Session::get('money'))
                                        <li><a href="{{url('/delete-mark-money/')}}"><i class="fa fa-times"></i></a> Tiền tích lũy 
                                            @foreach(Session::get('money') as $key => $val)
                                                <span>{{number_format($val['money'])}} đ</span>
                                                @php
                                                    $total_money_mark = $val['money'];
                                                @endphp
                                            @endforeach
                                            
                                        </li>
                                    @endif

                                    @if(Session::get('coupon'))
                                        @foreach(Session::get('coupon') as $key =>$cou)                      
                                        <li>
                                            @if($cou['coupon_condition']==1)
                                            <a class="cart_quantity_delete" href="{{url('/delete-coupon/')}}"><i class="fa fa-times"></i></a>
                                                Mã giảm giá<span> {{$cou['coupon_number']}}% / Tổng đơn hàng</span>
                                                <p>
                                                    @php
                                                        $total_coupon = ($total*$cou['coupon_number']/100);
                                                        echo '<p><li>Giảm'.'<span>'.number_format($total_coupon).' đ</span>'.'</li></p>';
                                                    @endphp
                                                </p>
                                                    <li>Tổng tiền sau khi giảm
                                                        @php
                                                            if (Session::get('money')) {
                                                                $total_coupon = $total- $total_coupon - $total_money_mark; 
                                                            }else {
                                                                $total_coupon = $total- $total_coupon;
                                                            }
                                                        
                                                        @endphp
                                                        <span>{{ number_format($total_coupon)}} đ</span>
                                                    </li>
                                                </p>
                                            @elseif($cou['coupon_condition']==2)
                                            <a class="cart_quantity_delete" href="{{url('/delete-coupon/')}}"><i class="fa fa-times"></i></a>
                                            Mã giảm giá<span> Giảm {{number_format($cou['coupon_number'])}} đ</span> 
                                            <p>
                                                @php
                                                    if (Session::get('money')) {
                                                        $total_coupon = $total - $cou['coupon_number'] - $total_money_mark;
                                                    }else {
                                                        $total_coupon = $total - $cou['coupon_number'];
                                                    }
                                                   
                                                @endphp
                                                </li>
                                            </p>
                                            </p>
                                            <li>Tổng tiền sau khi giảm:
                                                <span>{{number_format($total_coupon)}} vnđ</span>
                                            </li>
                                    </p>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                        <hr>
                        
                        @if(Session::get('fee'))
                            <div class="checkout__order__products">Số tiền thanh toán thêm</div>
                            <li> <a class="cart_quantity_delete" href="{{url('/delete-fee/')}}"><i class="fa fa-times"></i></a> Vận chuyển:
                                <span>{{number_format(Session::get('fee'))}} vnđ</span>
                                @php $total_after_fee = $total + Session::get('fee'); @endphp
                            </li>
                            <hr>
                        @endif

                       
                    
                    </p>
                    @if(Session('cart'))
                    <li>Tổng giỏ hàng:
                        <span>
                        @php
                            if(Session::get('fee') && !Session::get('coupon') && Session::get('money')){
                                $total_after = $total_after_fee - $total_money_mark;
                                echo  number_format($total_after);
                            }elseif(!Session::get('fee') && Session::get('coupon') && Session::get('money')){
                                $total_after =  $total_coupon;
                                echo  number_format($total_after);
                            }elseif(Session::get('fee') && Session::get('coupon') && Session::get('money')){
                                // $total_after =  $total_coupon;
                                $total_after =  $total_coupon + Session::get('fee');
                                echo  number_format($total_after);
                            }elseif(!Session::get('fee') && !Session::get('coupon') && Session::get('money')){
                                $total_after =  $total - $total_money_mark;
                                echo  number_format($total_after);
                            }elseif(Session::get('fee') && !Session::get('coupon')){
                                $total_after = $total_after_fee;
                                echo  number_format($total_after);
                            }elseif(!Session::get('fee') && Session::get('coupon')){
                                $total_after =  $total_coupon;
                                echo  number_format($total_after);
                            }elseif(Session::get('fee') && Session::get('coupon')){
                                $total_after =  $total_coupon;
                                $total_after =  $total_coupon + Session::get('fee');
                                echo  number_format($total_after);
                            }elseif(!Session::get('fee') && !Session::get('coupon')){
                                $total_after =  $total;
                                echo  number_format($total_after);
                            }
                        @endphp
                        vnđ</span>
                        @php
                            $vnd_to_usd = $total_after/23083;
                        @endphp
                        <input hidden id="vnd_to_usd" type="text" value="{{round($vnd_to_usd,2)}}">
                    </li>
                    @endif
                </p>
                    {{-- <li>Tiền sau khi giảm:<span>{{$total}}</span></li> --}}
                </ul>
                            
                            @if(Session::get('fee'))
                                <input type="hidden" class="order_feeship" name="order_feeship" value="{{Session::get('fee')}}">
                            @else
                            <input type="hidden" class="order_feeship" name="order_feeship" value="25000">
                            @endif
                            @if(Session::get('coupon'))
                                @foreach(Session::get('coupon') as $key => $cou)
                                    <input type="hidden" class="order_coupon" name="order_coupon" value="{{$cou['coupon_code']}}">
                                @endforeach
                            @else
                                <input type="hidden" class="order_coupon" name="order_coupon" value="Không có mã giảm giá">
                            @endif

                            @if(Session::get('money'))
                                @foreach(Session::get('money') as $key => $money)
                                    <input type="hidden" class="mark_to_money" value="{{$money['mark']}}">
                                @endforeach
                            @else
                                <input type="hidden" class="mark_to_money" value="0">
                            @endif
                            
                            
                            <div style="margin-top: 10px" id="paypal-button"></div>
                            <button type="button" name="send_order" class="site-btn check_out send_order">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@include('home.layout.footer')