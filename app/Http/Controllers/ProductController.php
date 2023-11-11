<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Sanpham;
use App\Models\Binhluan;
use App\Models\Danhgiasao;
use Session;
use App\Http\Requests;
use App\Models\Khachhang;
use Illuminate\Support\Facades\Redirect;

use function Laravel\Prompts\alert;

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
           return Redirect::to('admin.dashboard');
        }else{
           return Redirect::to('admin')->send();
        }
    }

    public function sanpham(){
        $this->AuthLogin();
        $sanpham = DB::table('sanpham')
        ->join('danhmuc','danhmuc.id_danhmuc','=','sanpham.id_danhmuc')
        ->orderBy('sanpham.id_sp','desc')->get();
        $quanly = view('admin.sanpham')->with('sanpham', $sanpham);
        return view('admin_layout')->with('admin.sanpham', $quanly);
    }

    public function themsanpham(){
        $this->AuthLogin();
        $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();

        return view('admin.themsanpham')->with('danhmuc_sp', $danhmuc_sp);

    }
    // Thêm sản phẩm
    public function luusanpham(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['ten_sp'] = $request->tensanpham;
        $data['mota_sp'] = $request->motasanpham;
        $data['noidung_sp'] = $request->noidungsanpham;
        $data['gia_sp'] = $request->giasanpham;
        $data['id_danhmuc'] = $request->danhmuc;
        // $data['trangthai_sp'] = $request->trangthaisanpham;
        
        $get_hinhanh = $request->file('hinhanh_sp');

        if($get_hinhanh){
            $get_ten_hinhanh = $get_hinhanh->getClientOriginalName();
            $name_hinhanh = current(explode('.',$get_ten_hinhanh));
            $new_hinhanh = $name_hinhanh.rand(0,99). '.' .$get_hinhanh->getClientOriginalExtension();
            $get_hinhanh->move('public/upload/sanpham',$new_hinhanh);
            $data['hinhanh_sp'] = $new_hinhanh;

            DB::table('sanpham')->insert($data);
            Session::put('message', 'Thêm sản phẩm thành công');
            return Redirect::to('sanpham');
        }

        $data['hinhanh_sp'] = '';
        DB::table('sanpham')->insert($data);
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('themsanpham');
        
    }

    //Sửa sản phẩm
    public function suasanpham($id_sp){
        $this->AuthLogin();
        $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();  

        $suasanpham = DB::table('sanpham')->where('id_sp', $id_sp)->get();
        $quanly = view('admin.suasanpham')->with('suasanpham', $suasanpham)->with('danhmuc_sp', $danhmuc_sp);
        return view('admin_layout')->with('admin.suasanpham', $quanly);
    }

    public function update_sanpham(Request $request,$id_sp){
        $this->AuthLogin();
        $data = array();
        $data['ten_sp'] = $request->tensanpham;
        $data['mota_sp'] = $request->motasanpham;
        $data['noidung_sp'] = $request->noidungsanpham;
        $data['gia_sp'] = $request->giasanpham;
        $data['id_danhmuc'] = $request->danhmuc;

        $get_hinhanh = $request->file('hinhanh_sp');

        if($get_hinhanh){
            $get_ten_hinhanh = $get_hinhanh->getClientOriginalName();
            $name_hinhanh = current(explode('.',$get_ten_hinhanh));
            $new_hinhanh = $name_hinhanh.rand(0,99). '.' .$get_hinhanh->getClientOriginalExtension();
            $get_hinhanh->move('public/upload/sanpham',$new_hinhanh);
            $data['hinhanh_sp'] = $new_hinhanh;

            DB::table('sanpham')->where('id_sp', $id_sp)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công!');
            return Redirect::to('sanpham');
        }

        DB::table('sanpham')->where('id_sp', $id_sp)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công!');
        return Redirect::to('sanpham');
    }

    //Xóa sản phẩm
    public function xoasanpham($id_sp){
        $this->AuthLogin();
        DB::table('sanpham')->where('id_sp', $id_sp)->delete();
        Session::put('message', 'Xóa sản phẩm thành công');
        return Redirect::to('sanpham');
    }

    //Kết thúc trang admin


    public function chitietsanpham(Request $request, $id_sp){
        //Seo
        $meta_mota = "Chi tiết sản phẩm";
        $meta_keywords = "Chi tiết sản phẩm";
        $meta_title = "Chi tiết sản phẩm";
        $url_canonical = $request->url();
        //EndSeo

        $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();

        $chitiet_sp = DB::table('sanpham')
        ->join('danhmuc','danhmuc.id_danhmuc','=','sanpham.id_danhmuc')
        ->where('sanpham.id_sp', $id_sp)->get();

        foreach ($chitiet_sp as $key => $value){
            $id_danhmuc = $value->id_danhmuc;
            $id_sp = $value->id_sp;
        }

        $lienquan_sp = DB::table('sanpham')
        ->join('danhmuc','danhmuc.id_danhmuc','=','sanpham.id_danhmuc')
        ->where('danhmuc.id_danhmuc', $id_danhmuc)->whereNotIn('sanpham.id_sp', [$id_sp])->limit(4)->get();

        $danhgiasao = Danhgiasao::where('id_sp',$id_sp)->get();
        $danhgiasaotb = Danhgiasao::where('id_sp',$id_sp)->avg('sao');
        $sao = Danhgiasao::where('id_sp',$id_sp)->where('id_kh', Session::get('id_kh'))->avg('sao');
        $khachhang = Khachhang::where('id_kh', Session::get('id_kh'))->first();

        $khachhangdadanhgia = Khachhang::find('id_kh');

        $danhgiasaotb = round($danhgiasaotb);
        return view('page.sanpham.chitietsanpham')
        ->with('danhmuc',$danhmuc_sp)
        ->with('chitiet_sp', $chitiet_sp)
        ->with('lienquan_sp', $lienquan_sp)
        ->with('meta_mota', $meta_mota)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('danhgiasao', $danhgiasao)
        ->with('danhgiasaotb', $danhgiasaotb)
        ->with('sao', $sao)
        ->with('khachhang', $khachhang)
        ->with('khachhangdadanhgia', $khachhangdadanhgia)
        ->with('url_canonical', $url_canonical);
    }

    //Bình luận

    public function send_comment(Request $request){
        $id_sp = $request->id_sp;
        $ten_bl = $request->ten_bl;
        $binhluan = $request->binhluan;
        $binhluan_new = new Binhluan();
        $binhluan_new->id_sp_bl = $id_sp;
        $binhluan_new->ten_bl = $ten_bl;
        $binhluan_new->binhluan = $binhluan;
        $binhluan_new->tinhtrang_bl = 1;
        $binhluan_new->save(); 

    }

    public function load_comment(Request $request){
        $id_sp = $request->id_sp;
        $binhluan = Binhluan::where('id_sp_bl', $id_sp)->where('tinhtrang_bl', 0)->get();
        // $binhluan = Binhluan::where('id_sp_bl', $id_sp)->whereIn('tinhtrang_bl', [0, 2])->get();
        $output = '';
        foreach($binhluan as $key=> $binh){
            if($binh->traloi_bl == ''){
                $output .= '
                            
                                <ul class="reviews">
                                    <li>
                                        <div class="review-heading">
                                            <h5 class="name">@'.$binh->ten_bl.'</h5>
                                            <p class="date">'.$binh->ngay_bl.'</p>
                                            <div class="review-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o empty"></i>
                                            </div>
                                        </div>
                                        <div class="review-body">
                                            <p>'.$binh->binhluan.'</p>
                                        </div>
                                    </li>
                                </ul>
                ';
            }
            foreach($binhluan as $key => $traloi){
                if($traloi->traloi_bl == $binh->id_bl){
                            
                $output .= '
                            <ul class="reviews" style="margin: 5px 20px;">
                                <li>
                                    <div class="review-heading">
                                        <h6 class="name">@ND Coffee</h6>
                                        <p class="date"></p>
                                    </div>
                                    <div>
                                        <p>'.$traloi->binhluan.'</p>
                                    </div>
                                </li>
                            </ul>
                ';
                }
            }
                        
        }
        echo $output;
    }

    //Quản lý bình luận
    public function quanlybinhluan(){
        $binhluan = Binhluan::with('sanpham')->orderBy('tinhtrang_bl', 'DESC')->get();
        return view('admin.binhluan.quanlybinhluan')->with(compact('binhluan'));
    }

    public function duyet_binhluan(Request $request){
        $data = $request->all();
        $binhluan = Binhluan::find($data['id_bl']);

        $binhluan->tinhtrang_bl = $data['comment_status'];
        $binhluan->save();
    }

    public function traloi_binhluan(Request $request){
        $data = $request->all();
        // $binhluan = Binhluan::find($data['id_bl']);
        $binhluan = new Binhluan();
        $binhluan->binhluan = $data['binhluan'];
        $binhluan->id_sp_bl = $data['id_sp_bl'];
        $binhluan->traloi_bl = $data['id_bl'];
        $binhluan->tinhtrang_bl = 0;
        $binhluan->ten_bl = 'Admin';
        $binhluan->save();

    }

    public function danhgiasao(Request $request){
        $data = $request->all();
        $sao = new Danhgiasao();
        $sao->id_sp = $data['id_sp'];
        $sao->id_kh = $data['id_kh'];
        $sao->sao = $data['index'];
        $sao->save();
        echo 'done';
    }
}
