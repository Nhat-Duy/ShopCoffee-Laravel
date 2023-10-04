@extends('admin_layout')
@section('admin_content')
{{--Thông tin khách hàng--}}
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="max-w-full px-3 mb-4 lg:mb-0 lg:w-full lg:flex-none">
            <div class="relative flex flex-col min-w-0 mt-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 text-center">Thông tin khách hàng</h6>
                <div class="flex flex-wrap -mx-3">
                  <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                  </div>
                  <div class="flex-none w-1/2 max-w-full px-3 text-right">
                  </div>
                </div>
                <?php
                  $message = Session::get('message');
                  if($message){
                    echo $message;
                    Session::put('message', null);
                  } 
                  ?>
              </div>
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-0 overflow-x-auto">
            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
              <thead class="align-bottom">
                <tr>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tên khách hàng</th>
                  <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Số điện thoại</th>
                  <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Email</th>
                </tr>
              </thead>
              <tbody>
                {{-- @foreach($khachhang as $) --}}
                <tr>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">{{$khachhang->ten_kh}}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">{{$khachhang->sdt_kh}}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">{{$khachhang->email_kh}}</h6>
                      </div>
                    </div>
                  </td>
                </tr>
                {{-- @endforeach --}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

<br><br>
{{--Thông tin vận chuyển--}}
<div class="flex flex-wrap -mx-2">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="max-w-full px-3 mb-4 lg:mb-0 lg:w-full lg:flex-none">
            <div class="relative flex flex-col min-w-0 mt-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 text-center">Thông tin vận chuyển</h6>
                <div class="flex flex-wrap -mx-3">
                  <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                  </div>
                  <div class="flex-none w-1/2 max-w-full px-3 text-right">
                  </div>
                </div>
                <?php
                  $message = Session::get('message');
                  if($message){
                    echo $message;
                    Session::put('message', null);
                  } 
                  ?>
              </div>
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-0 overflow-x-auto">
            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
              <thead class="align-bottom">
                <tr>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tên người vận chuyển</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Địa chỉ</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Số điện thoại</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Notes</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Hình thức thanh toán</th>
                </tr>
              </thead>
              <tbody>
                {{-- @foreach($donhang_id as $v_content) --}}
                <tr>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm  leading-normal">{{$thanhtoan->ten_tt}}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">{{$thanhtoan->diachi_tt}}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">{{$thanhtoan->sdt_tt}}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">{{$thanhtoan->notes_tt}}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">
                        @if($thanhtoan->method_tt == 0)
                            Chuyển khoản
                        @else
                            Tiền mặt
                        @endif
                        </h6>
                      </div>
                    </div>
                  </td>
                </tr>
                {{-- @endforeach --}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

<br><br>
{{--Liệt kê chi tiết đơn hàng--}}
<div class="flex flex-wrap -mx-2">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="max-w-full px-3 mb-4 lg:mb-0 lg:w-full lg:flex-none">
            <div class="relative flex flex-col min-w-0 mt-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 text-center">Liệt kê chi tiết đơn hàng</h6>
                <div class="flex flex-wrap -mx-3">
                  <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                  </div>
                  <div class="flex-none w-1/2 max-w-full px-3 text-right">
                  </div>
                </div>
                <?php
                  $message = Session::get('message');
                  if($message){
                    echo $message;
                    Session::put('message', null);
                  } 
                  ?>
              </div>
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-0 overflow-x-auto">
            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
              <thead class="align-bottom">
                <tr>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Thứ tự</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tên sản phẩm</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Mã giảm giá</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Phí ship</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Số lượng</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Giá</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tổng tiền</th>

                </tr>
              </thead>
              <tbody>
                @php
                  $i = 0;
                  $tongall = 0;    
                @endphp
                @foreach($chitietdonhang as $chitiet)
                @php
                  $i ++;
                  $tong = $chitiet->gia_sp * $chitiet->soluong_sp;
                  $tongall += $tong;
                @endphp
                <tr>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">{{$i}}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">{{$chitiet->ten_sp}}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">
                          @if($chitiet->coupon_sp != 'không có mã giảm giá')
                              {{$chitiet->coupon_sp}}
                          @else
                              Không mã giảm giá
                          @endif
                        </h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">{{number_format($chitiet->feeship_sp). ' '. 'VNĐ'}}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">{{$chitiet->soluong_sp}}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">{{number_format($chitiet->gia_sp). ' '. 'VNĐ'}}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">{{number_format($tong). ' '. 'VNĐ'}}</h6>
                      </div>
                    </div>
                  </td>
                </tr>
                
                @endforeach
                <tr>
                  <td></td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">
                           
                            @php
                              $tong_coupon = 0;
                            @endphp
                          @if($dieukien_coupon == 1)

                            @php
                              $tong_giamcoupon = ($tongall * $number_coupon)/100;
                              echo 'Tổng giảm: ' . number_format($tong_giamcoupon). ' '. 'VNĐ';
                              $tong_coupon = $tongall - $tong_giamcoupon + $chitiet->feeship_sp;
                            @endphp

                          @else

                            @php
                            echo 'Tổng giảm: '. number_format($number_coupon). ' '. 'VNĐ';
                              $tong_coupon = $tongall - $number_coupon + $chitiet->feeship_sp;
                            @endphp

                          @endif
                          <br>
                          Phí ship: {{number_format($chitiet->feeship_sp). ' '. 'VNĐ'}}
                          <br>
                          Thanh toán: {{number_format($tong_coupon). ' '. 'VNĐ'}}
                        </h6>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    @foreach($donhang as $key => $don)
                      @if($don->tinhtrang_dh == 1)
                        <form>
                          @csrf
                          <select class="xulydonhang">
                            <option value="" >--Chọn xử lý đơn hàng--</option>
                            <option value="1" id="{{$don->id_dh}}">Chưa xử lý</option>
                            <option value="2" id="{{$don->id_dh}}">Đã xử lý - Đã giao hàng</option>
                            <option value="3" id="{{$don->id_dh}}">Hủy đơn hàng - Chưa giao</option>
                          </select>
                        </form>
                      @elseif($don->tinhtrang_dh == 2)
                        <form>
                          @csrf
                          <select class="xulydonhang">
                            <option value="" >--Chọn xử lý đơn hàng--</option>
                            <option value="1" id="{{$don->id_dh}}">Chưa xử lý</option>
                            <option value="2" id="{{$don->id_dh}}" selected>Đã xử lý - Đã giao hàng</option>
                            <option value="3" id="{{$don->id_dh}}">Hủy đơn hàng - Chưa giao</option>
                          </select>
                        </form>
                      @else
                        <form>
                          @csrf
                          <select class="xulydonhang">
                            <option value="" >--Chọn xử lý đơn hàng--</option>
                            <option value="1" id="{{$don->id_dh}}">Chưa xử lý</option>
                            <option value="2" id="{{$don->id_dh}}">Đã xử lý - Đã giao hàng</option>
                            <option value="3" id="{{$don->id_dh}}" selected>Hủy đơn hàng - Chưa giao</option>
                          </select>
                        </form>
                      @endif
                    @endforeach
                  </td>
                </tr>
              </tbody>
            </table>
            <a class="ml-2" href="{{url('/indonhang/'. $chitiet->ma_dh)}}">In đơn hàng</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
