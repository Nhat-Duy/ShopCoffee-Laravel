<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
class DeliveryController extends Controller
{   

    public function update_delivery(Request $request){
        $data = $request->all();
        $fee_ship = Feeship::find($data['feeship_id']);
        $fee_value = rtrim($data['fee_value'], '.');
        $fee_ship->feeship_fee = $fee_value;
        $fee_ship->save();
    }

    public function select_feeship(){
        $feeship = Feeship::orderby('id_fee', 'DESC')->get();
        $output = '';
        $output .= '<div class= "container mx-auto">
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Tên thành phố</th>
                        <th class="py-2 px-4 border-b">Tên quận huyện</th>
                        <th class="py-2 px-4 border-b">Tên xã phường</th>
                        <th class="py-2 px-4 border-b">Phí Ship</th>
                    </tr>
                </thead>
                <tbody>
                ';
                foreach($feeship as $key => $fee){
                    $output .= '
                    <tr>
                        <td class="py-2 px-4 border-b">'.$fee->city->name_city.'</td>
                        <td class="py-2 px-4 border-b">'.$fee->province->name_quanhuyen.'</td>
                        <td class="py-2 px-4 border-b">'.$fee->wards->name_xaphuong.'</td>
                        <td class="py-2 px-4 border-b feeship_fee_edit" contenteditable data-feeship_id= "'.$fee->id_fee.'">'.number_format($fee->feeship_fee,0,',','.').' </td>

                    </tr>
                    ';
                }
                $output .= '
                </tbody>
            </table>
            </div>
            ';

            echo $output;
        
    }

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
