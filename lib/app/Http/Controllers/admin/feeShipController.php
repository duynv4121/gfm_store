<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FeeshipRequest;
use App\Models\City;
use App\Models\District;
use App\Models\Village;
use App\Models\Feeship;
use Toastr;
use Redirect;

class feeShipController extends Controller
{
    public function __construct(){
        $this->middleware('permission:them phi van chuyen', ['only'=> ['create','store']]);
        $this->middleware('permission:cap nhat phi van chuyen', ['only'=> ['update_fee']]);
        $this->middleware('permission:xoa phi van chuyen', ['only'=> ['destroy']]);
    }
  
    public function index()
    {
        $feeShip = Feeship::orderby('id','ASC')->get();
        return view('admin.feeship.show', compact('feeShip'));
    }

    public function create()
    {
        $citys = City::orderby('id','ASC')->get();
        return view('admin.feeship.create', compact('citys'));
    }

    public function store(FeeshipRequest $request)
    {
        $data = $request->all();

        $feeShip = new Feeship;
        $feeShip->city_id = $data['city'];
        $feeShip->district_id = $data['district'];
        $feeShip->village_id = $data['village'];
        $feeShip->fee_feeship = $data['feeship'];
        $feeShip->save();

        Toastr::success('Thêm phí vận chuyển thành công', 'Thành công');
        return redirect("admin/feeship");
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

    public function update_fee(Request $request)
    {
        $data= $request->all();
        $feeShip = Feeship::find($data['feeship_id']);
        $feeShip->fee_feeship = $data['fee_ship'];
        $feeShip->save();
        Toastr::success('Cập nhật phí vận chuyển thành công', 'Thành công');
    }

    public function destroy($id)
    {
        if(isset($_POST['checkbox'])){
            foreach($_POST['checkbox'] as $id){

                $feeShip = Feeship::find($id);
                $feeShip->delete();
            }
            Toastr::success('Xóa phí vận chuyển thành công', 'Thành công');
            return Redirect::to("admin/feeship"); 
        }else{
            Toastr::error('Chọn ít nhất khu vực vận chuyên để xóa', 'Thất bại');
            return Redirect::to("admin/feeship");
        }
    }
}