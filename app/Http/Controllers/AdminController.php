<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

use Laravel\Socialite\Facades\Socialite;
use App\Models\MXH;
use App\Models\Login;


class AdminController extends Controller
{   
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
           return Redirect::to('admin.dashboard');
        }else{
           return Redirect::to('admin')->send();
        }
    }

    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request){

        $data = $request->all();
        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);
        $login = Login::where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        $login_count = $login->count();
        if($login_count){
            Session::put('admin_name', $login->admin_name);
            Session::put('admin_id', $login->admin_id);
            return Redirect::to('/dashboard');
        }else{
            Session::put('massage', 'Mật khẩu hoặc tài khoản sai vui lòng nhập lại!');
            return Redirect::to('/admin');
        }
        // $admin_email = $request->admin_email;
        // $admin_password = md5($request->admin_password);

        // $result = DB::table('admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        // if($result){
        //     Session::put('admin_name', $result->admin_name);
        //     Session::put('admin_id', $result->admin_id);
        //     return Redirect::to('/dashboard');
        // }else{
        //     Session::put('message', 'Tài khoản hoặc mật khẩu sai. Vui lòng nhập lại!');
        //     return Redirect::to('/admin');
        // }
    }
    public function log_out(){
        $this->AuthLogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');

    }

    public function login_google(){
        return Socialite::driver('google')->redirect();
    }

    public function callback_google() {
        $users = Socialite::driver('google')->stateless()->user();
        $authUser = $this->findOrCreateUser($users, 'google');
        $account_name = Login::where('admin_id', $authUser->login->admin_id)->first();
        Session::put('admin_name', $account_name->admin_name);
        Session::put('admin_id', $account_name->admin_id);
        return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
    }
    
    public function findOrCreateUser($users, $provider) {
        $authUser = MXH::where('provider_user_id', $users->id)->first();
        if ($authUser) {
            return $authUser;
        }
    
        $orang = Login::where('admin_email', $users->email)->first();
    
        if (!$orang) {
            $orang = Login::create([
                'admin_name' => $users->name,
                'admin_email' => $users->email,
                'admin_password' => '',
                'admin_phone' => '',
                'admin_status' => 1
            ]);
        }
    
        $duy = new MXH([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);
    
        $duy->login()->associate($orang);
        $duy->save();
    
        $account_name = Login::where('admin_id', $duy->login->admin_id)->first();
        Session::put('admin_name', $account_name->admin_name);
        Session::put('admin_id', $account_name->admin_id);
        return $duy;
    }
    
}
