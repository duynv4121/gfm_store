<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Green Farm Mart | Chuổi siêu thị cung cấp thực phẩm sạch</title>
    <!-- Logo Title -->
    <link rel="shortcut icon" href="{{asset('public/admin/images/logo/logo.png')}}" type="image/png">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- Font Awesome -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('public/home/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/home/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/home/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/home/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/home/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/home/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/home/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/home/css/comment.css')}}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper" style="z-index: 2000">
        <div class="humberger__menu__logo">
            <a href="#"><img src="{{asset('public/admin/images/logo/logo.png')}}" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="{{url('/')}}"><i class="fa fa-home"></i></a></li>
                <li><a href="{{url('show-cart')}}"><i class="fa fa-shopping-bag"></i>
                    <span>
                        @if(Session::get('cart'))
                            {{count(Session::get('cart'))}}
                        @endif
                        0
                    </span></a>
                </li>
            </ul>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__auth">
                <a href="{{url('login')}}"><i class="fa fa-user"></i>Đăng nhập</a>
            </div> 
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="{{url('/')}}">Trang chủ</a></li>
                <li><a href="{{url('/tat-ca-san-pham')}}">Sản phẩm</a></li>
                <li><a href="#">Bài viết</a>
                    <ul class="header__menu__dropdown">
                        @foreach ($cate_blog as $val)
                        <li><a href="{{url('danh-muc-bai-viet')}}/{{$val->id}}/{{$val->slug}}">{{$val->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="{{url('contact')}}">Liên hệ</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> greenmart@gmail.com</li>
                <li>Chào mùng đến với cưa hàng Green Farm Mart</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> greenmart@gmail.com</li>
                                <li>Chào mùng đến với cưa hàng Green Farm Mart</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__auth">
                                @if(Auth::guard('loyal_customer')->check())
                                    <div class="header__top__right__language_user">
                                        {{Auth::guard('loyal_customer')->user()->fullname}}
                                        <ul>
                                            <li><a href="{{url('/profile/'.Auth::guard('loyal_customer')->id())}}"><i class="fa fa-user"></i>Cá nhân</a></li>
                                            <li><a href="{{url('logout')}}"><i class="fas fa-sign-out-alt"></i> Thoát</a></li>
                                        </ul>
                                    </div>
                                @elseif (Auth::check())
                                    <div class="header__top__right__language_user">
                                        {{Auth::user()->fullname}}
                                        <ul>
                                            <li><a href="{{url('logout')}}"><i class="fa fa-user"></i>Cá nhân</a></li>
                                            <li><a href="{{url('logout')}}"><i class="fas fa-sign-out-alt"></i> Thoát</a></li>
                                        </ul>
                                    </div>
                                @else
                                    <a href="{{url('login')}}"><i class="fa fa-user"></i>Đăng nhập</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{url('/')}}">
                            <img src="{{asset('public/admin/images/logo/logo.png')}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="{{url('/')}}">Trang Chủ</a></li>
                            <li><a href="{{url('/tat-ca-san-pham')}}">Sản Phẩm</a></li>
                            <li><a style="cursor: pointer">Bài viết</a>
                                <ul class="header__menu__dropdown" style="z-index: 3000">
                                    @foreach ($cate_blog as $val)
                                    <li><a href="{{url('danh-muc-bai-viet')}}/{{$val->id}}/{{$val->slug}}">{{$val->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="{{url('contact')}}">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-2">
                    <div class="header__cart">
                        <ul>
                            <li><a href="{{url('/')}}"><i class="fa fa-home"></i></a></li>
                            <li><a href="{{url('show-cart')}}"><i class="fa fa-shopping-bag"></i>
                                <span class="count_cart">
                                    @if(Session::get('cart'))
                                        {{count(Session::get('cart'))}}
                                    @endif
                                    0
                                </span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->