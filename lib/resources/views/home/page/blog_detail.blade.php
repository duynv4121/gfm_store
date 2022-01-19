@include('home.layout.header')
@include('home.aside.menu')
    <!-- Blog Details Hero Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('public/home/img/banner/banner7.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog__details__hero__text">
                        <div class="breadcrumb__text">
                            <div class="breadcrumb__option">
                                <a href="{{url('/')}}">Trang chủ</a>
                                <span>Bài Viết</span>
                            </div>
                        </div>
                        {{-- <h2>Khoảnh khắc bạn cần loại bỏ tỏi khỏi thực đơn</h2> --}}
                        <ul>
                            <li>{{date('d/m/Y',strtotime($views_blog->post_day))}}</li>
                            <li>{{$views_blog->views}} Lượt xem</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5 order-md-1 order-2">
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
                            <img src="{{asset('public/home/img/banner/banner-aside1.jfif')}}" alt="">
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
                                            <span>{{date('d/m/Y H:i',strtotime($new->post_day))}}</span>
                                        </div>
                                    </a>
                                @endforeach                           
                            </div>
                        </div>

                        <div class="blog__sidebar__item">
                            <img src="{{asset('public/home/img/banner/banner-aside5.jpg')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 order-md-1 order-1">
                    @foreach($blogs as $blog)
                        <div class="blog__details__text">
                            <h3 style=color:#037841>{{$blog->name}}</h3>
                            <p>{!!$blog->content!!}</p>
                            <p>Kết thúc</p>
                        </div>
                    @endforeach
                    <div class="blog__details__content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="{{asset('public/admin/images/logo/logo.png')}}" alt="">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6>Đỉnh</h6>
                                        <span>Admin</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="blog__details__widget">
                                    <ul>
                                        <li><span>Danh mục:</span> Thức ăn</li>
                                        <li><span>Tags:</span> các tag</li>
                                    </ul>
                                    <div class="blog__details__social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                        <a href="#"><i class="fa fa-linkedin"></i></a>
                                        <a href="#"><i class="fa fa-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-title product__discount__title mt-5">
                        <h2 style="font-size:24px;">Bình luận bài viết</h2>
                    </div>
                    @if(count($comment) >= 1)
                    @foreach ($comment as $cm)
                        @php
                            $time1 = $cm->created_at;
                            $comment_time = $time1->diffForHumans($now);
                        @endphp
                        <div class="bg-light p-2 mt-2" style="border-bottom: 1px solid rgb(240, 240, 240);">
                            <div class="d-flex flex-row user-info">
                                <img class="rounded-circle" src="{{asset('public/admin/images/avatar/avatar.jpg')}}" width="80" height="50">
                                <div class="d-flex flex-column justify-content-start ml-2">
                                    <span class="d-block font-weight-bold name">{{$cm->name}}</span>               
                                    <span class="date text-black-50">{{date('d/m/Y H:i',strtotime($cm->created_at))}}</span>
                                    <span class="date text-black-50">{{$comment_time}}</span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <p class="comment-text">{{$cm->content}}</p>
                            </div>
                        </div>
                        @if(count($comment_rep) >= 1)
                            @foreach ($comment_rep as $cm_rep)
                            @php
                                $time2 = $cm_rep->created_at;
                                $com_rep_time = $time2->diffForHumans($now);
                            @endphp
                            @if($cm_rep->parent_comment == $cm->id)
                            <div class="rep_comment_box p-2 mt-2">
                                <div class="d-flex flex-row user-info">
                                    <img class="rounded-circle" src="{{asset('public/admin/images/logo/logo.png')}}" width="80" height="50">
                                    <div class="d-flex flex-column justify-content-start ml-2">
                                        <span class="d-block font-weight-bold name">{{$cm_rep->name}}</span>               
                                        <span class="date text-black-50">{{date('d/m/Y H:i',strtotime($cm_rep->created_at))}}</span>
                                        <span class="date text-black-50">{{$com_rep_time}}</span>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <p class="comment-text">{{$cm_rep->content}}</p>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        @endif
                    @endforeach
                    @else
                        <div class="bg-light p-2 mt-4" style="border-bottom: 1px solid rgb(240, 240, 240);">
                            <p>Hãy là người đầu tiên bình luận về bài viết</p>
                        </div>
                    @endif
                    <div class="bg-light mt-4 p-3">
                        <div class="blog__details__text">
                            <h4 style=color:#037841>Bình luận vể bài viết</h4>
                        </div>
                        <form method="POST" class="row">
                            <div class="col-lg-6">
                                <input type="text" name="name" class="form-control name_cmt mb-2" placeholder="Họ tên (bắt buộc)">
                                @error('name')<p class="alert-danger">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="email" class="form-control email_cmt" placeholder="Email (bắt buộc)">
                                @error('email')<p class="alert-danger">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="d-flex flex-row align-items-start ">
                                    <textarea rows="8" class="form-control ml-1 shadow-none textarea comment_content" name="content" placeholder="Mời bạn bình luận hoặc đặt câu hỏi"></textarea>
                                </div>
                                @error('content')<p class="alert-danger">{{ $message }}</p>@enderror
                                <div class="mt-2 text-right">
                                    <button class="btn btn-success btn-sm shadow-none send-comment" type="submit">Gửi bình luận</button>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    <!-- Related Blog Section Begin -->
    <section class="related-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related-blog-title">
                        <h2>Bài viết liên quan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($blog_offer as $offer)
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="{{asset('public/admin/images/blog')}}/{{$offer->image}}" alt="">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i>{{date('d/m/Y',strtotime($offer->post_day))}}</li>
                                    <li><i class="fa fa-eye"></i>{{$offer->views}} Lượt xem</li>
                                </ul>
                                <h5><a href="{{url('chi-tiet-bai-viet')}}/{{$offer->id}}/{{$offer->slug}}">{{$offer->name}}</a></h5>
                                <p>{{$offer->summary}} </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Blog Section End -->
@include('home.layout.footer')