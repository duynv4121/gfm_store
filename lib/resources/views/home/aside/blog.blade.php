 <!-- Blog Section Begin -->
<section class="from-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>Bài Viết</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{asset('public/admin/images/blog')}}/{{$blog->image}}" width="300" height="300" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> {{date('d/m/Y',strtotime($blog->post_day))}}</li>
                            <li><i class="fa fa-eye"></i>{{$blog->views}} Lượt xem</li>
                        </ul>
                        <h5><a href="{{url('chi-tiet-bai-viet')}}/{{$blog->id}}/{{$blog->slug}}">{{$blog->name}} </a></h5>
                        <p>{{$blog->summary}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Blog Section End -->