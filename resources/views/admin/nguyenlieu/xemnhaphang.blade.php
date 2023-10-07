@extends('admin_layout')
@section('admin_content')
{{--Thông tin khách hàng--}}
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="max-w-full px-3 mb-4 lg:mb-0 lg:w-full lg:flex-none">
            <div class="relative flex flex-col min-w-0 mt-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 text-center">Thông tin người nhập hàng</h6>
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
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tên người nhập hàng</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Email </th>
                  {{-- <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Email</th> --}}
                </tr>
              </thead>
              <tbody>
                {{-- @foreach($khachhang as $) --}}
                <tr>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">{{$admin->admin_name}}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">{{$admin->admin_email}}</h6>
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
{{--Liệt kê chi tiết đơn hàng--}}
<div class="flex flex-wrap -mx-2">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="max-w-full px-3 mb-4 lg:mb-0 lg:w-full lg:flex-none">
            <div class="relative flex flex-col min-w-0 mt-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0 text-center">Liệt kê chi tiết nhập hàng</h6>
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
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tên nguyên liệu</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Giá</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Số lượng</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Đơn vị</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tổng tiền</th>

                </tr>
              </thead>
              <tbody>
                @php
                  $i = 0;
                  $tongall = 0;    
                @endphp
                @foreach($chitietnhaphang as $chitiet)
                @php
                  $i ++;
                  $tong = $chitiet->gia_nl * $chitiet->soluong_nl;
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
                        <h6 class="ml-2 text-sm leading-normal">{{$chitiet->ten_nl}}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">{{number_format($chitiet->gia_nl). ' '. 'VNĐ'}}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">{{$chitiet->soluong_nl}}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">{{$chitiet->donvi_nl}}</h6>
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
                          <br>
                          Thanh toán: {{number_format($tongall). ' '. 'VNĐ'}}
                        </h6>
                      </div>
                    </div>
                  </td>
                </tr>
                {{-- <tr>
                  <td>
                    @foreach($donhang as $key => $don)
                      @if($don->tinhtrang_dh == 1)
                        <form>
                          @csrf
                          <select class="xulydonhang">
                            <option value="" >--Chọn xử lý đơn hàng--</option>
                            <option value="1" id="{{$don->id_nh}}">Chưa xử lý</option>
                            <option value="2" id="{{$don->id_nh}}">Đã xử lý - Đã giao hàng</option>
                            <option value="3" id="{{$don->id_nh}}">Hủy đơn hàng - Chưa giao</option>
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
                </tr> --}}
              </tbody>
            </table>
            {{-- <a class="ml-2" href="{{url('/indonhang/'. $chitiet->ma_dh)}}">In đơn hàng</a> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
