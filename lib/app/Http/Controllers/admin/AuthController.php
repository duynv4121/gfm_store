<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Member;
use Auth;
use Toastr;


class AuthController extends Controller
{
    public function index(){
        return view('admin.login_form.login');
    }

    public function login(Request $request)
    {
        $data = ['email' => $request->email, 'password' => $request->password];
        if(Auth::attempt($data)){
            return redirect()->intended('admin/home');
        }else{
            return back()->withInput()->with('error','Tài khoản hoặc mật khẩu không chính xác!!!');
        }
    }

    public function profile($id){
        if(Auth::user()->id == $id){
            $role = Role::find($id);
            return view('admin.members.profile',compact('role'));
        }else {
            return view('errors.403');
        }
    }

    public function getProfile($id){
        $user = Member::find($id);
        $role = Role::find($id);
        if(Auth::user()->id == $user->id){
            return view('admin.members.updateProfile',compact('user','role'));
        }else {
            return view('errors.403');
        }
    }

    public function postProfile(Request $request, $id){
        $data = $request->all();
        $user = Member::find($id);
        if(Auth::user()->id == $user->id){
            $image = $request->file('img');
            if(!$image){
                $imagename  = $user->image;
            }else{
                $imagename = $image->getClientOriginalName();                                 
                $storedPath = $image->move('public/admin/images/avatar', $image->getClientOriginalName());
            }
            $user->fullname = $data['fullname'];
            $user->password = bcrypt($data['new_password']);
            $user->image =  $imagename; 
            $user->save();
            Toastr::success('Cập nhật thông tin thành công', 'Thành công');
            return redirect()->intended('admin/profile/'.$id);;
        }else {
            return view('errors.403');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->intended('admin/login');
    }
}