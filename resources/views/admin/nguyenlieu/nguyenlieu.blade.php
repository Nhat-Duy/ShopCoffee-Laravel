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
                    <h6 class="mb-0">Nguyên liệu</h6>
                  </div>
                  <div class="flex-none w-1/2 max-w-full px-3 text-right">
                    <a class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25" href="{{URL::to('themnguyenlieu')}}"> <i class="fas fa-plus"> </i>&nbsp;&nbsp;Thêm nguyên liệu</a>
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
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tên nguyên liệu</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Giá</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Đơn vị</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($nguyenlieu as $key => $nguyen)
                    
                <form>
                @csrf
                                <input type="hidden" class="id_nl_giohang_{{$nguyen->id_nl}}" value="{{$nguyen->id_nl}}">
                                <input type="hidden" class="ten_nl_giohang_{{$nguyen->id_nl}}" value="{{$nguyen->ten_nl}}">
                                <input type="hidden" class="gia_nl_giohang_{{$nguyen->id_nl}}" value="{{$nguyen->gia_nl}}">
                                <input type="hidden" class="donvi_nl_giohang_{{$nguyen->id_nl}}" value="{{$nguyen->donvi_nl}}">
                                <input type="hidden" class="qty_nl_giohang_{{$nguyen->id_nl}}" value="1">
                    <tr>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <div class="flex px-2 py-1">
                            <div class="flex flex-col justify-center">
                                <h6 class="ml-2 text-sm leading-normal">{{$nguyen->ten_nl}}</h6>
                            </div>
                            </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <div class="flex px-2 py-1">
                            <div class="flex flex-col justify-center">
                                <h6 class="ml-2 text-sm leading-normal">{{$nguyen->gia_nl}}</h6>
                            </div>
                            </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <div class="flex px-2 py-1">
                            <div class="flex flex-col justify-center">
                                <h6 class="ml-2 text-sm leading-normal">{{$nguyen->donvi_nl}}</h6>
                            </div>
                            </div>
                        </td>
                        
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <div class="ml-auto">
                                {{-- <a class="inline-block px-4 py-3 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 hover:scale-102 active:opacity-85 bg-x-25 text-slate-700" href="{{URL::to('/sua_nguyenlieu/'. $nguyen->id_nl)}}"><i class="mr-2 fas fa-pencil-alt text-slate-700" aria-hidden="true"></i>Edit</a> --}}
                                <a onclick="return confirm('Bạn chắc chắn muốn xóa?')" class="relative z-10 inline-block px-4 py-3 mb-0 font-bold text-center text-transparent uppercase align-middle transition-all border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 bg-gradient-to-tl from-red-600 to-rose-400 hover:scale-102 active:opacity-85 bg-x-25 bg-clip-text" href="{{URL::to('/xoa_nguyenlieu/'. $nguyen->id_nl)}}"><i class="mr-2 far fa-trash-alt bg-150 bg-gradient-to-tl from-red-600 to-rose-400 bg-x-25 bg-clip-text"></i>Delete</a>
                            </div>
                        </td>
                        <td>
                            <div class="ml-auto text-left">
                                <button type="button" name="nhapkho" data-id="{{$nguyen->id_nl}}" class="nhapkho relative z-10 inline-block px-4 py-3 mb-0 font-bold text-center text-transparent uppercase align-middle transition-all border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 bg-gradient-to-tl from-red-600 to-rose-400 hover:scale-102 active:opacity-85 bg-x-25 bg-clip-text" ><i class="mr-2 fas fa-plus bg-150 bg-gradient-to-tl from-gray-600 to-rose-400 bg-x-25 bg-clip-text"></i>Thêm</button>
                            </div>
                        </td>
                    </tr>
                </form>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
