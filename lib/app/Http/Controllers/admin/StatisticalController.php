<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Statistical;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Member;
use App\Models\User;
use Carbon\Carbon;

class StatisticalController extends Controller
{
    public function getHome(){
        $total_order = Order::count();
        $total_product = Product::count();
        $total_member = Member::count();
        $total_blog = Blog::count();
        $total_customer = User::count();
        $list_orders = Order::join('shipping','shipping.id','=','orders.shipping_id')->select('orders.*','shipping.name')
                            ->orderBy('orders.id','DESC')->take(8)->get();
        $product_views = Product::orderBy('views','DESC')->take(14)->get();
        $blog_views = Blog::orderBy('views','DESC')->take(8)->get();
        return view('admin.dashboard.dashboard', compact('total_order','total_product','total_member','total_blog',
                                                'total_customer','product_views','blog_views','list_orders'));
    }

    public function default_chart(Request $request){
        $mot_thang_qua = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $baygio =  Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistical::whereBetween('order_date',[$mot_thang_qua,$baygio])->orderBy('order_date','ASC')->get();
        foreach($get as $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quanlity' => $val->quanlity
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function filter_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = Statistical::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();
        foreach($get as $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quanlity' => $val->quanlity
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function filter_by_select(Request $request){
        $data = $request->all();
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->StartofMonth()->toDateString();
        $dauthangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->StartofMonth()->toDateString();
        $cuoithangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $mot_tuan_qua = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $mot_nam_qua = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $baygio =  Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if($data['select_value'] == '7ngay'){
            $get = Statistical::whereBetween('order_date',[$mot_tuan_qua,$baygio])->orderBy('order_date','ASC')->get();
        }elseif($data['select_value'] == 'thangtruoc'){
            $get = Statistical::whereBetween('order_date',[$dauthangtruoc,$cuoithangtruoc])->orderBy('order_date','ASC')->get();
        }elseif($data['select_value'] == 'thangnay'){
            $get = Statistical::whereBetween('order_date',[$dauthangnay,$baygio])->orderBy('order_date','ASC')->get();
        }else{
            $get = Statistical::whereBetween('order_date',[$mot_nam_qua,$baygio])->orderBy('order_date','ASC')->get();
        }

        foreach($get as $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quanlity' => $val->quanlity
            );
        }
        echo $data = json_encode($chart_data);
    }   
}