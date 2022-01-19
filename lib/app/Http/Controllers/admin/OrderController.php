<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use App\Models\Statistical;
use App\Models\Product;
use App\Models\Coupon;;
use Carbon\Carbon;

use Toastr;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function manageOrder(){
        $order = Order::join('shipping','orders.shipping_id','=','shipping.id')
                    ->select('orders.*','shipping.name', 'shipping.payment_type')->orderBy('id','DESC')->get();
        return view('admin.order.show',compact('order'));
    }

    public function orderDetail($order_code){
        $order = Order::join('shipping','orders.shipping_id','=','shipping.id')
                        ->where('order_code',$order_code)->get();
        $order_detail = OrderDetail::where('order_code',$order_code)->get();

        foreach($order_detail as $val){
            $coupon_code = $val->product_coupon;
        }

        if($coupon_code != "Không có mã giảm giá"){
            $coupon = Coupon::where('coupon_code', $coupon_code)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_value =  $coupon->coupon_value;
        }else{
            $coupon_condition = 3;
            $coupon_value =  0;
        }
 
        return view('admin.order.order-detail',compact('order_detail','order','coupon_condition', 'coupon_value'));
    }

    public function update_order(Request $request){
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order->status = $data['status'];
        $order->save();

        $order_date = $order->order_date;
        $statistical = Statistical::where('order_date',$order_date)->get();
        if($statistical){
            $statistical_count = $statistical->count();
        }else{
            $statistical = 0;
        }

        $order_code = $order->order_code;
        $order_detail = OrderDetail::where('order_code',$order_code)->get();
        if($order->status == 1){
            $total_order = 0;
            $sales = 0;
            $profit = 0;
            $quanlity = 0;
            foreach ($order_detail as $val){
                $product_id = $val->product_id;
                $order_quanlity = $val->product_quanlity;
                $product = Product::find($product_id);
                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                $product->quanlity = $product->quanlity - $order_quanlity;
                $product->save();

                $quanlity+=$val->product_quanlity;
                $total_order+=1;
                $subtotal = $val->product_price * $val->product_quanlity;
                $sales += $subtotal;
                $profit = $sales - 10000;
            }

            if($statistical_count > 0){
                $statistical_update = Statistical::where('order_date',$order_date)->first();
                $statistical_update->sales = $statistical_update->sales + $sales;
                $statistical_update->quanlity = $statistical_update->quanlity + $quanlity;
                $statistical_update->profit = $statistical_update->profit + $profit;
                $statistical_update->total_order = $statistical_update->total_order + $total_order;
                $statistical_update->save();
            }else{
                $statistical_new = new Statistical();
                $statistical_new->order_date = $order_date;
                $statistical_new->sales = $sales;
                $statistical_new->quanlity = $quanlity;
                $statistical_new->profit = $profit;
                $statistical_new->total_order = $total_order;
                $statistical_new->save();
            }
        }
    }

    public function print($maDH)
    {
        $order = Order::where('order_code', $maDH)->first();
        $shipping = Shipping::where('id', $order['shipping_id'])->first();
        $order_detail = OrderDetail::where('order_code', $maDH)->get();

        foreach($order_detail as $val){
            $coupon_code = $val->product_coupon;
        }

        if($coupon_code != "Không có mã giảm giá"){
            $coupon = Coupon::where('coupon_code', $coupon_code)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_value =  $coupon->coupon_value;
        }else{
            $coupon_condition = 3;
            $coupon_value =  0;
        }

        return view('admin.order.print', compact('order', 'shipping', 'order_detail','coupon_condition', 'coupon_value'));
    }
}