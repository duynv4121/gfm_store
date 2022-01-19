<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Toastr;


class customerController extends Controller
{
    
    public function index()
    {
        $user = User::all();
        return view('admin.customer.show', compact('user'));
    }

    public function active($id)
    {
        $user = User::find($id);
        $user->active = 1;
        $user->save();
        Toastr::success('Kích hoạt thành công khách hàng', 'Thành công');
        return redirect()->back();
    }

    public function unactive($id)
    {
        $user = User::find($id);
        $user->active = 0;
        $user->save();
        Toastr::success('Hủy kích hoạt khách hàng thành công', 'Thành công');
        return redirect()->back();
    }
}