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
	<div class="container">
		<div>
			<div>
				<div class="container-checkout">
					<div>
                        @foreach($suadiachi as $key=>$suad)
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <form action="{{URL::to('/thaydoidiachi/'.$suad->id_dc)}}" method="post">
                              {{csrf_field()}}
                              <tbody>
                                <tr>
                                  <td>
                                    <div class="">
                                      <div class="flex flex-col justify-center">
                                        <td class="text-black">Địa chỉ</td>
                                        <td><input type="text" value="{{$suad->diachi_dc}}" name="diachi_dc" class="border-2 border-black" pattern=".{3,}" title="Vui lòng nhập ít nhất 3 ký tự" required></td>  
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <div class="ml-auto text-left">
                                      <button type="submit" name="themdiachi" class="relative z-10 inline-block px-4 py-3 mb-0 font-bold text-center text-transparent uppercase align-middle transition-all border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 bg-gradient-to-tl from-red-600 to-rose-400 hover:scale-102 active:opacity-85 bg-x-25 bg-clip-text" >Thay đổi địa chỉ</button>
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

    

	
</section>

@endsection