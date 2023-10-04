<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cart;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Nguyenlieu;

class WarehouseController extends Controller
{   

    public function xoatatca_kho(){
        $kho = Session::get('kho');
        if($kho == true){
            Session::forget('kho');
            return Redirect()->back()->with('message', 'Xóa hết kho thành công!');
        }
    }

    public function xoa_kho($id_session){
        $kho = Session::get('kho');
        if($kho == true){
            foreach($kho as $key => $val){
                if($val['id_session'] == $id_session){
                    unset($kho[$key]);
                }
            }
            Session::put('kho',$kho);
            return Redirect()->back()->with('message', 'Xóa nguyên liệu thành công');
        }else{
            return Redirect()->back()->with('message', 'Xóa nguyên liệu thật bại');
        }
    }

    public function update_kho(Request $request){
        $data = $request->all();
        $kho = Session::get('kho');
        if($kho == true){
            foreach($data['kho_qty'] as $key => $qty){
                foreach($kho as $session => $val){
                    if($val['id_session'] == $key){
                        $kho[$session]['qty_nl'] = $qty;
                    }
                }
            }
            Session::put('kho', $kho);
            return Redirect()->back()->with('message', 'Cập nhật nguyên liệu thành công!');
        }else{
            return Redirect()->back()->with('message', 'Cập nhật nguyên liệu thật bại');

        }
    }

    public function themvaokho(Request $request){
        $data = $request->all();
        $id_session = substr(md5(microtime()), rand(0,26), 5);
        $kho = Session::get('kho');
        // Session::forget('cart');
        if($kho==true){
            $is_avaiable = 0;
            foreach($kho as $key => $val){
                if($val['id_nl'] == $data['id_nl_giohang']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $kho[] = array(
                    'id_session' => $id_session,
                    'ten_nl' => $data['ten_nl_giohang'],
                    'id_nl' => $data['id_nl_giohang'],
                    'gia_nl' => $data['gia_nl_giohang'],
                    'donvi_nl' => $data['donvi_nl_giohang'],
                    'qty_nl' => $data['qty_nl_giohang'],
                    // 'gia_sp' => $data['gia_sp_giohang'],
                );
                Session::put('kho', $kho);
                
            }
        }else{
            $kho[] = array(
                'id_session' => $id_session,
                'ten_nl' => $data['ten_nl_giohang'],
                'id_nl' => $data['id_nl_giohang'],
                'gia_nl' => $data['gia_nl_giohang'],
                'donvi_nl' => $data['donvi_nl_giohang'],
                'qty_nl' => $data['qty_nl_giohang'],
            );
            Session::put('kho', $kho);

        }

        Session::save();
    }

    public function nhapkho(){
        return view('/admin.nguyenlieu.nhapkho');
    }

    public function xoa_nguyenlieu($id_nl){
        $nguyenlieu = Nguyenlieu::find($id_nl);
        $nguyenlieu->delete();

        Session::put('message', 'Xóa nguyên liệu thành công');
        return Redirect::to('nguyenlieu');
    }

    public function luunguyenlieu(Request $request){
        $data = $request->all();
        $nguyenlieu = new Nguyenlieu();

        $nguyenlieu->ten_nl = $data['ten_nguyenlieu'];
        $nguyenlieu->gia_nl = $data['gia_nguyenlieu'];
        $nguyenlieu->donvi_nl = $data['donvi_nguyenlieu'];
        $nguyenlieu->save();

        Session::put('message', 'Thêm nguyên liệu thành công');
        return Redirect::to('nguyenlieu');

    }

    public function nguyenlieu(){
        $nguyenlieu = Nguyenlieu::orderby('id_nl', 'DESC')->get();
        return view('admin.nguyenlieu.nguyenlieu')->with(compact('nguyenlieu'));
    }

    public function themnguyenlieu(){
        return view('/admin.nguyenlieu.themnguyenlieu');
    }
}
