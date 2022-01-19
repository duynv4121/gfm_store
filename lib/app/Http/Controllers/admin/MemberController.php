<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Toastr;
use Auth;
use Redirect;

class MemberController extends Controller
{
    
    public function __construct(){
        $this->middleware('permission:danh sach thanh vien', ['only'=> ['index']]);
        $this->middleware('permission:them thanh vien', ['only'=> ['create','store']]);
        // $this->middleware('permission:cap nhat thanh vien', ['only'=> ['edit','update']]);
        // $this->middleware('permission:xoa thanh vien', ['only'=> ['destroy']]);
    }

    public function index()
    {
        $user = Member::with('roles')->orderBy('id','DESC')->get();
        return view('admin.members.show', compact('user'));
    }

    public function create()
    {
        return view('admin.members.create'); 
    }
    
    public function store(UserRequest $request)
    {
        $user = new Member;
        $image = $request->file('image');
        
        $user->fullname = $request->fullname;
        $user->image = 'avatar.png';
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        Toastr::success('Thêm thành viên thành công', 'Thành công');
        return redirect('admin/members');
    }
    
    public function show($id)
    {

    }
    
    public function edit($id)
    {

    }
    
    public function destroy(Request $request)
    {
        $data = $request->all();

        if(isset($data['checkbox'])){
            foreach($data['checkbox'] as $id){
                $product = Member::find($id);
                $product->delete();
            }
            Toastr::success('Xóa nhân viên thành công', 'Thành công');
            return Redirect::to("admin/members");
        }else{
            Toastr::error('Chọn ít nhất 1 nhân viên để xóa', 'Thất bại');
            return Redirect::to("admin/members");
        }
    }
}