<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Http\Requests\CateBlogRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\CategoryBlog;
use Toastr;

class CategoryBlogController extends Controller
{
    public function __construct(){
        // $this->middleware('permission:xem danh muc', ['only'=> ['index']]);
        $this->middleware('permission:them danh muc bai viet', ['only'=> ['create','store']]);
        $this->middleware('permission:cap nhat danh muc bai viet', ['only'=> ['edit','update']]);
        $this->middleware('permission:xoa danh muc bai viet', ['only'=> ['destroy']]);
    }

    public function index()
    {
        $CategoryBlog = CategoryBlog::all();

        $data = [
            'CategoryBlog' => $CategoryBlog,
        ];
        return view('admin.category_blog.show',$data);
    }

    public function create()
    {
        return view('admin.category_blog.create');
    }
    
    public function store(CateBlogRequest $request)
    {
        $data = $request->all();
        $category_blog = new CategoryBlog();
        $category_blog->name =  $data['name'];
        $category_blog->slug =  Str::slug($data['name']);
        $category_blog->save();
        Toastr::success('Thêm danh mục thành công', 'Thành công');
        return Redirect::to("admin/category_blog");
    }
    
    public function show($id)
    {
        return view('admin.category_blog.update');
    }
   
    public function edit($id)
    {
        $category_blog = CategoryBlog::find($id);
        $data = [
            'category_blog' => $category_blog,
        ];
        return view('admin.category_blog.update',$data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $category_blog = CategoryBlog::find($id);
        $category_blog->name =  $data['name']; 
        $category_blog->slug =  Str::slug($data['name']);
        $category_blog->save();
        Toastr::success('Cập nhật danh mục thành công', 'Thành công');
        return Redirect::to("admin/category_blog");
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        if(isset($data['checkbox'])){
            foreach($data['checkbox'] as $id){
                $category_blog = CategoryBlog::find($id);
                $category_blog->delete();
            }
            Toastr::success('Xóa danh mục thành công', 'Thành công');
            return Redirect::to("admin/category_blog");          
        }else{
            Toastr::error('Chọn ít nhất 1 danh mục để xóa', 'Thất bại');
            return Redirect::to("admin/category_blog");  ;;
        }
    }
}