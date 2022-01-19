@include('home.layout.header')
@include('home.aside.menu')
@include('home.aside.slide')
<!-- Categories Section Start -->
<section class="categories mt-5">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach($category as $row)
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="{{asset('public/admin/images/category')}}/{{$row->image}}"></div>
                    <h5 class="cate-name"><a href="#">{{$row->name}}</a></h5>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Products New Section Start -->
<section class="featured spad mt-5">
    <div class="container">
        <div class="section-title">
            <h2>SẢN PHẨM MỚI NHẤT</h2>
        </div>
        <div class="row featured__filter">
            @foreach($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{asset('public/admin/images/product')}}/{{$product->image}}">
                        <ul class="featured__item__pic__hover">
                            <li><button><i class="fa fa-heart like-product" data-id = "{{$product->id}}"></i></button></li>
                            <li><a href="{{url('chi-tiet-san-pham')}}/{{$product->id}}/{{$product->slug}}"><i class="fa fa-retweet"></i></a></li>
                            <li><button class="add-to-cart" name="add-cart" data-id = "{{$product->id}}"><i class="fa fa-shopping-cart"></i></button></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
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
</section>
<!-- Products New Section End -->

<!-- Parallax Background 1 Begin -->
<div id="parallax-image">
    <div class="row h-100">
        <div class="col-md-12 align-self-center">
            <h1 class="text-center"><strong>Chào Mừng Đến Với Cửa Hàng</strong></h1>
        </div>
    </div>
</div>
<!-- Parallax Background 1 End -->

<!-- Products View Section Start -->
<section class="featured spad">
    <div class="container">
        <div class="section-title">
            <h2>SẢN PHẨM XEM NHIỀU</h2>
        </div>
        <div class="row featured__filter">
            @foreach($product_view as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{asset('public/admin/images/product')}}/{{$product->image}}">
                        <ul class="featured__item__pic__hover">
                            <li><button><i class="fa fa-heart like-product" data-id = "{{$product->id}}" ></i></button></li>
                            <li><a href="{{url('chi-tiet-san-pham')}}/{{$product->id}}/{{$product->slug}}"i class="fa fa-retweet"></i></a></li>
                            <li><button class="add-to-cart" name="add-cart" data-id = "{{$product->id}}"><i class="fa fa-shopping-cart"></i></button></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
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
</section>
<!-- Products View Section End -->

<!-- Products Like Section Start -->
<section class="featured spad">
    <div class="container">
        <div class="section-title">
            <h2>SẢN PHẨM YÊU THÍCH</h2>
        </div>
        <div class="row featured__filter">
            @foreach($product_like as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{asset('public/admin/images/product')}}/{{$product->image}}">
                        <ul class="featured__item__pic__hover">
                            <li><button><i class="fa fa-heart like-product" data-id = "{{$product->id}}" ></i></button></li>
                            <li><a href="{{url('chi-tiet-san-pham')}}/{{$product->id}}/{{$product->slug}}"i class="fa fa-retweet"></i></a></li>
                            <li><button class="add-to-cart" name="add-cart" data-id = "{{$product->id}}"><i class="fa fa-shopping-cart"></i></button></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
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
                                <h5>{{number_format($product->price_sales),''}} đ<small style="text-decoration: line-through; margin-left:10px"> {{number_format($product->price),''}} đ</small></h5>
                            </form> 
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Products Like Section End -->

<!-- Parallax Background 2 Start -->
<div id="parallax-image2">
    <div class="row h-100">
        <div class="col-md-12 align-self-center">
            <h1 class="text-center"><strong>Thực Phẩm Tươi</strong></h1>
        </div>
    </div>
</div>
<!-- Parallax Background 2 End -->

<!-- Latest Product Section Start -->
<section class="banner-container" style="padding: 3rem 18%;">
    <div class="banner">
        <img src="{{asset('public/home/img/banner/banner1.jpg')}}" alt="">
        <div class="content">
            <h3>Sản phẩm mới nhất</h3>
            <a href="{{url('/tat-ca-san-pham')}}" class="btn">Xem ngay</a>
        </div>
    </div>

    <div class="banner">
        <img src="{{asset('public/home/img/banner/banner7.jpg')}}" alt="">
        <div class="content">
            <span> </span>
            <h3>Bài viết mới nhất</h3>
            <a href="{{url('danh-muc-bai-viet/2/song-khoe')}}" class="btn">Xem ngay</a>
        </div>
    </div>
</section>
<!-- Latest Product Section End -->

<!-- Parallax Background 2 Start -->
<div id="parallax-image3">
    <div class="row h-100">
        <div class="col-md-12 align-self-center">
            <h1 class="text-center"><strong>Chia Sẻ Các Mẹo Nấu Ăn</strong> </h1>
        </div>
    </div>
</div>
<!-- Parallax Background 2 End -->

<!-- Blog Section Start -->
@include('home.aside.blog')
<!-- Blog Section End -->

@include('home.layout.footer')