@extends('welcome')
@section('home_content')

<section class="section">
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
                        <table id="cart" class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th style="width:50%">Sản phẩm</th>
                                    <th style="width:10%">Giá</th>
                                    <th style="width:8%">Số lượng</th>
                                    <th style="width:7%" class="text-center">Tổng</th>
                                    <th style="width:10%"></th>
                                </tr>
                            </thead>
                            
                            @if(Session::get('cart')==true)
                            @php
                                $total = 0;
                            @endphp
                            @foreach (Session::get('cart') as $key => $cart)  
                            <tbody>
                                <tr>
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <img src="{{asset('public/upload/sanpham/'. $cart['hinhanh_sp'])}}" style="height: 70px; width: 75px;">
                                                <h4 class="nomargin product-name header-cart-item-name">
                                                    <a href=""></a>
                                                </h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <div style="max-width=50px;">
                                                    <p>{{$cart['ten_sp']}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td data-th="Price">
                                        <input type="text" class="form-control price" value="{{number_format($cart['gia_sp'],0,',','.')}}đ" readonly="readonly">
                                    </td>
                                    <td data-th="Quantity">
                                        {{-- <input type="text" class="form-control qty" value="1" > --}}
                                        <div class="qty-label">
                                            <div class="input-number">
                                                {{-- <form action="" method="POST"> --}}
            
                                                    <input name="cart_qty[{{$cart['id_session']}}]" type="text" value="{{$cart['qty_sp']}}">
                                                    {{-- <input name="rowId_cart" type="hidden" value=""> --}}
                                                {{-- </form> --}}
                                            </div>
                                        </div>
                                    </td>
                                    @php
                                        $subtotal = $cart['gia_sp'] * $cart['qty_sp'];
                                        $total += $subtotal;
                                    @endphp
                                    <td class="hidden-xs text-center">
                                        <p>
                                            <?php 
                                            // $subtotal = $cart['gia_sp'] * $cart['qty_sp'];
                                            echo number_format($subtotal). ' '. 'VNĐ';    
                                            ?>
                                        </p>
                                    </td>
                                    {{-- <td data-th="Subtotal">
                                        <input type="text" class="form-control total" value="{{Cart::subtotal(). ' '. 'VNĐ' }}" readonly="readonly">
                                    </td> --}}
                                    <td class="actions" data-th>
                                        <div class="btn-group">
                                            {{-- <form id="update-form" action="{{ URL::to('/capnhat_giohang/'.$v_content->rowId) }}" method="POST" style="display: none;">
                                                {{csrf_field()}}
                                            </form>
                                            <a href="#" class="btn btn-info btn-sm update" update_id="70" onclick="event.preventDefault(); document.getElementById('update-form').submit();">
                                                <i class="fa fa-refresh"></i>
                                            </a> --}}
                                            {{-- <a href="" class="btn btn-info btn-sm update" update_id="70">
                                                <i class="fa fa-refresh"></i>
                                            </a> --}}
                                            <a onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?')" href="{{URL::to('/delete_sp/'. $cart['id_session'])}}" class="btn btn-danger btn-sm remove" update_id="70">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                            
                            <tfoot>
                                <tr>
                                    <td>
                                        <input type="submit" value="Cập nhật" name="update_cart" class="btn btn-info btn-sm update">
                                    </td>
                                    
                                    {{-- <td colspan="2" class="hidden-xs"></td> --}}
                                    @if(Session::get('coupon'))
                                    <td>        
                                        <a href="{{url('/unset_coupon')}}" class="btn btn-success">Xóa mã khuyến mãi</a>
                                    </td>
                                    @endif
                                    <td>        
                                        <a href="{{url('/xoatatca')}}" class="btn btn-success">Xóa tất cả</a>
                                    </td>
                                    <td class="hidden-xs text-center">
                                        <p>Tổng tiền: 
                                            <?php 
                                            echo number_format($total). ' '. 'VNĐ';    
                                            ?>
                                        </p>
                                        <p>
                                            @if(Session::get('coupon'))
                                                @foreach(Session::get('coupon') as $key => $cou)
                                                    @if($cou['dieukien_coupon'] == 1)
                                                        Mã giảm: {{$cou['number_coupon']}}%
                                                        <p>
                                                            @php
                                                            $total_coupon = ($total*$cou['number_coupon'])/100;
                                                            echo '<p>Tổng giảm: '. number_format($total_coupon,0,',','.').'đ</p>';
                                                            @endphp
                                                        </p>
                                                        <p>
                                                            Tổng đã giảm:  {{number_format($total-$total_coupon,0,',','.').' đ'}}
                                                        </p>
                                                    @else
                                                        Mã giảm: {{number_format($cou['number_coupon'],0,',','.')}} đ  
                                                        <p>
                                                            @php
                                                                $total_coupon = $total-$cou['number_coupon'];
                                                            @endphp
                                                        </p>
                                                        <p>
                                                            Tổng đã giảm: {{number_format($total_coupon,0,',','.'). ' đ'}}
                                                        </p>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </p>
                                    </td>
                                    @else
                                    <td>
                                        @php
                                        echo 'Làm ơn thêm sản phẩm vào giỏ hàng'
                                        @endphp
                                    </td>
                                    
                                    
                                    {{-- <td>        
                                        <a href=""  class="btn btn-success">Thanh toán</a>
                                    </td> --}}
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                    </form>
                    <tr>
                        @if(Session::get('cart'))
                        <form class="form-inline" method="POST" action="{{url('/check_coupon')}}">
                            @csrf
                            <td>
                                <input style="margin-bottom: 5px; margin-left: 5px; padding: 5px;" type="text" name="coupon" class="form-control" placeholder="Nhập mã giảm giá">
                                        
                                <input type="submit" class="btn btn-success check_coupon" value="Tính mã giảm giá" name="check_coupon">
                                
                            </td>
                        </form>
                        @endif
                    </tr>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection