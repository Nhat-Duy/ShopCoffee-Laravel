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
                    <h6 class="mb-0">Quản lý bình luận</h6>
                    <div class="notify_comment"></div>
                  </div>
                  <div class="flex-none w-1/2 max-w-full px-3 text-right">
                    <a class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25" href="{{URL::to('themdanhmuc')}}"> <i class="fas fa-plus"> </i>&nbsp;&nbsp;Thêm danh mục sản phẩm</a>
                  </div>
                </div>
              </div>
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-0 overflow-x-auto">
            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
              <thead class="align-bottom">
                <tr>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Duyệt</th>
                  <th class="px-6 py-3  font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tên người gửi</th>
                  <th class="px-6 py-3  font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Ngày gửi</th>
                  <th class="px-6 py-3  font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Bình luận</th>
                  <th class="px-6 py-3  font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Sản phẩm</th>
                  <th class="px-6 py-3  font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Quản lý</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($binhluan as $key => $binh)  
                <tr>
                    @if($binh->tinhtrang_bl == 1)
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <div class="flex px-2 py-1">
                        <div class="flex flex-col justify-center">
                            <a class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25" >
                              <input type="button" value="Duyệt" data-comment_status="0" data-comment_id="{{$binh->id_bl}}" id="{{$binh->id_sp_bl}}"  class="btn btn-info btn-sm binhluan_duyet_btn">
                            </a>
                        </div>
                        </div>
                    </td>
                    @else
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <div class="flex px-2 py-1">
                        <div class="flex flex-col justify-center">
                            <a class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25" >
                              <input type="button" value="Bỏ Duyệt" data-comment_status="1" data-comment_id="{{$binh->id_bl}}" id="{{$binh->id_sp_bl}}"  class="btn btn-info btn-sm binhluan_duyet_btn">
                            </a>
                        </div>
                        </div>
                    </td>
                    @endif
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal">{{$binh->ten_bl}}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <p class="mb-0 text-xs font-semibold leading-tight">{{$binh->ngay_bl}}</p>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal whitespace-normal">{{$binh->binhluan}}</h6>
                      </div>
                    </div>
                    <style type="text/css">
                        ul.reply li{
                          list-style-type: decimal;
                          margin: 5px 40px;
                        }
                    </style>
                    <ul class="reply">
                      @foreach ($binhluan as $key => $traloi)
                          @if($traloi->traloi_bl==$binh->id_bl)
                            <li>Admin: {{$traloi->binhluan}}</li>
                          @endif
                      @endforeach
                    </ul>
                  @if($binh->tinhtrang_bl == 0)   
                    <textarea type="text" class="border-2 border-black w-full traloi_{{$binh->id_bl}}" required></textarea>
                    <button class="traloibinhluan" data-comment_id="{{$binh->id_bl}}" data-product_id="{{$binh->id_sp_bl}}">Trả lời</button>
                  @endif
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div class="flex flex-col justify-center">
                        <h6 class="ml-2 text-sm leading-normal text-red-500"><a href="{{url('/chitietsanpham/'. $binh->sanpham->id_sp)}}" target="_blank">{{$binh->sanpham->ten_sp}}</a></h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="ml-auto">
                        <a class="inline-block px-4 py-3 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 hover:scale-102 active:opacity-85 bg-x-25 text-slate-700" href=""><i class="mr-2 fas fa-pencil-alt text-slate-700" aria-hidden="true"></i>Edit</a>
                        <a onclick="return confirm('Bạn chắc chắn muốn xóa?')" class="relative z-10 inline-block px-4 py-3 mb-0 font-bold text-center text-transparent uppercase align-middle transition-all border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 bg-gradient-to-tl from-red-600 to-rose-400 hover:scale-102 active:opacity-85 bg-x-25 bg-clip-text" href=""><i class="mr-2 far fa-trash-alt bg-150 bg-gradient-to-tl from-red-600 to-rose-400 bg-x-25 bg-clip-text"></i>Delete</a>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
