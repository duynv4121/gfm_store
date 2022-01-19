<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\childCate;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Auth;
use App\Http\Requests\customerProfileRequest;
use App\Http\Requests\updatePasswordCustomer;


class profileController extends Controller
{
    public function index($id)
    {
        if(Auth::guard('loyal_customer')->id() == $id){
            $user= User::find($id);
            $category = Category::where('status','=',1)->orderby('category_order','ASC')->get();
            $child_cate = childCate::where('status','=',1)->get();
            $order = Order::where('customer_id', $id)->orderby('created_at', 'DESC')->get();
            $count_order = count($order);
            $data = [
                'category' => $category,
                'child_cate' => $child_cate,
                'user' => $user,
                'order' => $order,
                'count_order' => $count_order
            ];
            return view('home.page.profile', $data);
        }else {
            return view('errors.403');
        }
    }

    public function history_cart($id)
    {
        $category = Category::where('status','=',1)->orderby('category_order','ASC')->get();
        $child_cate = childCate::where('status','=',1)->get();
        $orderDetail = OrderDetail::where('order_code', $id)->get();
        $product = Product::all();
        return view('home.page.cart-history', compact('orderDetail', 'category', 'child_cate', 'product'));
    }

    public function cart_cancel(Request $request, $id)
    {
        $data = $request->all();
        $order = Order::where('order_code', $id)->first();
        $order->status = 2;
        $order->order_cancel = $data['lido'];
        $order->save();

        $orderDetail = OrderDetail::where('order_code', $id)->get();
        foreach($orderDetail as $val){
            $product = Product::where('id', $val->product_id)->first();
            $product->quanlity = $product->quanlity + $val->product_quanlity;
            $product->save();
        }
        return redirect()->back();
    }

    public function update(customerProfileRequest $request, $id)
    {
        if(Auth::guard('loyal_customer')->id() == $id){
            $data = $request->all();
    
            $image = $request->file('imgInfoUser');
    
            if($image){
                $img_name = $image->getClientOriginalName();
                $storedPath = $image->move('public/admin/images/avatar/', $img_name);
            }else{
                $img_name = $data['imgInfoOld'];
            }
    
            $user = User::find($id);
            $user->fullname = $data['fullname'];
            $user->email = $data['email'];
            $user->phone = $data['phone'];
            $user->address = $data['address'];
            $user->image = $img_name;
            $user->save();
            return redirect()->back();
        }else {
            return view('errors.403');
        }
    }

    public function changePass(updatePasswordCustomer $request, $id)
    {
        if(Auth::guard('loyal_customer')->id() == $id){
            $data = $request->all();
            $user = User::find($id);
            $user->password = bcrypt($data['password']);
            $user->save();
            return redirect()->back();
        }else {
            return view('errors.403');
        }
    }
}