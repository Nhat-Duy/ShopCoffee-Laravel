@extends('welcome')
@section('home_content')
<div class="main main-raised"> 
        
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- ASIDE -->
                <div id="aside" class="">
                    <div class="container" id="get_category_home">
                        <ul class="main-nav nav navbar-nav">
                            <li>
                                <a href="{{URL::to('/lichsudonhang')}}">Tất cả</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/chothanhtoan')}}">Chờ thanh toán</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/vanchuyen')}}">Vận chuyển</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/danggiao')}}">Đang giao</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/hoanthanh')}}">Hoàn thành</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/huydon')}}">Đơn hàng bị hủy</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /ASIDE -->

                <div class="container-fluid">	
                    <div id="cart_checkout">
                        <div class="main">
                            <div class="table-responsive">
                                <form action="{{url('/update_cart')}}" method="POST">
                                    @csrf
                                    <div id="issessionset"></div>
                                    <?php
                                    $message = Session::get('message');
                                    if($message){
                                        echo $message;
                                        Session::put('message', null);
                                    } 
                                    ?>
                                    <table class="table" style="position: relative;">
                                        <thead>
                                            <tr>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Tên sản phẩm</th>
                                                <th scope="col">Mã giảm giá</th>
                                                <th scope="col">Phí ship</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col"><i class="ri-money-dollar-circle-line"></i>Tổng</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider">
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
                                                <td style="vertical-align: middle;">
                                                    <div style="overflow: hidden;">
                                                        <img src="{{asset('public/upload/sanpham/'. $chitiet['hinhanh_sp'])}}" style="width: 70px; height: 70px; object-fit: cover;" alt="">
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">{{$chitiet->ten_sp}}</td>
                                                <td style="vertical-align: middle;">
                                                    @if($chitiet->coupon_sp != 'không có mã giảm giá')
                                                        {{$chitiet->coupon_sp}}
                                                    @else
                                                        Không mã giảm giá
                                                    @endif
                                                </td>
                                                <td style="vertical-align: middle;">{{number_format($chitiet->feeship_sp). ' '. 'VNĐ'}}</td>
                                                <td style="vertical-align: middle;">{{$chitiet->soluong_sp}}</td>
                                                <td style="vertical-align: middle;">{{number_format($chitiet->gia_sp). ' '. 'VNĐ'}}</td>
                                                <td style="vertical-align: middle;">{{number_format($tong). ' '. 'VNĐ'}}</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                  <div class="flex px-2 py-1">
                                                    <div class="flex flex-col justify-center">
                                                      <h5 class="ml-2 text-sm leading-normal">
                                                         
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
                                                        <div class="total" style="position: absolute; right: 5%; margin-top: 5px; margin-right: 89px;">
                                                            <h4>Tổng tiền: <strong style="color: red;">{{number_format($tong_coupon). ' '. 'VNĐ'}}</strong></h4>
                                                        </div>
                                                      </h5>
                                                    </div>
                                                  </div>
                                                </td>
                                              </tr>
                                        </tbody>
                                    </table>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
</div>


@endsection