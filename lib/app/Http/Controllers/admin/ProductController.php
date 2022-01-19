<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Gallrey;
use App\Models\childCate;
use Toastr;

class ProductController extends Controller
{
    public function __construct(){
        // $this->middleware('permission:xem san pham', ['only'=> ['index']]);
        $this->middleware('permission:them san pham', ['only'=> ['create','store']]);
        $this->middleware('permission:cap nhat san pham', ['only'=> ['edit','update']]);
        $this->middleware('permission:xoa san pham', ['only'=> ['destroy']]);
    }
  
    public function index()
    {
        $product = Product::join('child_category','child_category.id','=','product.child_cate_id')
                            ->select('product.*','child_category.name as child_cate_name')
                            ->orderBy('id','DESC')
                            ->get();
        return view('admin.products.show', compact('product'));
    }
  
    public function create()
    {
        $cate = Category::all();
        return view('admin.products.create', compact('cate'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $check_pro = Product::all();

        //ảnh đại diện sản phẩm
        $image = $request->file('img');
        if($image){
            $img_name = $image->getClientOriginalName();
            $storedPath = $image->move('public/admin/images/product', $img_name);
        }else{
            $img_name = 'error.jpg';
        }
        // ảnh liên quan sản phẩm
        $img_Gallrey = $request->file('img_gallery');

        $product = new Product();
        $product->name = $data['name'];
        $product->slug = Str::slug($data['name']);
        $product->image = $img_name;
        $product->price_cost = $data['price_cost'];
        $product->price = $data['price'];
        $product->price_sales = $data['price_sales'];
        $product->status = $data['status'];
        $product->views = 0;
        $product->like = 0;
        $product->category_id = $data['category'];
        $product->child_cate_id = $data['child_cate_id'];
        $product->quanlity = $data['quanlity'];
        $product->add_day = $data['add_day'];
        $product->expired_day = $data['expired_day'];
        $product->description = $data['description'];
        $product->save();

        // insert ảnh liên quan sản phẩm
        if($img_Gallrey){
            foreach($img_Gallrey as $val){
                $nameImgGallrey = $val->getClientOriginalName();
                $val->move('public/admin/images/product', $nameImgGallrey);
                $Gallrey = new Gallrey();
                $Gallrey->product_id = $product->id;
                $Gallrey->name =  $nameImgGallrey;
                $Gallrey->save();
            }
        }
        Toastr::success('Thêm sản phẩm thành công', 'Thành công');
        return Redirect::to("admin/product");
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        $cate = Category::all();
        $product = Product::find($id);
        $child_cate = childCate::where('id', $product['child_cate_id'])->get();
        $Gallrey = Gallrey::where('product_id', $id)->get();
        return view('admin.products.edit', compact('product', 'cate', 'Gallrey', 'child_cate'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $findGallrey = Gallrey::where('product_id', $id)->get();
       
        foreach($findGallrey as $val){
            if($val->id == $data['id_gallery_'.(string)$val->id]){
                $image = $request->file('img_gallery_'.(string)$val->id);
                if($image){
                    $img_name = $image->getClientOriginalName();
                    $storedPath = $image->move('public/admin/images/product', $img_name);
                }else{
                    $img_name = $data['img_gallery_old_'.(string)$val->id];
                }
            }else{
                Toastr::error('Cập nhật thất bại ảnh sản phẩm', 'Thành công');
                return Redirect::to("admin/product");
            }
            $Gallrey = Gallrey::find($data['id_gallery_'.(string)$val->id]);
            $Gallrey->name = $img_name;
            $Gallrey->save();
        }     
                
        $product = Product::find($id);
        $image = $request->file('img');
        if($image){
            $img_name = $image->getClientOriginalName();
            $storedPath = $image->move('public/admin/images/product', $img_name);
        }else{
            $img_name = $product->image;
        } 
        
        $product->name = $data['name_pro'];
        $product->slug = Str::slug($data['name_pro']);
        $product->image = $img_name;
        $product->price_cost = $data['price_cost'];
        $product->price = $data['price'];
        $product->price_sales = $data['price_sale'];
        $product->status = $data['status'];
        $product->category_id = $data['category'];
        $product->child_cate_id = $data['child_cate_id'];
        $product->quanlity = $data['quantity'];
        $product->add_day = $data['add_day'];
        $product->expired_day = $data['expired_day'];
        $product->description = $data['description'];
        $product->save();

        Toastr::success('Cập nhật sản phẩm thành công', 'Thành công');
        return Redirect::to("admin/product");
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        if(isset($data['checkbox'])){
            foreach($data['checkbox'] as $id){
                $product = Product::find($id);
                $product->delete();
            }
            Toastr::success('Xóa sản phẩm thành công', 'Thành công');
            return Redirect::to("admin/product");
        }else{
            Toastr::error('Chọn ít nhất 1 sản phẩm để xóa', 'Thất bại');
            return Redirect::to("admin/product");
        }
    }
}