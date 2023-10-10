<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;
class UserController extends Controller
{   
    public function xoa_user($admin_id){
        if(Auth::id() == $admin_id){
            return redirect()->back()->with('message', 'Không được quyền xóa chính mình');
        }
        $admin = Admin::find($admin_id);
        if($admin){
            $admin->roles()->detach();
            $admin->delete();
        }
        return redirect()->back()->with('message', 'Xóa user thành công!');
        
    }

    public function index(){
        $admin = Admin::with('roles')->orderBy('admin_id', 'DESC')->get();
        return view('admin.user.user')->with(compact('admin'));
    }

    public function capquyen(Request $request){
        if(Auth::id() == $request->admin_id){
            return redirect()->back()->with('message', 'Không được phân quyền chính mình');
        }
        $data = $request->all();
        $user = Admin::where('admin_email', $data['admin_email'])->first();
        $user->roles()->detach();
        if($request['author_role']){
            $user->roles()->attach(Roles::where('name','author')->first());
        }
        if($request['user_role']){
            $user->roles()->attach(Roles::where('name','user')->first());
        }
        if($request['admin_role']){
            $user->roles()->attach(Roles::where('name','admin')->first());
        }
        return redirect()->back()->with('message', 'Cấp quyền thành công');
    }
}
