<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{   

    public function logout_auth(){
        Auth::logout();
        return redirect('/show_dangnhap_auth')->with('message', 'Đăng xuất thành công');
    }
    public function dangnhap_auth(Request $request){
        $this->validate($request,[
            'admin_email' => 'required|email|max:255',
            'admin_password' => 'required|max:255',
        ]);

        // $data = $request->all();
        if(Auth::attempt(['admin_email' => $request->admin_email, 'admin_password' => $request->admin_password ])){
            return redirect('dashboard');
        }else{
            return redirect('/show_dangnhap_auth')->with('message', 'Lỗi đăng nhập');
        }
    }
    public function show_dangnhap_auth(){
        return view('admin.auth.dangnhapauth');
    }
    public function show_dangky_admin(){
        return view('admin.auth.dangkyadmin');
    }

    public function dangky_admin(Request $request){
        $this->validation($request);
        $data = $request->all();

        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        return redirect('/show_dangky_admin')->with('message', 'Đăng ký thành công');
    }

    public function validation($request){
        return $this->validate($request,[
            'admin_name' => 'required|max:255',
            'admin_email' => 'required|email|max:255',
            'admin_phone' => 'required|max:255',
            'admin_password' => 'required|max:255',
        ]);
    }
}
