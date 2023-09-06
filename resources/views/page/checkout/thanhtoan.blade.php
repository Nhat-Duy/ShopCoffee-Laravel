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
	<div class="container-fluid">
		<div class="row-checkout">
			<div class="col-25">
				<div class="container-checkout">
				<form id="checkout_form" action="{{URL::to('/luuthanhtoan')}}" method="POST" class="was-validated">
                    {{csrf_field()}}
					<div class="row-checkout">
					<div class="col-50">
						<h3>Thanh toán</h3>
						<label for="fname"><i class="fa fa-user" ></i> Họ và tên</label>
						<input type="text" id="fname" class="form-control" name="ten_tt" pattern="^[a-zA-Z ]+$"  value="">
						<label for="email"><i class="fa fa-envelope"></i> Email</label>
						<input type="text" id="email" name="email_tt" class="form-control" pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$" value="" required>
						<label for="adr"><i class="fa fa-address-card-o"></i> Số điện thoại</label>
						<input type="text" id="adr" name="sdt_tt" class="form-control" value="" required>
						<label for="city"><i class="fa fa-institution"></i> Địa chỉ</label>
						<input type="text" id="city" name="diachi_tt" class="form-control" value="" pattern="^[a-zA-Z ]+$" required>
						<textarea style="height:200px;" class="form-control"  name="notes_tt" placeholder="Ghi chú đơn hàng"></textarea>

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
					<label><input type="CHECKBOX" name="" class="roomselect" value="conform" required> Địa chỉ giao hàng giống như địa chỉ thanh toán
					</label>	
				    <input type="hidden" name="total_count" value="'.$total_count.'">
					<input type="hidden" name="total_price" value="'.$total.'">
					
					<input type="submit" name="guidonhang" id="submit" value="Tiếp tục thanh toán" class="checkout-btn">
				</form>
				</div>
			</div>
			<div class="col-4">
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
			</div>
		</div>
	</div>
</section>

@endsection