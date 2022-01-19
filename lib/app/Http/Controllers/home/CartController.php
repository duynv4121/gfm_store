<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CheckOutRequest;
use App\Models\Category;
use App\Models\childCate;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Gallrey;
use App\Models\Rating;
use App\Models\City;
use App\Models\District;
use App\Models\Village;
use App\Models\Feeship;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Auth;
use Mail;

class CartController extends Controller
{
    public function AddCart(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id'] == $data['cart_product_id']){
                    $is_avaiable++;
                    $cart[$key] = [
                    'session_id' => $val['session_id'],
                    'product_name' => $val['product_name'],
                    'product_id' => $val['product_id'],
                    'product_image' => $val['product_image'],
                    'product_price' => $val['product_price'],
                    'product_amount' => $val['product_amount']+ $data['cart_product_amount'],
                    'cart_product_quanlity_total' => $data['cart_product_quanlity_total'],
                    ];
                    Session::put('cart',$cart);
                }
            }
            if($is_avaiable == 0){
                $cart[] = [
                    'session_id' => $session_id,
                    'product_id' => $data['cart_product_id'], 
                    'product_name' => $data['cart_product_name'], 
                    'product_image' => $data['cart_product_image'], 
                    'product_price' => $data['cart_product_price'], 
                    'product_amount' => $data['cart_product_amount'], 
                    'cart_product_quanlity_total' => $data['cart_product_quanlity_total'],
                ];
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = [
                'session_id' => $session_id,
                'product_id' => $data['cart_product_id'], 
                'product_name' => $data['cart_product_name'], 
                'product_image' => $data['cart_product_image'], 
                'product_price' => $data['cart_product_price'], 
                'product_amount' => $data['cart_product_amount'], 
                'cart_product_quanlity_total' => $data['cart_product_quanlity_total'],
            ];
            Session::put('cart',$cart);
        }
        Session::save();

        $count = count(Session::get('cart'));
        echo $count;
    }

    public function UpdateCart(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart == true){
            foreach ($data['cart_qty'] as $key => $qty){
                foreach($cart as $session => $val){
                    if($val['session_id'] == $key && $qty <= $cart[$session]['cart_product_quanlity_total']){
                        $cart[$session]['product_amount'] = $qty;    
                    }elseif($val['session_id'] == $key && $qty > $cart[$session]['cart_product_quanlity_total']){
                        return redirect()->back()->with('cou','Số lượng '.$cart[$session]['product_name'] . " tồn kho không đủ"); 
                    }
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('cou','Cập nhật giỏ hàng thành công'); 
        }else{
            Session::put('cart', $cart);
            return redirect()->back()->with('cou','Số lượng sản phẩm'.$cart[$session]['product_name']); 
        }
        Session::save('cart');
    }

    public function DeleteCart($session_id)
    {
        $cart = Session::get('cart');
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
        }
        return redirect()->back()->with('message','Xóa giỏ hàng thành công' );
    }

    public function ShowCart()
    {
        $category = Category::where('status','=',1)->get();
        $child_cate = childCate::where('status','=',1)->get();
        $data = [
            'category' => $category,
            'child_cate' => $child_cate
        ];
        return view('home.page.show_cart',$data);
    }

    public function CheckCoupon(Request $request)
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $data = $request->all();
        if(Auth::guard('loyal_customer')->check()){
            $coupon = Coupon::where('coupon_code', $data['code'])->where('coupon_status', 0)->where('date_end','>=',$today)->where('coupon_quanlity','>',0)->orWhere('coupon_used','LIKE','%'.Auth::guard('loyal_customer')->id().'%')->first();
                if($coupon){
                    return redirect()->back()->with('cous', 'Mã giảm giá đã được sử dụng hoặc hết hạn');
                }else{
                    $coupon = Coupon::where('coupon_code', $data['code'])->where('coupon_quanlity','>',0)->where('coupon_status', 1)->where('date_end','>=',$today)->first();
                    if($coupon){
                        $count_coupon = $coupon->count();
                        if($count_coupon>0){
                            $coupon_session = Session::get('coupon');
                            if($coupon_session==true){
                                $id_avaiable = 0;
                                if($id_avaiable==0){
                                    $cou[] = [
                                        'coupon_code' => $coupon->coupon_code,
                                        'coupon_number' => $coupon->coupon_value,
                                        'coupon_condition' => $coupon->coupon_condition,
                                    ];
                                    Session::put('coupon',$cou);    
                                }
                            }else{
                                $cou[] = [
                                    'coupon_code' => $coupon->coupon_code,
                                    'coupon_number' => $coupon->coupon_value,
                                    'coupon_condition' => $coupon->coupon_condition,
                                ];
                                Session::put('coupon',$cou);
                            }
                            Session::save();
                            return Redirect()->back()->with('cou','Áp dụng mã giảm thành công');
                           
                        }
                    }else{
                        return Redirect()->back()->with('cous','Mã giảm giá không hợp lệ');
                        dd('fail');
                    }
                }
        }else{
                // chưa đăng nhâp
            $coupon = Coupon::where('coupon_code', $data['code'])->where('coupon_status',1)->where('date_end','>',$today)->first();
            if($coupon){
                $count_coupon = $coupon->count();
                if($count_coupon>0){
                    $coupon_session = Session::get('coupon');
                    if($coupon_session==true){
                        $id_avaiable = 0;
                        if($id_avaiable==0){
                            $cou[] = [
                                'coupon_code' => $coupon->coupon_code,
                                'coupon_number' => $coupon->coupon_value,
                                'coupon_condition' => $coupon->coupon_condition,
                            ];
                            Session::put('coupon',$cou);    
                        }
                    }else{
                        $cou[] = [
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_number' => $coupon->coupon_value,
                            'coupon_condition' => $coupon->coupon_condition,
                        ];
                        Session::put('coupon',$cou);
                    }
                    Session::save();
                    return Redirect()->back()->with('cou','Áp dụng mã giảm thành công');
                   
                }
            }else{
                return Redirect()->back()->with('cous','Mã giảm giá không hợp lệ');
            }
        }

    }

    public function DeleteCoupon(Request $request)
    {
        Session::forget('coupon');
        return Redirect()->back();
    }

    public function CheckOut(Request $request){
        if(Auth::guard('loyal_customer')->check()){
            $user = User::find(Auth::guard('loyal_customer')->id());
        }
        $citys = City::orderby('id','ASC')->get();
        $district = District::orderby('id','ASC')->get();
        $village = Village::orderby('id','ASC')->get();

        $category = Category::where('status','=',1)->get();
        $child_cate = childCate::where('status','=',1)->get();

        $data = [
            'child_cate' => $child_cate,
            'category' => $category,
            'citys' => $citys,
            'user' => $user,
            'village' => $village,
            'district' => $district,
        ];
        return view('home.page.checkout',$data);
    }

    public function SelectDeliveryHome(Request $request)
    {
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action'] == "city"){
                $selectdistrict = District::where('city_id',$data['ma_id'])->orderby('id','ASC')->get();
                $output .= '<option>Chọn quận huyện</option>';
                foreach($selectdistrict as $key => $district){
                    // $output .= '<option value=">'.$district->id.'">'.$district->name.'</option>';
                      // Viet cach duoi cho de truyen bien
                    $output .= "<option value='$district->id'>$district->name</option>";
                }
            }else{                 
                $selectvillage = Village::where('district_id', $data['ma_id'])->orderBy('id', 'ASC')->get();
                $output .= '<option>Chọn xã phường</option>';
                foreach($selectvillage as $key => $village){
                    $output .= "<option value='$village->id'>$village->name</option>";
                }
            }
            return $output;
        }
    }

    public function CalculateFee(Request $request)
    {
        $data = $request->all();
        if($data['city_id']){
            $feeship = Feeship::where('city_id',$data['city_id'])->where('district_id',$data['district_id'])->where('village_id',$data['village_id'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship > 0){
                    foreach($feeship as $key => $fee){
                        $location[] = [
                            'city_id' => $data['city_id'],
                            'district_id' => $data['district_id'],
                            'village_id' => $data['village_id'],
                        ];
                        Session::put('location', $location);
                        Session::put('fee',$fee->fee_feeship);
                        Session::save();
                    }
                }else{
                    $location[] = [
                        'city_id' => $data['city_id'],
                        'district_id' => $data['district_id'],
                        'village_id' => $data['village_id'],
                    ];
                    Session::put('location', $location);
                    Session::put('fee','25000');
                    Session::save();
                }
            }       
        }

        Session::save();
    }

    public function DeleteFee(Request $request)
    {
        Session::forget('fee');
        Session::forget('location');
        return Redirect()->back();
    }

    public function ConfirmOrder(Request $request)
    {

        $data = $request->all();
        // get coupon
        if($data['order_coupon']!= 'Không có mã giảm giá'){
            $coupon = Coupon::where('coupon_code', $data['order_coupon'])->first();
            $coupon->coupon_used = $coupon->coupon_used.','.Auth::guard('loyal_customer')->id();
            $coupon->coupon_quanlity =$coupon->coupon_quanlity - 1;
            $coupon->save();
        }

        $shipping = new Shipping();
        $shipping->name = $data['name'];
        $shipping->phone = $data['phone'];
        $shipping->email = $data['email'];
        $shipping->address = $data['address'];
        $shipping->notes = $data['note'];
        $shipping->payment_type = $data['shipping_method'];
        $shipping->save();
  
        $shipping_id = $shipping->id;
        $order_code = substr(md5(microtime()),rand(0,26),5);

        $order = new Order; 
        $order->customer_id = $data['id_customer'];
        $order->shipping_id = $shipping_id;
        $order->status= 0;

        $total = 0;
        if(Session::get('cart')){
            foreach(Session::get('cart') as $cart){
                $subtotal = $cart['product_price'] * $cart['product_amount'];
                $total += $subtotal;
            }
        }
        $order->total_price = $total;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->created_at = now();
        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $order->order_code = $order_code;
        $order->order_date = $order_date;
        $order->save();

        if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart){
                $order_detail = new OrderDetail;
                $order_detail->order_code = $order_code;
                $order_detail->product_id = $cart['product_id'];
                $order_detail->product_name = $cart['product_name'];
                $order_detail->product_price = $cart['product_price'];
                $order_detail->product_quanlity = $cart['product_amount'];
                $order_detail->product_feeship= $data['order_feeship'];
                $order_detail->product_coupon = $data['order_coupon'];
                $order_detail->mark_to_money = $data['mark_to_money'] * 50;
                $order_detail->save();
            }
        } 

        //điểm thưởng
        $user = User::where('id', $data['id_customer'])->first();
        if($user){
            $insert_mark = User::find($user['id']);
            $insert_mark->level = $insert_mark['level'] - (int)$data['mark_to_money'];
            $insert_mark->save();
            $mark_level = $insert_mark['level'];

            if($total <= 100000){
                $insert_mark->level = ($mark_level += 50);
                $insert_mark->save();
            }elseif($total > 100000 && $total <= 300000){
                $insert_mark->level = ($mark_level += 70);
                $insert_mark->save();
            }elseif($total > 300000 && $total <= 500000){
                $insert_mark->level = ($mark_level += 100);
                $insert_mark->save();
            }else{
                $insert_mark->level = ($mark_level += 120);
                $insert_mark->save();
            }
        }
        
        //Send mail confirm
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
       
        $data = [
            'email' => $data['email'],
            'now' => $now,
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'address' => $data['address'],
            'note' => $data['note'],
            'cart' => Session::get('cart'),
        ];

        Mail::send('home.page.mail_order', $data, function ($message) use ($data) {
            $message->from('duynv41201@gmail.com', 'Green Farm Market');
            $message->to($data['email'], $data['email']);
            $message->subject("Xác nhận đơn hàng ngày ". $data['now'] );
        });

        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('cart');
        Session::forget('location');
        Session::forget('money');
    }


    public function change_mark(Request $request)
    {
        $data = $request->all();

        $mark_to_money = $data['mark'] * 50;
        $money[] = [
            'money' => $mark_to_money,
            'mark' => $data['mark']
        ];

        Session::put('money', $money);
        Session::save();
    }


    public function delete_mark_money()
    {
        Session::forget('money');
        return Redirect()->back();
    }
}