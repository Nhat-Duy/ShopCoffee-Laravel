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
                  <h6 class="mb-5">Thêm sản phẩm</h6>
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
            <form action="{{URL::to('/luusanpham')}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <tbody>
                <tr>
                  <td >
                      <div class="flex flex-col justify-center">
                        <td class="text-black">Tên sản phẩm</td>
                        <td><input type="text" name="tensanpham" class="border-2 border-black"></td>  
                      </div>
                  </td>
                </tr>
                <tr>
                    <td >
                        <div class="flex flex-col justify-center">
                          <td class="text-black">Giá sản phẩm</td>
                          <td><input type="text" name="giasanpham" class="border-2 border-black"></td>  
                        </div>
                    </td>
                  </tr>
                <tr>
                    <td >
                        <div class="flex flex-col justify-center">
                          <td class="text-black">Hình ảnh sản phẩm</td>
                          <td><input type="file" name="hinhanh_sp" class="border-2 border-black"></td>  
                        </div>
                    </td>
                  </tr>
                <tr>
                  <td>
                      <div class="flex flex-col justify-center">
                        <td class="text-black">Mô tả sản phẩm</td>
                        <td><textarea type="text" name="motasanpham" class="border-2 border-black"></textarea></td>  
                      </div>
                  </td>
                </tr>
                <tr>
                    <td>
                        <div class="flex flex-col justify-center">
                          <td class="text-black">Nội dung sản phẩm</td>
                          <td><textarea type="text" name="noidungsanpham" class="border-2 border-black"></textarea></td>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="flex flex-col justify-center">
                            <td class="text-black">Danh mục sản phẩm</td>
                            <td>
                                <select name="danhmuc">
                                    @foreach($danhmuc_sp as $key => $cate)
                                        <option value="{{$cate->id_danhmuc}}">{{$cate->ten_danhmuc}}</option>
                                    @endforeach
                                </select>
                            </td>  
                          </div>
                    </td>
                  </tr>
                <tr>
                  <td>
                    <div class="ml-auto text-left">
                      <button type="submit" name="themsanpham" class="relative z-10 inline-block px-4 py-3 mb-0 font-bold text-center text-transparent uppercase align-middle transition-all border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 bg-gradient-to-tl from-red-600 to-rose-400 hover:scale-102 active:opacity-85 bg-x-25 bg-clip-text" ><i class="mr-2 fas fa-plus bg-150 bg-gradient-to-tl from-gray-600 to-rose-400 bg-x-25 bg-clip-text"></i>Thêm</button>
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
