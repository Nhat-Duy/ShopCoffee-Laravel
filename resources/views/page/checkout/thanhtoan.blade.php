@extends('welcome')
@section('home_content')

<style>

.row-checkout {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container-checkout {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.checkout-btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.checkout-btn:hover {
  background-color: #45a049;
}



hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row-checkout {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>

					
<section class="section">       
	

    {{-- Tính phí vận chuyển --}}
	<div style="margin-top: 5px" class="container">
		<div class="row-checkout">
			<div class="col-25">
				<div class="container-checkout">
				<form>
					@csrf
					<tbody>
					  <tr>
						  <td>
							  <div class="flex flex-col justify-center">
								<td class="text-black">Chọn thành phố</td>
								<td>
									<select name="city" id="city" class="bg-slate-400 choose city">
										<option value="">-- Chọn thành phố --</option> 
										@foreach ($city as $key => $ci)
										  <option value="{{$ci->matp}}">{{$ci ->name_city}}</option>                                    
										@endforeach
									</select>
								</td>  
							  </div>
						  </td>
					  </tr>
					  <br>
					  <tr>
						  <td>
							  <div class="flex flex-col justify-center">
								<td class="text-black">Chọn quận huyện</td>
								<td>
									<select name="province" id="province" class="bg-slate-400 choose province">
										<option value="">-- Chọn quận huyện --</option>
		
									</select>
								</td>  
							  </div>
						  </td>
					  </tr>
					  <br>
					  <tr>
						  <td>
							  <div class="flex flex-col justify-center">
								<td class="text-black">Chọn xã phường</td>
								<td>
									<select name="wards" id="wards" class="bg-slate-400  wards">
										<option value="">-- Chọn xã phường --</option>
									</select>
								</td>  
							  </div>
						  </td>
					  </tr>

					  {{-- <tr>
						<td>
						  <div>
							<button type="button" name="themphivanchuyen" class="themphivanchuyen relative z-10 inline-block px-4 py-3 mb-0 font-bold text-center text-transparent uppercase align-middle transition-all border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 bg-gradient-to-tl from-red-600 to-rose-400 hover:scale-102 active:opacity-85 bg-x-25 bg-clip-text" ><i class="mr-2 fas fa-plus bg-150 bg-gradient-to-tl from-gray-600 to-rose-400 bg-x-25 bg-clip-text"></i>Thêm</button>
						</div>
						</td>
					  </tr> --}}

						<input type="button" name="caculate_delivery"  value="Tính phí vận chuyển" class="caculate_delivery checkout-btn">

					</tbody>
				  </form>
					
				</div>
			</div>
			
			</div>
		</div>
	</div>

	{{-- Xem lại giỏ hàng --}}
	<div style="margin-top: 5px" class="container-fluid">	
        <div id="cart_checkout">
            <div class="main">
                <div class="table-responsive">
                    <h2 class="text-center text-danger">Xem lại giỏ hàng</h2>
                    <form action="{{url('/update_cart')}}" method="POST">
                        @csrf
                        <div id="issessionset"></div>
                        @if(session()->has('message'))
							<div class="alert alert-success">
								{{session()->get('message')}}
							</div>
							@elseif(session()->has('error'))
								<div class="alert alert-danger">
									{{ session()->get('error')}}
								</div>
							@endif
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
                                        <input type="text" class="form-control price" value="{{number_format($cart['gia_sp'],0,',','.')}} VNĐ" readonly="readonly">
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
                                            @if(Session::get('coupon'))
                                                @foreach(Session::get('coupon') as $key => $cou)
                                                    @if($cou['dieukien_coupon'] == 1)
                                                        Mã giảm: {{$cou['number_coupon']}}%
                                                        <p>
                                                            @php
                                                            $total_coupon = ($total*$cou['number_coupon'])/100;
                                                            echo '<p>Tổng giảm: '. number_format($total_coupon,0,',','.').'VNĐ</p>';
                                                            @endphp
                                                        </p>
														@php
															$tongdacocoupon = $total-$total_coupon;
														@endphp
                                                        <p>
                                                            Tổng đã giảm:  {{number_format($total-$total_coupon,0,',','.').' VNĐ'}}
                                                        </p>
                                                    @else
                                                        Mã giảm: {{number_format($cou['number_coupon'],0,',','.')}} đ  
                                                        <p>
                                                            @php
                                                                $total_coupon = $total - $cou['number_coupon'];
                                                            @endphp
                                                        </p>
														@php
															$tongdacocoupon = $total_coupon;
														@endphp
                                                        <p>
                                                            Tổng đã giảm: {{number_format($total_coupon,0,',','.'). ' VNĐ'}}
                                                        </p>
                                                    @endif
                                                @endforeach
                                            @endif

											@if(Session::get('fee'))
												<p>Phí vận chuyển: {{number_format(Session::get('fee'),0,',','.'). ' VNĐ'}}</p>
												@php $tongphivanchuyen = $total + Session::get('fee'); @endphp
											@endif
											<p>Thành tiền: </p>
											@php
												if(Session::get('fee') && !Session::get('coupon')){
													$tongsaugiam = $tongphivanchuyen;
													echo number_format($tongsaugiam,0,',','.'). ' VNĐ';
												}elseif(!Session::get('fee') && Session::get('coupon')){
													$tongsaugiam = $tongdacocoupon;
													echo number_format($tongsaugiam,0,',','.'). ' VNĐ';

												}elseif(Session::get('fee') && Session::get('coupon')){
													$tongsaugiam = $tongdacocoupon;
													$tongsaugiam = $tongsaugiam + Session::get('fee');
													echo number_format($tongsaugiam,0,',','.'). ' VNĐ';

												}elseif(!Session::get('fee') && !Session::get('coupon')){
													$tongsaugiam = $total;
													echo number_format($tongsaugiam,0,',','.'). ' VNĐ';
												}
											@endphp
                                    
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
    {{-- Đặt hàng --}}
    <div style="margin-top: 10px" class="container">
		<div class="row-checkout">
			<div class="col-25">
				<div class="container-checkout">
				<form method="POST">
                    @csrf
					<div class="row-checkout">
					<div class="col-50">
						<h3>Điền thông tin gửi hàng</h3>

						<label for="fname"><i class="fa fa-user" ></i> Họ và tên</label>
						<input type="text" id="fname" class="form-control ten_tt" name="ten_tt" pattern="^[a-zA-Z ]+$"  value="{{$khachhang->ten_kh}}" readonly="readonly">
						<label for="email"><i class="fa fa-envelope"></i> Email</label>
						<input type="text" id="email" name="email_tt" class="form-control email_tt" pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$" value="{{$khachhang->email_kh}}" readonly="readonly">
						<label for="adr"><i class="fa fa-address-card-o"></i> Số điện thoại</label>
						<input type="text" id="adr" name="sdt_tt" class="form-control sdt_tt" value="{{$khachhang->sdt_kh}}" readonly="readonly">

                        <label for="city"><i class="fa fa-institution"></i> Địa chỉ: 
                            <a href="{{url('/themdiachi')}}" value="Cập nhật" name="update_cart" class="btn btn-info btn-sm update">Nhập địa chỉ</a>
                        </label>
                        
                        @foreach($diachi as $key => $dia)
                            {{-- <a href="{{url('/suadiachi/'. $dia->id_dc)}}" value="Cập nhật" name="update_cart" class="btn btn-info btn-sm update">Thay đổi</a> --}}
                            <input type="text" id="city" name="diachi_tt" class="form-control diachi_tt" value="{{$dia->diachi_dc}}" pattern="^[a-zA-Z ]+$" readonly="readonly">
                        @endforeach
						
						<textarea style="height:100px; margin-top: 10px " class="form-control notes_tt"  name="notes_tt" placeholder="Ghi chú đơn hàng"></textarea>

						<div class="row">
						<div class="col-50">
							{{-- <label for="state">State</label>
							<input type="text" id="state" name="state" class="form-control" pattern="^[a-zA-Z ]+$" required> --}}
						</div>
						{{-- <div class="col-50">
							<label for="zip">Zip</label>
							<input type="text" id="zip" name="zip" class="form-control" pattern="^[0-9]{6}(?:-[0-9]{4})?$" required>
						</div> --}}
						</div>
					</div>
					
					
					{{-- <div class="col-50">
						<h3>Payment</h3>
						<label for="fname">Accepted Cards</label>
						<div class="icon-container">
							<i class="fa fa-cc-visa" style="color:navy;"></i>
							<i class="fa fa-cc-amex" style="color:blue;"></i>
							<i class="fa fa-cc-mastercard" style="color:red;"></i>
							<i class="fa fa-cc-discover" style="color:orange;"></i>
						</div>
						
						
						<label for="cname">Name on Card</label>
						<input type="text" id="cname" name="cardname" class="form-control" pattern="^[a-zA-Z ]+$" required>
						
						<div class="form-group" id="card-number-field">
							<label for="cardNumber">Card Number</label>
							<input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
                    	</div>
						<label for="expdate">Exp Date</label>
						<input type="text" id="expdate" name="expdate" class="form-control" pattern="^((0[1-9])|(1[0-2]))\/(\d{2})$" placeholder="12/22"required>
						

						<div class="row">
						
							<div class="col-50">
								<div class="form-group CVV">
									<label for="cvv">CVV</label>
									<input type="text" class="form-control" name="cvv" id="cvv" required>
								</div>
							</div>
						</div>
					</div> --}}
					</div>
					{{-- <label><input type="CHECKBOX" name="" class="roomselect" value="conform" required> Địa chỉ giao hàng giống như địa chỉ thanh toán
					</label>	 --}}

                    {{-- Oder-Fee --}}
                    @if(Session::get('fee'))
					    <input type="hidden" name="oder_fee" class="oder_fee" value="{{Session::get('fee')}}">
                    @else
					    <input type="hidden" name="oder_fee" class="oder_fee" value="5000">
                    @endif

                    {{-- Oder-Coupon --}}
                    @if(Session::get('coupon'))
                        @foreach(Session::get('coupon') as $key => $cou)
                            <input type="hidden" name="oder_coupon" class="oder_coupon" value="{{$cou['ma_coupon']}}">
                        @endforeach
                    @else                
                        <input type="hidden" name="oder_coupon" class="oder_coupon" value="không có mã giảm giá">
                    @endif
				    
					<br>
                    <div class="flex flex-col justify-center">
                        <td class="text-black">Chọn hình thức thanh toán</td>
                        <td>
                            <select name="method_tt" id="city" class="bg-slate-400 method_tt">
                                <option value="0">-- Chuyển khoản --</option> 
                                <option value="1">-- Tiền mặt --</option> 
                                {{-- <option value="2">-- Chuyển khoản --</option>  --}}
                            </select>
                        </td>  
                    </div>
					<input type="button" name="send_order" value="Xác nhận đơn hàng" class="checkout-btn send_order">
				</form>
				</div>
			</div>
			{{-- <div class="col-4">
				<div class="container-checkout">
					<h4>Cart 
					<span class='price' style='color:black'>
					<i class='fa fa-shopping-cart'></i> 
					<b>$total_count</b>
					</span>
				</h4>

					<table class='table table-condensed'>
					<thead><tr>
					<th >no</th>
					<th >product title</th>
					<th >	qty	</th>
					<th >	amount</th></tr>
					</thead>
					<tbody>
						<tr><td><p>$item_number_</p></td><td><p>$item_name_</p></td><td ><p>$quantity_</p></td><td ><p>$amount_</p></td></tr>
				    </tbody>
				</table>
				<hr>
				<h3>total<span class='price' style='color:black'><b>$$total</b></span></h3>
				</div>
			</div> --}}
		</div>
	</div>
</section>

@endsection