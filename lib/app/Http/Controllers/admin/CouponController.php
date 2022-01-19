<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests\CouponRequest;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Coupon;
use App\Models\Product;
use Toastr;
use App\Models\User;
use Mail;
use Carbon\Carbon;


class CouponController extends Controller
{
    public function __construct(){
        // $this->middleware('permission:xem danh muc con', ['only'=> ['index']]);
        $this->middleware('permission:them ma giam gia', ['only'=> ['create','store']]);
        $this->middleware('permission:cap nhat ma giam gia', ['only'=> ['edit','update']]);
        $this->middleware('permission:xoa ma giam gia', ['only'=> ['destroy']]);
    }
   
    public function index()
    {
        $coupon = Coupon::all();
        $data = [
        'coupon' => $coupon,
        ];
        return view('admin.coupon.show',$data);
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(CouponRequest $request)
    {
        $data = $request->all();
        $Coupon = new Coupon();
        $Coupon->coupon_code = $data['code'];
        $Coupon->coupon_name = $data['name'];
        $Coupon->coupon_condition = $data['condition'];
        $Coupon->coupon_value = $data['value']; 
        $Coupon->coupon_quanlity = $data['quanlity']; 
        $Coupon->coupon_status = $data['status']; 
        $Coupon->date_start = $data['date_start']; 
        $Coupon->date_end = $data['date_end']; 
        $Coupon->save();
        Toastr::success('Thêm mã giảm giá thành công', 'Thành công');
        return Redirect::to("admin/coupon");
    }

    public function show($id)
    {
        return view('admin.coupon.update');
    }

    public function edit($id)
    {
        $Coupon = Coupon::find($id);
        $data = [
        'coupon' => $Coupon,
        ];
        return view('admin.coupon.update',$data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $Coupon = Coupon::find($id);
        $Coupon->coupon_code = $data['code'];
        $Coupon->coupon_name = $data['name'];
        $Coupon->coupon_condition = $data['condition'];
        $Coupon->coupon_value = $data['value']; 
        $Coupon->coupon_quanlity = $data['quanlity']; 
        $Coupon->coupon_status = $data['status']; 
        $Coupon->date_start = $data['date_start']; 
        $Coupon->date_end = $data['date_end']; 

        $Coupon->save();
        Toastr::success('Cập nhật mã giảm giá thành công', 'Thành công');
        return Redirect::to("admin/coupon");
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        if(isset($data['checkbox'])){
            foreach($data['checkbox'] as $id){
                $coupon = Coupon::find($id);
                $coupon->delete();
            }
            Toastr::success('Xóa mã giảm giá thành công', 'Thành công');
            return Redirect::to("admin/coupon");
        }else{
            Toastr::error('Chọn ít nhất 1 mã giảm giá để xóa', 'Thất bại');
            return Redirect::to("admin/coupon");
        }
    }

    public function sendMail($id)
    {
       $coupon = Coupon::where('id', $id)->get();
       $user = User::all();

       $data = [];
       $coupon_mail = [];
   
        foreach($user as $user){
            $data['email'][] = $user->email;
            $data['fullname'][] = $user->fullname;
        }

        foreach($coupon as $coupon){
            $coupon_mail['coupon_code'] = $coupon->coupon_code;
            $coupon_mail['coupon_condition'] = $coupon->coupon_condition;
            $coupon_mail['coupon_quanlity'] = $coupon->coupon_quanlity;
            $coupon_mail['coupon_value'] = $coupon->coupon_value;
            $coupon_mail['coupon_value'] = $coupon->coupon_value;
            $coupon_mail['date_start'] = Carbon::parse($coupon->date_start)->format('d-m-Y');
            $coupon_mail['date_end'] = Carbon::parse($coupon->date_end)->format('d-m-Y');
        };

        Mail::send('sendmail.coupon-voucher', ['coupon_mail' => $coupon_mail], function ($message) use ($data) {
            $message->from('duynv41201@gmail.com', 'Green Farm Market');
            $message->to($data['email'], $data['fullname']);
            $message->subject('Nhanh tay nhận ngay mã giảm giá Green Farm Market');
        });

        Toastr::success('Gửi mã giảm giá cho khách hàng thành công', 'Thành công');
        return redirect()->back();
    }
}