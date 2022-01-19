@include('home.layout.header')
@include('home.aside.menu')
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('public/home/img/banner/banner2.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Tin Tức</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Trang chủ</a>
                            <span>Bài viết</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__item">
                            <h4>Danh mục bài viết</h4>
                            <ul>
                                @foreach($cate_blogs as $cate_blog )
                                  <li><a href="{{url('danh-muc-bai-viet')}}/{{$cate_blog->id}}/{{$cate_blog->slug}}">{{$cate_blog->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <img src="{{asset('public/home/img/banner/banner-aside4.jpg')}}" alt="">
                        </div>
                        <div class="blog__sidebar__item">
                            <h4> Tin gần đây</h4>
                            <div class="blog__sidebar__recent">
                                @foreach($blog_new as $new )
                                    <a href="{{url('chi-tiet-bai-viet')}}/{{$new->id}}/{{$new->slug}}" class="blog__sidebar__recent__item">
                                        <div class="blog__sidebar__recent__item__pic">
                                            <img src="{{asset('public/admin/images/blog')}}/{{$new->image}}" width="100px" height="70px" alt="">
                                        </div>
                                        <div class="blog__sidebar__recent__item__text">
                                            <h6>{{$new->name}}</h6>
                                            <span>{{date('d/m/Y H:i',strtotime($new->created_at))}}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="blog__sidebar__item">
                            <img src="{{asset('public/home/img/banner/banner-aside6.jpg')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="row">
                        @if (count($blogs) >= 1)
                        @foreach($blogs as $blog)
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="{{asset('public/admin/images/blog')}}/{{$blog->image}}">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i>{{date('d/m/Y',strtotime($blog->post_day))}}</li>
                                        <li><i class="fa fa-eye"></i>{{$blog->views}} Lượt xem</li>
                                    </ul>
                                    <h5><a href="{{url('chi-tiet-bai-viet')}}/{{$blog->id}}/{{$blog->slug}}">{{$blog->name}}</a></h5>
                                    <p>{{$blog->summary}}</p>
                                    <a href="{{url('chi-tiet-bai-viet')}}/{{$blog->id}}/{{$blog->slug}}" class="blog__btn"> Đọc thêm<span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-lg-12">
                            <div class="pagination">
                            {!! $blogs->links() !!}
                            </div>
                        </div>
                        @else
                        <p>Danh mục này chưa có bài viết</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@include('home.layout.footer')