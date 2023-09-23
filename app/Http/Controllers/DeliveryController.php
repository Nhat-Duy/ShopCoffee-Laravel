<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
class DeliveryController extends Controller
{   

    public function insert_delivary(Request $request){
        $data = $request->all();
        $fee_ship = new Feeship();
        $fee_ship->matp_fee = $data['city'];
        $fee_ship->maqh_fee = $data['province'];
        $fee_ship->xaid_fee = $data['wards'];
        $fee_ship->feeship_fee = $data['fee_ship'];
        $fee_ship->save();
    }

    public function quanlyvanchuyen(Request $request){
        $city = City::orderby('matp', 'ASC')->get();
        return view('admin.delivery.themphivanchuyen')->with(compact('city'));
    }

    public function select_delivery(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action'] == 'city'){
                $select_province = Province::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                    $output.='<option>-- Chọn quận huyện --</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }
                
            }else{
                
                $select_wards = Wards::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                $output.='<option>-- Chọn xã phường --</option>';

                foreach($select_wards as $key => $ward){
                    $output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
                }
            }
            echo $output;
        }
        
    }
}
