<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <title>Green Farm Mart | @yield('title')</title>
  {{-- <base href="{{asset('public/admin')}}/"> --}}
  <link rel="shortcut icon" href="images/logo/logo.png" type="image/png">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/admin/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('public/admin/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Ck Editor -->
  <script src="{{asset('public/admin/editor/ckeditor/ckeditor.js')}}"></script>
  <!-- Datepicker -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <!-- Morris Chart -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <!-- Toastr Alert -->
  <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('public/admin/images/logo/logo.png')}}" alt="adminLTELogo" style="max-width: 20%">
  </div>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Profile User Dropdown Menu -->
      <li class="nav-item dropdown mb-3">
        <a class="nav-link" data-toggle="dropdown" href="#" >
          <img src="{{asset('public/admin/images/avatar/'.Auth::user()->image)}}" class="img-circle elevation-2" width="35px" height="35px" alt="User Image">
        </a>
        <div class="dropdown-menu dropdown-menu-right profile-dropdown">
          <span class="dropdown-item dropdown-header">
            <div class="row">
              <div class="profile-img col-sm-4">
                <img src="{{asset('public/admin/images/avatar/'.Auth::user()->image)}}" class="img-circle elevation-2" width="50px" height="50px" alt="User Image">
              </div>
              <div class="profile-text col-sm-8">
                <h6>{{Auth::user()->fullname}}</h6><br>
                <p class="text-muted">{{Auth::user()->email}}</p>
              </div>
            </div>
          </span>
          <div class="dropdown-divider"></div>
          <a href="{{url('admin/profile/'.Auth::user()->id)}}" class="dropdown-item"><i class="fa fa-info-circle mr-2"></i>Th??ng tin c?? nh??n</a>
          <div class="dropdown-divider"></div>
          <a href="{{url('admin/update-profile/'.Auth::user()->id)}}" class="dropdown-item"><i class="fa fa-wrench mr-2"></i>C???p nh???t th??ng tin</a>
          <div class="dropdown-divider"></div>
          <a href="{{url('admin/logout')}}" onclick="return confirm('B???n c?? ch???c mu???n tho??t ????ng nh???p?')" class="dropdown-item"><i class="fa fa-sign-out mr-2"></i>????ng xu???t</a>
        </div>
      </li>
      <li class="nav-item mt-2">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{asset('/')}}" class="brand-link">
      <img src="{{asset('public/admin/images/logo/logo.png')}}"  alt="adminLTE Logo" class="brand-image img-circle elevation-3" style="width: 40px; height: 50px">
      <span class="brand-text font-weight-light">Green Farm Mart</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <!--Trang ch??? - Th???ng k??-->
          <li class="nav-item menu-open">
            <a href="{{asset('admin/home')}}" class="nav-link active">
              <i class="fas fa-chart-bar"></i>
              <p>Th???ng k??</p>
            </a>
          </li>
          
          <!--Danh m???c-->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Danh m???c
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('category.index')}}" class="nav-link">
                  <i class="fas fa-clipboard"></i>
                  <p> Qu???n l?? danh m???c</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('child-category.index')}}" class="nav-link">
                  <i class="fas fa-clipboard"></i>
                  <p> Qu???n l?? lo???i s???n ph???m</p>
                </a>
              </li>
              @can('them danh muc')
              <li class="nav-item">
                <a href="{{route('category.create')}}" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>Th??m danh m???c</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>

          <!--S???n ph???m-->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fab fa-product-hunt"></i>
              <p>
                S???n ph???m
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('product.index')}}" class="nav-link">
                  <i class="fas fa-clipboard"></i>
                  <p> Qu???n l?? s???n ph???m</p>
                </a>
              </li>
              @can('them san pham')
              <li class="nav-item">
                <a href="{{route('product.create')}}" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>Th??m</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>

          <!--????n h??ng-->
          @can('quan ly don hang')
          <li class="nav-item">
            <a href="{{url('admin/manage-order')}}" class="nav-link">
              <i class="fad fa-cart-arrow-down"></i>
              <p>
                Qu???n l?? ????n h??ng
                {{-- <i class="fas fa-angle-left right"></i> --}}
              </p>
            </a>
          </li>
          @endcan

          <!--M?? gi???m gi?? -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-barcode"></i>
              <p>
                M?? gi???m gi??
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('coupon.index')}}" class="nav-link">
                  <i class="fas fa-clipboard"></i>
                  <p>Qu???n l?? m?? gi???m gi??</p>
                </a>
              </li>
              @can('them ma giam gia')
              <li class="nav-item">
                <a href="{{route('coupon.create')}}" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>Th??m</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>

          <!--Blog-->
          <li class="nav-item">
            <a href="{{url('blog')}}" class="nav-link">
              <i class="far fa-newspaper"></i>
              <p>
                B??i vi???t
              <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('category_blog.index')}}" class="nav-link">
                  <i class="fas fa-clipboard"></i>
                  <p> Qu???n l?? danh m???c </p>
                </a>
              </li>
              @can('them danh muc bai viet')
              <li class="nav-item">
                <a href="{{route('category_blog.create')}}" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>Th??m danh m???c</p>
                </a>
              </li>
              @endcan
              <li class="nav-item">
                <a href="{{route('blog.index')}}" class="nav-link">
                  <i class="fas fa-clipboard"></i>
                  <p> Qu???n l?? b??i vi???t</p>
                </a>
              </li>
              @can('them bai viet')
              <li class="nav-item">
                <a href="{{route('blog.create')}}" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>Th??m b??i vi???t</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>

          <!--B??nh lu???n-->
          <li class="nav-item">
            <a href="{{url('admin/comment')}}" class="nav-link">
              <i class="fas fa-comments-alt"></i>
              <p>
                Qu???n l?? b??nh lu???n
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('quan ly binh luan san pham')
              <li class="nav-item">
                <a href="{{url('admin/comment')}}" class="nav-link">
                  <i class="fas fa-clipboard"></i>
                  <p>B??nh lu???n s???n ph???m</p>
                </a>
              </li>
              @endcan
              @can('quan ly binh luan bai viet')
              <li class="nav-item">
                <a href="{{url('admin/commentblog')}}" class="nav-link">
                  <i class="fas fa-clipboard"></i>
                    <p>B??nh lu???n b??i vi???t</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>

          <!--Feeship-->
          <li class="nav-item">
            <a href="{{url('admin/slide-banner')}}" class="nav-link">
              <i class="fas fa-shipping-fast"></i>
              <p>
                Ph?? v???n chuy???n
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('feeship.index')}}" class="nav-link">
                  <i class="fas fa-clipboard"></i>
                  <p>Qu???n l?? ph?? v???n chuy???n</p>
                </a>
              </li>
              @can('them phi van chuyen')
              <li class="nav-item">
                <a href="{{route('feeship.create')}}" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>Th??m</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>

          <!--Slide Banner-->
          <li class="nav-item">
            <a href="{{url('admin/slide-banner')}}" class="nav-link">
              <i class="far fa-presentation"></i>
              <p>
                Slide Banner
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('slide-banner.index')}}" class="nav-link">
                  <i class="fas fa-clipboard"></i>
                  <p> Qu???n l?? slide banner</p>
                </a>
              </li>
              @can('them slide')
              <li class="nav-item">
                <a href="{{route('slide-banner.create')}}" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>Th??m</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>

          <!--Th??nh vi??n-->
          @role('Admin')
          <li class="nav-item">
            <a href="{{url('admin/members')}}" class="nav-link">
              <i class="fal fa-users"></i>
              <p>
                Th??nh vi??n
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('members.index')}}" class="nav-link">
                  <i class="fas fa-clipboard"></i>
                  <p> Qu???n l?? th??nh vi??n</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('members.create')}}" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>Th??m</p>
                </a>
              </li>
            </ul>
          </li>
          @endrole

          <!--Kh??ch h??ng-->
          <li class="nav-item">
            <a href="{{url('admin/customer')}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Kh??ch h??ng
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('customer.index')}}" class="nav-link">
                  <i class="fas fa-clipboard"></i>
                  <p>Qu???n l?? kh??ch h??ng</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>