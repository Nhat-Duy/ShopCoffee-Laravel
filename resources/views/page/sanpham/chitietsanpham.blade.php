@extends('welcome')
@section('home_content')	
@foreach ($chitiet_sp as $key => $value)	
		<!-- SECTION -->
		<div class="section main main-raised">
			<!-- container -->
			<div class="container">
				<!-- row -->
				
				<div class="row">
					<!-- Product main img -->
                                <div class="col-md-5 col-md-push-2">
                                <div id="product-main-img">
                                    <div class="product-preview">
                                        <img src="{{URL::to('public/upload/sanpham/'.$value->hinhanh_sp)}}" alt="">
                                    </div>
                                </div>
                            </div>
                                
                            <div class="col-md-2  col-md-pull-5">
                                <div id="product-imgs">
                                    <div class="product-preview">
                                        <img src="{{URL::to('public/upload/sanpham/trasua276.png')}}" alt="">
                                    </div>

                                    <div class="product-preview">
                                        <img src="{{URL::to('public/upload/sanpham/trasua315.jpg')}}" alt="">
                                    </div>

									<div class="product-preview">
                                        <img src="{{URL::to('public/upload/sanpham/trasua152.jpg')}}" alt="">
                                    </div>

                                </div>
                            </div>
					<form>
						@csrf
						<input type="hidden" class="id_sp_giohang_{{$value->id_sp}}" value="{{$value->id_sp}}">
                        <input type="hidden" class="ten_sp_giohang_{{$value->id_sp}}" value="{{$value->ten_sp}}">
                        <input type="hidden" class="hinhanh_sp_giohang_{{$value->id_sp}}" value="{{$value->hinhanh_sp}}">
                        <input type="hidden" class="gia_sp_giohang_{{$value->id_sp}}" value="{{$value->gia_sp}}">
                        <input type="hidden" class="qty_sp_giohang_{{$value->id_sp}}" value="1">		
                    <div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name">{{$value->ten_sp}}</h2>
							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</div>
								<a class="review-link" href="#review-form">10 Review(s) | Add your review</a>
							</div>
							<div>
								<h3 class="product-price">{{number_format($value->gia_sp).' '.'VNĐ'}}</h3>
								<br>
								<span class="product-available">Mô tả sản phẩm</span>
							</div>
							<p>{{$value->mota_sp}}</p>

								<div class="add-to-cart">
									<div class="qty-label">
										Số lượng
										<div class="input-number">
											<input name="qty" type="number" value="1">
											<input name="idsp_hidden" type="hidden" value="{{$value->id_sp}}">
											<span class="qty-up">+</span>
											<span class="qty-down">-</span>
										</div>
									</div>
									<div class="add-to-cart btn-group" data-id="{{$value->id_sp}}" name="add-to-cart" style="margin-left: 25px; margin-top: 15px">
										<button class="add-to-cart-btn"  type="button" data-id="{{$value->id_sp}}" name="add-to-cart" ><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
									</div>
								</div>
							
							<ul class="product-btns">
								<li><a href="#"><i class="fa fa-heart-o"></i> Yêu thích</a></li>
							</ul>

							<ul class="product-links">
								<li>Danh mục:</li>
								<li><a href="{{URL::to('/danhmuc_sanpham/'.$value->id_danhmuc)}}">{{$value->ten_danhmuc}}</a></li>
							</ul>

							<ul class="product-links">
								<li>Chia sẻ:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul>

						</div>
					</div>
				</form>
					
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					
					
					
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li><a data-toggle="tab" href="#tab1">Chi tiết sản phẩm</a></li>
								<li><a data-toggle="tab" href="#tab2">Mô tả sản phẩm</a></li>
								<li class="active"><a data-toggle="tab" href="#tab3">Đánh giá</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-12">
											<p>{{$value->noidung_sp}}</p>
										</div>
									</div>
								</div>
								<!-- /tab1  -->

								<!-- tab2  -->
								<div id="tab2" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-12">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
										</div>
									</div>
								</div>
								<!-- /tab2  -->

								<!-- tab3  -->
								<div id="tab3" class="tab-pane fade in active ">
									<div class="row">
										<!-- Rating -->
										<div class="col-md-3">
											<div id="rating">
												<div class="rating-avg">
													<span>{{$danhgiasaotb}}</span>
													@if($danhgiasaotb == 1)
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
													@elseif($danhgiasaotb == 2)
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
														<i class="fa fa-star-o"></i>
														<i class="fa fa-star-o"></i>
													</div>
													@elseif($danhgiasaotb == 3)
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
														<i class="fa fa-star-o"></i>
													</div>
													@elseif($danhgiasaotb == 4)
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
													</div>
													@elseif($danhgiasaotb == 5)
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
													</div>
													@endif
												</div>
												<ul class="rating">
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 80%;"></div>
														</div>
														<span class="sum">3</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 60%;"></div>
														</div>
														<span class="sum">2</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
												</ul>
											</div>
										</div>
										<!-- /Rating -->

										<!-- Reviews -->
										<div class="col-md-6">
											<div id="reviews">
												<div id="comment_show"></div>
												<ul class="reviews-pagination">
													<li class="active">1</li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
													<li><a href="#">4</a></li>
													<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
												</ul>	
											</div>
										</div>

										
										@if(Session::get('id_kh'))
										<!-- /Reviews -->
										<div class="review-form">
											<div class="input-rating">
												<span>Đánh giá sao: </span>
												@for($count=1; $count<=5; $count++)
													@php
														if($count<= $sao){
															$color = 'color:#db1c1c';
														}else{
															$color = 'color:#ccc';
														}
													@endphp
													
													<div class="stars sao" 
													id="{{$value->id_sp}} - {{$count}}"
													data-index="{{$count}}"
													data-id_sp="{{$value->id_sp}}"
													data-id_kh="{{$khachhang->id_kh}}"
													data-sao="{{$sao}}"
													{{-- class="rating" --}}
													style="cursor:pointer; {{$color}}; font-size:20px;"
													>
														&#9733;
													</div>
												@endfor
											</div>
										</div>
										<!-- Review Form -->
										<div class="col-md-3 mainn">	
											<div id="review-form">
												<form class="review-form">
													@csrf
													<input type="hidden" name="id_sp_bl" class="id_sp_bl" value="{{$value->id_sp}}">
													<input style="margin-top: 5px" class="input ten_binhluan" type="text" value="{{$khachhang->ten_kh}}">
													{{-- <input class="input" type="email" placeholder="Email"> --}}
													<textarea name="binhluan" class="input binhluan" placeholder="Đánh giá sản phẩm"></textarea>
													<div id="notify_comment"></div>
													<button type="button" class="primary-btn send_comment">Submit</button>
												</form>
											</div>
										</div>
										@endif
										<!-- /Review Form -->
									</div>
								</div>
								<!-- /tab3  -->
							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		<div class="section main main-raised">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
                    
					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Sản phẩm liên quan</h3>
						</div>
					</div>
					@foreach($lienquan_sp as $key => $lienquan )
                            <div class='col-md-3 col-xs-6'>
								<a href="{{URL::to('/chitietsanpham/'.$lienquan->id_sp)}}"><div class='product'>
									<div class='product-img'>
										<img src='{{URL::to('public/upload/sanpham/'.$lienquan->hinhanh_sp)}}' style='max-height: 170px;' alt=''>
										<div class='product-label'>
											<span class='sale'>-30%</span>
											<span class='new'>NEW</span>
										</div>
									</div></a>
									<div class='product-body'>
										{{-- <p class='product-category'></p> --}}
										<h3 class='product-name header-cart-item-name'>{{$lienquan->ten_sp}}</h3>
										<h4 class='product-price header-cart-item-info'>{{number_format($value->gia_sp).' '.'VNĐ'}}{{--<del class='product-old-price'>$990.00</del>--}}</h4>
										<div class='product-rating'>
											<i class='fa fa-star'></i>
											<i class='fa fa-star'></i>
											<i class='fa fa-star'></i>
											<i class='fa fa-star'></i>
											<i class='fa fa-star'></i>
										</div>
										<div class='product-btns'>
											<button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>Yêu thích</span></button>
											{{-- <button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to compare</span></button> --}}
											<button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>Xem chi tiết</span></button>
										</div>
									</div>
									<div class='add-to-cart'>
										<button pid='$pro_id' id='product' class='add-to-cart-btn block2-btn-towishlist' href='#'><i class='fa fa-shopping-cart'></i> Thêm vào giỏ hàng</button>
									</div>
								</div>
                            </div>
						@endforeach
					<!-- product -->
					
					<!-- /product -->

				</div>
				<!-- /row -->
                
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->

		<!-- NEWSLETTER -->
		
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
@endforeach
@endsection