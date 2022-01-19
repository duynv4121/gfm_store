<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SlideRequest;
use Illuminate\Support\Facades\Redirect;
use App\Models\Slide;
use Toastr;

class SlideController extends Controller
{ 
    public function __construct(){
        // $this->middleware('permission:xem danh muc', ['only'=> ['index']]);
        $this->middleware('permission:them slide', ['only'=> ['create','store']]);
        $this->middleware('permission:cap nhat slide', ['only'=> ['edit','update']]);
        $this->middleware('permission:xoa slide', ['only'=> ['destroy']]);
    }

    public function index()
    {
        $data = Slide::orderBy('id','asc')->get();
        return view('admin.slide.show', compact('data'));
    }
  
    public function create()
    {
        return view('admin.slide.create');
    }
    
    public function store(SlideRequest $request)
    {
        $data = $request->all();
        $image = $request->file('slide_image');
        if($image){
            $img_name = $image->getClientOriginalName();
            $storedPath = $image->move('public/admin/images/banner', $img_name);
        }else{
            $img_name = 'error.jpg';
        }

        $slide = new Slide();
        $slide->slide_title = $data['slide_title'];
        $slide->slide_image = $img_name;
        $slide->slide_content = $data['slide_content'];
        $slide->slide_description = $data['slide_description'];
        $slide->slide_status = $data['slide_status'];
        $slide->save();

        Toastr::success('Thêm banner mới thành công', 'Thành công');
        return Redirect::to("admin/slide-banner");
    }

    public function edit($id)
    {
        $data = Slide::find($id);
        return view('admin.slide.update', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $slide = Slide::find($id);
        $image = $request->file('slide_image');
        if(!$image){
            $imagename  = $slide->slide_image;
        }else{
            $imagename = $image->getClientOriginalName();                                 
            $storedPath = $image->move('public/admin/images/banner', $image->getClientOriginalName());
        }
        $slide->slide_image =  $imagename; 
        $slide->slide_title =  $data['slide_title']; 
        $slide->slide_content =  $data['slide_content']; 
        $slide->slide_description =  $data['slide_description']; 
        $slide->slide_status =  $data['slide_status']; 
        $slide->save();
        Toastr::success('Cập nhật banner thành công', 'Thành công');
        return Redirect::to("admin/slide-banner");
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        if(isset($data['checkbox'])){
            foreach($data['checkbox'] as $id){
                $slide = Slide::find($id);
                $slide->delete();
            }
            Toastr::success('Xóa banner thành công', 'Thành công');
            return Redirect::to("admin/slide-banner");
        }else{
            Toastr::error('Chọn ít nhất 1 banner để xóa', 'Thất bại');
            return Redirect::to("admin/slide-banner");
        }
    }
}