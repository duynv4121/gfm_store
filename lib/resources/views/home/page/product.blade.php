@include('home.layout.header')
@include('home.aside.menu')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('public/home/img/banner/banner10.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2> Sản Phẩm</h2>
                        <div class="breadcrumb__option">
                            <a href="{{url('/')}}">Trang chủ</a>
                            <span>Sản phẩm</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Lọc theo giá</h4>
                            <form>
                                <div class="price-range-wrap">
                                    <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                                        <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    </div>
                                    <div class="range-slider">
                                        <div class="price-input">
                                            <input type="text" id="amount_start" readonly>
                                            <input type="text" id="amount_end" readonly>
                                            <input type="hidden" name="start_price" id="start_price">
                                            <input type="hidden" name="end_price" id="end_price">
                                        </div>
                                    </div>
                                    <input type="submit" name="filter_price" value="Lọc" class="btn-sm btn-success">
                                </div>
                            </form>
                        </div>
                        <div class="sidebar__item">
                            <img src="{{asset('public/home/img/banner/banner-aside3.jpg')}}" alt="">
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Sản phẩm mới</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        @foreach($product_new as $new)
                                            <a href="{{url('chi-tiet-san-pham')}}/{{$new->id}}/{{$new->slug}}" class="latest-product__item">
                                                <div class="latest-product__item__pic" >
                                                    <img src="{{asset('public/admin/images/product')}}/{{$new->image}}" style="max-width:100px; max;height:90px">
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6>{{$new->name}}</h6>
                                                    @if(!$new->price_sales)
                                                        <span>{{number_format($new->price),' '}} đ</span>
                                                    @else
                                                    <span>{{number_format($new->price_sales),' '}} đ</span>
                                                    @endif
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                        @foreach($product_new as $new)
                                            <a href="{{url('chi-tiet-san-pham')}}/{{$new->id}}/{{$new->slug}}" class="latest-product__item">
                                                <div class="latest-product__item__pic" >
                                                    <img src="{{asset('public/admin/images/product')}}/{{$new->image}}" style="max-width:100px; max;height:100px">
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6>{{$new->name}}</h6>
                                                    @if(!$new->price_sales)
                                                        <span>{{number_format($new->price),' '}} đ</span>
                                                    @else
                                                    <span>{{number_format($new->price_sales),' '}} đ</span>
                                                    @endif
                                                </div>
                                            </a>
                                        @endforeach
                                
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <img src="{{asset('public/home/img/banner/banner-aside2.jpg')}}" alt="">
                        </div>
                        <div class="sidebar__item">
                            <img src="{{asset('public/home/img/banner/banner-aside1.jfif')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="filter__item">
                        <div class="crumbs mb-3">
                            <ul>
                                <li><a href="{{asset('/')}}"><i class="fa fa-home"></i>Trang chủ</a></li>
                                <li><a href="{{asset('/tat-ca-san-pham')}}">Tất cả sản phẩm</a></li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sắp xếp theo</span>
                                    <form>
                                        @csrf
                                        <select name="sort" id="sort">
                                            <option value="{{Request::url()}}?sort_by=default">-------Mặc định-------</option>
                                            <option value="{{Request::url()}}?sort_by=tang_dan">Giá tăng dần</option>
                                            <option value="{{Request::url()}}?sort_by=giam_dan">Giá giảm dần</option>
                                            <option value="{{Request::url()}}?sort_by=kytu_az">Từ A - Z</option>
                                            <option value="{{Request::url()}}?sort_by=kytu_za">Từ Z - A</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 mt-4">
                                <div class="filter__found">
                                    <h6><span>{{count($total_products)}}</span> Sản phẩm</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3 mt-4">
                                <div class="filter__option" id="myTab" role="tablist">
                                    <a id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><span class="icon_grid-2x2"></span></a>
                                    <a id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><span class="icon_ul"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                @foreach($products as $product)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg"  data-setbg="{{asset('public/admin/images/product')}}/{{$product->image}}" >
                                            <ul class="product__item__pic__hover">
                                                <li><button><i class="fa fa-heart like-product" data-id = "{{$product->id}}" ></i></button></li>
                                                <li><a href="{{url('chi-tiet-san-pham')}}/{{$product->id}}/{{$product->slug}}"i class="fa fa-retweet"></i></a></li>
                                                <li><button class="add-to-cart" name="add-cart" data-id = "{{$product->id}}"><i class="fa fa-shopping-cart"></i></button></li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6><a href="{{url('chi-tiet-san-pham')}}/{{$product->id}}/{{$product->slug}}">{{$product->name}}</a></h6>
                                            @if(!$product->price_sales)
                                            <form>
                                                @csrf
                                                <input type="hidden" value="{{$product->id}}" class="product_id" >
                                                <input type="hidden" value="{{$product->id}}" class="cart_product_id_{{$product->id}}" >
                                                <input type="hidden" value="{{$product->name}}" class="cart_product_name_{{$product->id}}" >
                                                <input type="hidden" value="{{$product->image}}" class="cart_product_image_{{$product->id}}" >
                                                <input type="hidden" value="{{$product->price}}" class="cart_product_price_{{$product->id}}" >
                                                <input type="hidden" name="amount" min="1" value="1" class="cart_product_amount_{{$product->id}}">
                                                <input type="hidden" value="{{$product->quanlity}}" class="cart_product_quanlity_total_{{$product->id}}">  
                                                <h5>{{number_format($product->price),''}} đ</h5>
                                            </form> 
                                        @else
                                            <form>
                                                @csrf
                                                <input type="hidden" value="{{$product->id}}" class="product_id" >
                                                <input type="hidden" value="{{$product->id}}" class="cart_product_id_{{$product->id}}" >
                                                <input type="hidden" value="{{$product->name}}" class="cart_product_name_{{$product->id}}" >
                                                <input type="hidden" value="{{$product->image}}" class="cart_product_image_{{$product->id}}" >
                                                <input type="hidden" value="{{$product->price_sales}}" class="cart_product_price_{{$product->id}}" >
                                                <input type="hidden" name="amount" min="1" value="1" class="cart_product_amount_{{$product->id}}">  
                                                <input type="hidden" value="{{$product->quanlity}}" class="cart_product_quanlity_total_{{$product->id}}">
                                                <h5>{{number_format($product->price_sales),''}} đ
                                                <small style="text-decoration: line-through; margin-left:10px"> {{number_format($product->price),''}} đ</small></h5>
                                            </form> 
                                        @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                                @foreach($products as $product)
                                <div class="col-lg-10 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <div class="product__item__pic set-bg"  data-setbg="{{asset('public/admin/images/product')}}/{{$product->image}}">
                                                    <ul class="product__item__pic__hover">
                                                        <li><button><i class="fa fa-heart like-product" data-id = "{{$product->id}}" ></i></button></li>
                                                        <li><a href="{{url('chi-tiet-san-pham')}}/{{$product->id}}/{{$product->slug}}"i class="fa fa-retweet"></i></a></li>
                                                        <li><button class="add-to-cart" name="add-cart" data-id = "{{$product->id}}"><i class="fa fa-shopping-cart"></i></button></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="product__item__text">
                                                    <h6><a href="{{url('chi-tiet-san-pham')}}/{{$product->id}}/{{$product->slug}}">{{$product->name}}</a></h6>
                                                    <h6>Lượt xem: {{$product->views}}</h6>
                                                    <h6>Tình trạng: {{$product->quanlity >= 1 ? "Còn hàng" : "Tạm hết hàng"}}</h6>
                                                    @if(!$product->price_sales)
                                                    <form>
                                                        @csrf
                                                        <input type="hidden" value="{{$product->id}}" class="product_id" >
                                                        <input type="hidden" value="{{$product->id}}" class="cart_product_id_{{$product->id}}" >
                                                        <input type="hidden" value="{{$product->name}}" class="cart_product_name_{{$product->id}}" >
                                                        <input type="hidden" value="{{$product->image}}" class="cart_product_image_{{$product->id}}" >
                                                        <input type="hidden" value="{{$product->price}}" class="cart_product_price_{{$product->id}}" >
                                                        <input type="hidden" name="amount" min="1" value="1" class="cart_product_amount_{{$product->id}}">
                                                        <input type="hidden" value="{{$product->quanlity}}" class="cart_product_quanlity_total_{{$product->id}}">
                                                        <h5>{{number_format($product->price),''}} đ</h5>
                                                    </form> 
                                                    @else
                                                    <form>
                                                        @csrf
                                                        <input type="hidden" value="{{$product->id}}" class="product_id" >
                                                        <input type="hidden" value="{{$product->id}}" class="cart_product_id_{{$product->id}}" >
                                                        <input type="hidden" value="{{$product->name}}" class="cart_product_name_{{$product->id}}" >
                                                        <input type="hidden" value="{{$product->image}}" class="cart_product_image_{{$product->id}}" >
                                                        <input type="hidden" value="{{$product->price_sales}}" class="cart_product_price_{{$product->id}}" >
                                                        <input type="hidden" name="amount" min="1" value="1" class="cart_product_amount_{{$product->id}}">
                                                        <input type="hidden" value="{{$product->quanlity}}" class="cart_product_quanlity_total_{{$product->id}}">  
                                                        <h5>{{number_format($product->price_sales),''}} đ
                                                        <small style="text-decoration: line-through; margin-left:10px"> {{number_format($product->price),''}} đ</small></h5>
                                                    </form> 
                                                 @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center" style="backgroud-color:red;">{{ $products->links() }}</div>
                    <div class="product__discount mt-5">
                        <div class="section-title product__discount__title">
                            <h2 style="font-size:24px">Khuyến mãi</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @foreach($product_sales as $sales)
                                    @if($sales->price_sales)
                                        <div class="col-lg-4">
                                            <div class="product__discount__item">
                                                <div class="product__discount__item__pic set-bg"
                                                    data-setbg="{{asset('public/admin/images/product')}}/{{$sales->image}}" >
                                                    <div class="product__discount__percent">-Giảm</div>
                                                    <ul class="product__item__pic__hover">
                                                        <li><button><i class="fa fa-heart like-product" data-id = "{{$sales->id}}"></i></button></li>
                                                        <li><a href="{{url('chi-tiet-san-pham')}}/{{$sales->id}}/{{$sales->slug}}"><i class="fa fa-retweet"></i></a></li>
                                                        <li><button class="add-to-cart" name="add-cart" data-id = "{{$sales->id}}"><i class="fa fa-shopping-cart"></i></button></li>
                                                    </ul>
                                                </div>
                                                <div class="product__discount__item__text">
                                                @if(!$sales->price_sales)
                                                    <form>
                                                        @csrf
                                                        <input type="hidden" value="{{$sales->id}}" class="product_id" >
                                                        <input type="hidden" value="{{$sales->id}}" class="cart_product_id_{{$sales->id}}" >
                                                        <input type="hidden" value="{{$sales->name}}" class="cart_product_name_{{$sales->id}}" >
                                                        <input type="hidden" value="{{$sales->image}}" class="cart_product_image_{{$sales->id}}" >
                                                        <input type="hidden" value="{{$sales>price}}" class="cart_product_price_{{$sales->id}}" >
                                                        <input type="hidden" value="{{$sales->quanlity}}" class="cart_product_quanlity_total_{{$sales->id}}">
                                                        <input type="hidden" name="amount" min="1" value="1" class="cart_product_amount_{{$sales->id}}">  
                                                    </form> 
                                                @else
                                                    <form>
                                                        @csrf
                                                        <input type="hidden" value="{{$sales->id}}" class="product_id" >
                                                        <input type="hidden" value="{{$sales->id}}" class="cart_product_id_{{$sales->id}}" >
                                                        <input type="hidden" value="{{$sales->name}}" class="cart_product_name_{{$sales->id}}" >
                                                        <input type="hidden" value="{{$sales->image}}" class="cart_product_image_{{$sales->id}}" >
                                                        <input type="hidden" value="{{$sales->price_sales}}" class="cart_product_price_{{$sales->id}}" >
                                                        <input type="hidden" value="{{$sales->quanlity}}" class="cart_product_quanlity_total_{{$sales->id}}">
                                                        <input type="hidden" name="amount" min="1" value="1" class="cart_product_amount_{{$sales->id}}">  
                                                    </form> 
                                                @endif
                                                    <span>{{$sales->name_cate}}</span>
                                                    <h5><a href="{{url('chi-tiet-san-pham')}}/{{$sales->id}}/{{$sales->slug}}">{{$sales->name}}</a></h5>
                                                    <div class="product__item__price">{{number_format($sales->price_sales),''}} đ<span>{{number_format($sales->price),''}} đ</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@include('home.layout.footer')