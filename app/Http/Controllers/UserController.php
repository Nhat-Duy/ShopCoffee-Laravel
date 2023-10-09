<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;
use App\Models\Admin;
use Symfony\Component\HttpFoundation\Session\Session;
class UserController extends Controller
{
    public function index(){
        $admin = Admin::with('roles')->orderBy('admin_id', 'DESC')->get();
        return view('admin.user.user')->with(compact('admin'));
    }

    public function capquyen(Request $request){
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
        return redirect()->back();
    }
}
