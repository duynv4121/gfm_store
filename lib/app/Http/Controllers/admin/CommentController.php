<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\CommentBlog;
use Carbon\Carbon;
use Toastr;

class CommentController extends Controller
{
    /*--------------------BÌNH LUẬN VÀ ĐÁNH GIÁ SẢN PHẨM--------------------*/

    public function getComment(){
        $data = Rating::join('product','rating.product_id','=','product.id')
                            ->select('rating.*','product.name','product.image')
                            ->selectRaw('count(*) as total, product_id')
                            // ->orderBy('rating.time','asc')
                            ->groupBy('product_id')
                            ->get();   
        return view('admin.comment.comment_product',compact('data'));
    }

    public function detailComment($id){
        $data = Rating::where('product_id',$id)->where('parent_comment','=',0)->orderBy('status','DESC')->orderBy('created_at','DESC')->get();
        $data_rep = Rating::where('product_id',$id)->where('parent_comment','>',0)->orderBy('created_at','DESC')->get();
        return view('admin.comment.comment_product_detail',compact('data','data_rep'));
    }

    public function delComment(Request $request){
        $data = $request->all();
        if(isset($data['checkbox'])){
            foreach($data['checkbox'] as $id){
                $comment = Rating::find($id);
                $comment->delete();
            }
            Toastr::success('Xóa bình luận thành công', 'Thành công');
            return back();
        }else{
            Toastr::error('Chọn ít nhất 1 bình luận để xóa', 'Thất bại');
            return back();
        }
    }

    public function allowCommentPro(Request $request){
        $data = $request->all();
        $comment = Rating::find($data['comment_id']);
        $comment->status = $data['comment_status'];
        $comment->save();
    }

    public function replyCommentPro(Request $request){
        $data = $request->all();
        $comment = new Rating();
        $comment->rating = 0;
        $comment->name = 'GFM Store';
        $comment->email = 'admin@gfmstore.com';
        $comment->content = $data['reply_comment_product'];
        $comment->product_id = $data['product_id'];
        $comment->parent_comment = $data['comment_id'];
        $comment->status = 0;
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        $comment->created_at = $dt->toDayDateTimeString();
        $comment->save();
        Toastr::success('Trả lời bình luận thành công', 'Thành công');
    }

    /*--------------------BÌNH LUẬN BÀI VIẾT--------------------*/

    public function getCommentBlog(){
        $data = CommentBlog::join('blog','comment_blog.blog_id','=','blog.id')
                            ->select('comment_blog.*','blog.name','blog.image')
                            ->selectRaw('count(*) as total, blog_id')
                            ->orderBy('comment_blog.created_at','asc')
                            ->groupBy('blog_id')
                            ->get();   
        return view('admin.comment.comment_blog',compact('data'));
    }

    public function detailCommentBlog($id){
        $data = CommentBlog::where('blog_id',$id)->where('parent_comment','=',0)->orderBy('status','DESC')->orderBy('created_at','DESC')->get();  
        $data_rep = CommentBlog::where('blog_id',$id)->where('parent_comment','>',0)->orderBy('created_at','DESC')->get();
        return view('admin.comment.comment_blog_detail',compact('data','data_rep'));
    }

    public function delCommentBlog(Request $request){
        $data = $request->all();
        if(isset($data['checkbox'])){
            foreach($data['checkbox'] as $id){
                $comment = CommentBlog::find($id);
                $comment->delete();
            }
            Toastr::success('Xóa bình luận bài viết thành công', 'Thành công');
            return back();
        }else{
            Toastr::error('Chọn ít nhất 1 bình luận bài viết để xóa', 'Thất bại');
            return back();
        }
    }

    public function allowCommentBlog(Request $request){
        $data = $request->all();
        $comment = CommentBlog::find($data['comment_id']);
        $comment->status = $data['comment_status'];
        $comment->save();
    }

    public function replyCommentBlog(Request $request){
        $data = $request->all();
        $comment = new CommentBlog();
        $comment->name = 'GFM Store';
        $comment->email = 'admin@gfmstore.com';
        $comment->content = $data['reply_comment'];
        $comment->blog_id = $data['blog_id'];
        $comment->parent_comment = $data['comment_id'];
        $comment->status = 0;
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        $comment->created_at = $dt->toDayDateTimeString();
        $comment->save();
        Toastr::success('Trả lời bình luận thành công', 'Thành công');
    }
}