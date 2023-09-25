
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <meta name="description" content="{{$meta_mota}}">
        <meta name="keywords" content="{{$meta_keywords}}">
        <meta name="robots" content="">
		<title>{{$meta_title}}</title>
        <link rel="canonical" href="{{$url_canonical}}">


        <meta property="og:site_name" content="http://localhost/shopcoffee">
        <meta property="og:description" content="{{$meta_mota}}">
        <meta property="og:title" content="{{$meta_title}}">
        <meta property="og:url" content="{{$url_canonical}}">
        <meta property="og:type" content="website">


		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="{{asset('public/frontend/css/slick.css')}}"/>
		<link type="text/css" rel="stylesheet" href="{{asset('public/frontend/css/slick-theme.css')}}"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="{{asset('public/frontend/css/nouislider.min.css')}}"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="{{asset('public/frontend/css/font-awesome.min.css')}}">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}"/>
		<link type="text/css" rel="stylesheet" href="{{asset('public/frontend/css/accountbtn.css')}}"/>
		
		<link type="text/css" rel="stylesheet" href="{{asset('public/frontend/css/sweetalert.css')}}"/>

		
		
         
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    <style>
        #navigation {
          background: #FF4E50;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #F9D423, #FF4E50);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #F9D423, #FF4E50); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

          
        }
        #header {
  
            background: #780206;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #061161, #780206);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #061161, #780206); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

  
        }
        #top-header {
              
  
            background: #870000;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #190A05, #870000);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #190A05, #870000); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */


        }
        #footer {
            background: #7474BF;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #348AC7, #7474BF);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #348AC7, #7474BF); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */


          color: #1E1F29;
        }
        #bottom-footer {
            background: #7474BF;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #348AC7, #7474BF);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #348AC7, #7474BF); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
          

        }
        .footer-links li a {
          color: #1E1F29;
        }
        .mainn-raised {
            
            margin: -7px 0px 0px;
            border-radius: 6px;
            box-shadow: 0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);

        }
       
        .glyphicon{
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    }
    .glyphicon-chevron-left:before{
        content:"\f053"
    }
    .glyphicon-chevron-right:before{
        content:"\f054"
    }
        

       
        
        </style>

    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> 0364349546</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> duyb1910043@student.ctu.edu.vn</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i>Cần Thơ</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#"><i class="fa fa-inr"></i> INR</a></li>
						<li>    
                            <?php 
                                $id_kh = Session::get('id_kh');
                                if($id_kh != NULL){
                            
                            ?>
                               <div class="dropdownn">
                                  <a href="#" class="dropdownn" data-toggle="modal" data-target="#myModal" ><i class="fa fa-user-o"></i>Nhật Duy</a>
                                  <div class="dropdownn-content">
                                    <a href="" ><i class="fa fa-user-circle" aria-hidden="true" ></i>My Profile</a>
                                    <a href="{{URL::to('/dangxuat')}}"  ><i class="fa fa-sign-in" aria-hidden="true"></i>Đăng Xuất</a>
                                    <?php 
                                    }else{
                                    ?>
                                    <a href="{{URL::to('/login_checkout')}}"><i class="fa fa-sign-in" aria-hidden="true" ></i>Đăng nhập</a>
                                    <?php 
                                        }
                                    ?> 
                                  </div>
                                </div>

                            
                                <div class="dropdownn">
                                  <a href="#" class="dropdownn" data-toggle="modal" data-target="#myModal" ><i class="fa fa-user-o"></i> My Account</a>
                                  <div class="dropdownn-content">
                                    
                                  
                                    <a href="{{URL::to('/sign_up')}}"><i class="fa fa-user-plus" aria-hidden="true"></i>Đăng ký</a>
                                  </div>
                                </div>
                            </li>				
					</ul>
					
				</div>
			</div>
			<!-- /TOP HEADER -->
			
			

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
								<font style="font-style:normal; font-size: 33px;color: aliceblue;font-family: serif">
                                        ND Coffee
                                    </font>
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form action="{{URL::to('/timkiem')}}" method="POST">
                                    {{ csrf_field() }}
									<select class="input-select">
										<option value="0">Danh mục</option>
										<option value="1">Trà Sữa</option>
										<option value="1">Hồng Trà</option>
									</select>
									<input class="input" name="key" id="search" type="text" placeholder="Tìm Kiếm...">
									<button type="submit" name="tim" id="search_btn" class="search-btn">Tìm</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div>
									<a href="">
										<i class="fa fa-heart"></i>
										<span>Yêu thích</span>
									</a>
								</div>
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Giỏ hàng</span>
										<div class="badge qty">0</div>
									</a>
									<div class="cart-dropdown"  >
										<div class="cart-list" id="cart_product">
										</div>
										<div class="cart-btns">
											<a href="{{URL::to('/giohangajax')}}" style="width:100%;"><i class="fa fa-edit"></i>Xem giỏ hàng</a>
										</div>
									</div>
										
									</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->
		<nav id='navigation'>
			<!-- container -->
            <div class="container" id="get_category_home">
                <ul class="main-nav nav navbar-nav">
                    <li class="active">
                        <a href="{{URL::to('/')}}">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{URL::to('/danhmuc_sanpham/3')}}">Sản phẩm</a>
                    </li>
                    <li>
                        <a href="{{URL::to('/cafe_sp')}}">Giới thiệu</a>
                    </li>
                </ul>
            </div>
				<!-- responsive-nav -->
				
			<!-- /container -->
		</nav>
            

		<!-- NAVIGATION -->
		
		<div class="modal fade" id="Modal_login" role="dialog">
                        <div class="modal-dialog">
													
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              
                            </div>
                            <div class="modal-body">
                            </div>
                            
                          </div>
													
                        </div>
                      </div>
                <div class="modal fade" id="Modal_register" role="dialog">
                        <div class="modal-dialog" style="">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              
                            </div>
                            <div class="modal-body">
                            
          
                            </div>
                            
                          </div>

                        </div>
                      </div>
		
                      @yield('home_content')
  

        

                <div id="newsletter" class="section">
                    <!-- container -->
                    <div class="container">
                        <!-- row -->
                        <div class="row">
                            <div class="col-md-12">
                            
                                <div class="newsletter">
                                    <p>Đăng ký nhận <strong>CẬP NHẬT ƯU ĐÃI</strong></p>
                                    <form id="offer_form" onsubmit="return false">
                                        <input class="input" type="email" id="email" name="email" placeholder="Nhập email của bạn...">
                                        <button class="newsletter-btn" value="Sign Up" name="signup_button" type="submit"><i class="fa fa-envelope"></i> Đặt mua</button>
                                    </form>
                                    <div class="" id="offer_msg">
                                        <!--Alert from signup form-->
                                    </div>
                                    <ul class="newsletter-follow">
                                        <li>
                                            <a href="https://github.com/puneethreddyhc"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="https://github.com/puneethreddyhc"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="https://github.com/puneethreddyhc"><i class="fa fa-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a href="https://github.com/puneethreddyhc"><i class="fa fa-github"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                    </div>
                    <!-- /container -->
                </div>
                <footer id="footer">
                    <!-- top footer -->
                    <div class="section">
                        <!-- container -->
                        <div class="container">
                            <!-- row -->
                            <div class="row">
                                <div class="col-md-3 col-xs-6">
                                    <div class="footer">
                                        <h3 class="footer-title">Về chúng tôi</h3>
                                        <p>Đây là dự án nhỏ Hệ thống quản lý cơ sở dữ liệu nhỏ của tôi</p>
                                        <ul class="footer-links">
                                            <li><a href="#"><i class="fa fa-map-marker"></i>Ninh Kiều, Cần Thơ</a></li>
                                            <li><a href="#"><i class="fa fa-phone"></i>0364349546</a></li>
                                            <li><a href="#"><i class="fa fa-envelope-o"></i>duyb1910043@gmail.com</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6 text-center" style="margin-top:80px;">
                                    <ul class="footer-payments">
                                        <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                                        <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                                        <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                                        <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                                        <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                                        <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                                    </ul>
                                    <span class="copyright">
                                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> Copyright ©2023 All rights reserved <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#" target="_blank">PuneethRdddyHC</a>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    </span>
                                </div>
        
                                <div class="col-md-3 col-xs-6">
                                    <div class="footer">
                                        <h3 class="footer-title">Danh mục</h3>
                                        <ul class="footer-links">
                                            <li><a href="#">Trà Sữa</a></li>
                                            <li><a href="#">Hồng Trà</a></li>
                                            <li><a href="#">Cà Phê</a></li>
                                            <li><a href="#">Món khác</a></li>
                                            {{-- <li><a href="#">Accessories</a></li> --}}
                                        </ul>
                                    </div>
                                </div>
        
                                <div class="clearfix visible-xs"></div>
        
                                
                            </div>
                            <!-- /row -->
                        </div>
                        <!-- /container -->
                    </div>
                    <!-- /top footer -->
                        
        
                    <!-- bottom footer -->
                    
                    <!-- /bottom footer -->
                </footer>
                <script src="{{asset('public/frontend/js/jquery.min.js')}}"></script>
                <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
                <script src="{{asset('public/frontend/js/slick.min.js')}}"></script>
                <script src="{{asset('public/frontend/js/nouislider.min.js')}}"></script>
                <script src="{{asset('public/frontend/js/jquery.zoom.min.js')}}"></script>
                <script src="{{asset('public/frontend/js/main.js')}}"></script>
                <script src="{{asset('public/frontend/js/actions.js')}}"></script>
                <script src="{{asset('public/frontend/js/sweetalert.js')}}"></script>
                <script src="{{asset('public/frontend/js/jquery.payform.min.js')}}" charset="utf-8"></script>

                {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
                <div id="fb-root"></div>
                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0" nonce="BIQRpw3q"></script>
                <div id="fb-root"></div>
                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0" nonce="TaeuBJgP"></script>
                <script src="js/script.js"></script>

                <script>var c = 0;
                    function menu(){
                    if(c % 2 == 0) {
                        document.querySelector('.cont_drobpdown_menu').className = "cont_drobpdown_menu active";    
                        document.querySelector('.cont_icon_trg').className = "cont_icon_trg active";    
                        c++; 
                        }else{
                        document.querySelector('.cont_drobpdown_menu').className = "cont_drobpdown_menu disable";        
                        document.querySelector('.cont_icon_trg').className = "cont_icon_trg disable";        
                        c++;
                        }
                    }

                </script>
            
            <script type="text/javascript">
                $('.block2-btn-addcart').each(function(){
                    var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
                    $(this).on('click', function(){
                        swal(nameProduct, "is added to cart !", "success");
                    });
                });
        
                $('.block2-btn-addwishlist').each(function(){
                    var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
                    $(this).on('click', function(){
                        swal(nameProduct, "is added to wishlist !", "success");
                    });
                });
            </script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('.add-to-cart').click(function(){
                    var id = $(this).data('id');
                    var id_sp_giohang = $('.id_sp_giohang_' + id).val();
                    var ten_sp_giohang = $('.ten_sp_giohang_' + id).val();
                    var hinhanh_sp_giohang = $('.hinhanh_sp_giohang_' + id).val();
                    var gia_sp_giohang = $('.gia_sp_giohang_' + id).val();
                    var qty_sp_giohang = $('.qty_sp_giohang_' + id).val();
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url: '{{url('/themgiohangajax')}}',
                        method: 'POST',
                        data:{id_sp_giohang:id_sp_giohang, ten_sp_giohang:ten_sp_giohang, hinhanh_sp_giohang:hinhanh_sp_giohang, gia_sp_giohang:gia_sp_giohang, qty_sp_giohang:qty_sp_giohang, _token:_token},
                        success:function(data){
                            swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                                },
                                function(){
                                    window.location.href="{{url('/giohangajax')}}";
                            });
                        }
                    });
                });
                
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('.choose').on('change', function(){
                    var action = $(this).attr('id');
                    var ma_id = $(this).val();
                    var _token = $('input[name="_token"]').val();
                    var result = '';

                    // alert(action);
                    // alert(matp);
                    // alert(_token);

                    if(action == 'city'){
                        result = 'province';
                    }else{
                        result = 'wards';
                    }
                    $.ajax({
                        url : '{{url('/select_delivery_home')}}',
                        method: 'POST',
                        data: {action:action, ma_id:ma_id, _token:_token},
                        success:function(data){
                            $('#' + result).html(data);
                        }
                    });
                });
            })
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.caculate_delivery').click(function(){
                    var matp = $('.city').val();
                    var maqh = $('.province').val();
                    var xaid = $('.wards').val();
                    var _token = $('input[name="_token"]').val();
                    if(matp == '' && maqh == '' && xaid == ''){
                        alert('Làm ơn chọn để tính phí vận chuyển!');
                    }else{
                        $.ajax({
                            url : '{{url('/caculate_fee')}}',
                            method: 'POST',
                            data: {matp:matp, maqh:maqh, xaid:xaid, _token:_token},
                            success:function(){
                                location.reload();
                            }
                        });
                    }
                    
                });
            });
        </script>
            
                              