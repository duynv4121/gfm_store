<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Category;
use Toastr;

class CategoryController extends Controller
{
   
    public function __construct(){
        // $this->middleware('permission:xem danh muc', ['only'=> ['index']]);
        $this->middleware('permission:them danh muc', ['only'=> ['create','store']]);
        $this->middleware('permission:cap nhat danh muc', ['only'=> ['edit','update']]);
        $this->middleware('permission:xoa danh muc', ['only'=> ['destroy']]);
    }

    public function index()
    {
        $category = Category::orderBy('category_order','DESC')->get();
        $data = [
            'category' => $category,
        ];
        return view('admin.category.show',$data);
    }

    public function create()
    {
        $category = Category::all();
        return view('admin.category.create', compact('category'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $image = $request->file('img');
        $imagename = $image->getClientOriginalName();                                 
        $storedPath = $image->move('public/admin/images/category', $image->getClientOriginalName());

        $category = new Category();
        $category->image =  $imagename; 
        $category->name =  $data['name']; 
        $category->slug = Str::slug($data['name'],"-");
        $category->status = $data['status']; 

        $category->save();
        Toastr::success('Thêm danh mục thành công', 'Thành công');
        return Redirect::to("admin/category");
    }

    public function show($id)
    {
        return view('admin.category.update');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $data = [
            'category' => $category,
        ];
        return view('admin.category.update',$data);
    }
    
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $category = Category::find($id);
        $image = $request->file('img');
        if(!$image){
            $imagename  = $category->image;
        }else{
            $imagename = $image->getClientOriginalName();                                 
            $storedPath = $image->move('public/admin/images/category', $image->getClientOriginalName());
        }

        $category->image =  $imagename; 
        $category->name =  $data['name']; 
        $category->slug = Str::slug($data['name'],"-");
        $category->status = $data['status']; 

        $category->save();
        Toastr::success('Cập nhật danh mục thành công', 'Thành công');
        return Redirect::to("admin/category");
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        if(isset($data['checkbox'])){
            foreach($data['checkbox'] as $id){
                $category = Category::find($id);
                $category->delete();
            }
            Toastr::success('Xóa danh mục thành công', 'Thành công');
            return Redirect::to("admin/category");
        }else{
            Toastr::error('Chọn ít nhất 1 danh mục để xóa', 'Thất bại');
            return Redirect::to("admin/category");
        }
    }

    public function arrange_category(Request $request){
        $data = $request->all();
        $cate_id = $data["page_id_array"];
        foreach($cate_id as $key => $value){
            $category = Category::find($value);
            $category->category_order = $key;
            $category->save();
        }
        echo "Sắp xếp thứ tự danh mục thành công!";
    }
}