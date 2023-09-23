@extends('admin_layout')
@section('admin_content')

<div class="flex flex-wrap -mx-2">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
      <div class="max-w-full px-3 mb-4 lg:mb-0 lg:w-full lg:flex-none">
          <div class="relative flex flex-col min-w-0 mt-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
              <div class="flex flex-wrap -mx-3">
                <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                  <h6 class="mb-5">Thêm danh mã giảm giá</h6>
                </div>
                <?php
                  $message = Session::get('message');
                  if($message){
                    echo $message;
                    Session::put('message', null);
                  } 
                ?>
              </div>
            </div>
      <div class="flex-auto px-0 pt-0 pb-2">
        <div class="p-0 overflow-x-auto">
          <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
            <form action="{{URL::to('/luucoupon')}}" method="post">
              @csrf
              <tbody>
                <tr>
                  <td >
                    <div class="">
                      <div class="flex flex-col justify-center">
                        <td class="text-black">Tên mã giảm giá</td>
                        <td><input type="text" name="ten_coupon" class="border-2 border-black"  required></td>  
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                    <td >
                      <div class="">
                        <div class="flex flex-col justify-center">
                          <td class="text-black">Mã giảm giá</td>
                          <td><input type="text" name="ma_coupon" class="border-2 border-black"  required></td>  
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td >
                      <div class="">
                        <div class="flex flex-col justify-center">
                          <td class="text-black">Số lượng</td>
                          <td><input type="text" name="time_coupon" class="border-2 border-black"  required></td>  
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <div class="flex flex-col justify-center">
                          <td class="text-black">Tính năng mã</td>
                          <td>
                              <select name="dieukien_coupon" class="bg-slate-400">
                                  <option value="0">--Chọn--</option>
                                  <option value="1">Giảm theo %</option>
                                  <option value="2">Giảm theo tiền</option>
  
                              </select>
                          </td>  
                        </div>
                    </td>
                  </tr>
                <tr>
                  <td>
                      <div class="flex flex-col justify-center">
                        <td class="text-black">Nhập số % hoặc tiền giảm</td>
                        <td><input type="text" name="number_coupon" class="border-2 border-black"  required></td>  
                      </div>
                  </td>
                </tr>
                
                <tr>
                  <td>
                    <div class="ml-auto text-left">
                      <button type="submit" name="themcoupon" class="relative z-10 inline-block px-4 py-3 mb-0 font-bold text-center text-transparent uppercase align-middle transition-all border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 bg-gradient-to-tl from-red-600 to-rose-400 hover:scale-102 active:opacity-85 bg-x-25 bg-clip-text" ><i class="mr-2 fas fa-plus bg-150 bg-gradient-to-tl from-gray-600 to-rose-400 bg-x-25 bg-clip-text"></i>Thêm</button>
                  </div>
                  </td>
                </tr>
              </tbody>
            </form>
          </table>
          
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
