<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CommentBlogRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\childCate;
use App\Models\Blog;
use App\Models\CommentBlog;
use App\Models\CategoryBlog;
use Carbon\Carbon;
use Toastr;

class BlogController extends Controller
{
    public function Blogs($id)
    {
        $category = Category::where('status','=',1)->get();
        $child_cate = childCate::where('status','=',1)->get();
        $cate_blogs = CategoryBlog::get();
        $blog_new = Blog::orderbyDesc('id')->paginate(3);
        if($id){
            $blogs = Blog::where('category_id',$id)->paginate(6);
        }else{
            $blogs = Blog::paginate(6);
        }
        $data = [
            'category' => $category,
            'cate_blogs' => $cate_blogs,
            'blogs' => $blogs,
            'blog_new' => $blog_new,
            'child_cate' => $child_cate,
        ];
        return view('home.page.blog',$data);
    }

    public function BlogDetail($id)
    {
        Carbon::setLocale('vi');
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $category = Category::where('status','=',1)->get();
        $cate_blogs = CategoryBlog::get();
        $child_cate = childCate::where('status','=',1)->get();
        $blog_new = Blog::orderbyDesc('id')->paginate(3);
        $blogs = Blog::where('id',$id)->limit(1)->get();
        $comment = CommentBlog::where('blog_id',$id)->where('parent_comment','=',0)->orderBy('created_at','DESC')->get();  
        $comment_rep = CommentBlog::where('blog_id',$id)->where('parent_comment','>',0)->orderBy('created_at','DESC')->get();
        $views_blog = Blog::where('id',$id)->first();
        $views_blog->views = $views_blog->views +1;
        $views_blog->save();
        foreach($blogs as $blog){
            $category_id = $blog->category_id;
        }
        $blog_offer = Blog::where('category_id',$category_id)->whereNotIn('id',[$id])->paginate(3);
        $data = [
            'category' => $category,
            'cate_blogs' => $cate_blogs,
            'now' => $now,
            'blogs' => $blogs,
            'blog_new' => $blog_new,
            'blog_offer' => $blog_offer,
            'comment' => $comment,
            'comment_rep' => $comment_rep,
            'views_blog' => $views_blog,
            'child_cate' => $child_cate
        ];
        return view('home.page.blog_detail',$data);
    }

    public function blogComment(CommentBlogRequest $request, $id){
        $comment = new CommentBlog;
        $comment->blog_id = $id;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->content = $request->content;
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        $comment->created_at = $dt->toDayDateTimeString();
        $comment->status = 0;
        $comment->parent_comment = 0;
        $comment->save();
        return back();
    }
}