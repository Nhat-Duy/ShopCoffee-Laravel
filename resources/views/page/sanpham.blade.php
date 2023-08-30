@extends('welcome')
@section('home_content')
<div class="main main-raised"> 
        
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <!-- aside Widget -->
                    <div id="get_category">
                        <div class="aside">
                            <h3 class="aside-title">Danh mục</h3>
                            @foreach ($danhmuc as $key => $cate)
                            <div class="btn-group-vertical">
                                <a href="{{URL::to('/danhmuc_sanpham/'.$cate->id_danhmuc)}}">{{$cate->ten_danhmuc}}</a>
                            </div>
                            <br>
                            @endforeach
                        </div>
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Giá</h3>
                        <div class="price-filter">
                            <div id="price-slider" class="noUi-target noUi-ltr noUi-horizontal"><div class="noUi-base"><div class="noUi-origin" style="left: 0%;"><div class="noUi-handle noUi-handle-lower" data-handle="0" tabindex="0" role="slider" aria-orientation="horizontal" aria-valuemin="0.0" aria-valuemax="100.0" aria-valuenow="0.0" aria-valuetext="1.00" style="z-index: 5;"></div></div><div class="noUi-connect" style="left: 0%; right: 0%;"></div><div class="noUi-origin" style="left: 100%;"><div class="noUi-handle noUi-handle-upper" data-handle="1" tabindex="0" role="slider" aria-orientation="horizontal" aria-valuemin="0.0" aria-valuemax="100.0" aria-valuenow="100.0" aria-valuetext="999.00" style="z-index: 4;"></div></div></div></div>
                            <div class="input-number price-min">
                                <input id="price-min" type="number">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                            <span>-</span>
                            <div class="input-number price-max">
                                <input id="price-max" type="number">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                        </div>
                    </div>
                    <!-- /aside Widget -->
                    
                    <!-- aside Widget -->
                    <div id="get_brand">
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Top selling</h3>
                        <div id="get_product_home">
                            <!-- product widget -->
                            
                            <!-- product widget -->
                        </div>
                    </div>
                    <!-- /aside Widget -->
                </div>
                <!-- /ASIDE -->
                @foreach ($danhmuc_ten as $key => $name)
                    <h3 class="text-center text-danger">Danh mục {{$name->ten_danhmuc}}</h3>
                @endforeach
                <div class="col-md-9">
                    @foreach($danhmuc_by_id as $key => $sanpham )
                    <a href="{{URL::to('/chitietsanpham/'.$sanpham->id_sp)}}">
                        <div class='col-md-3 col-xs-6' >
                            <div class='product' >
                                    <div class='product-img'>
                                        <img src='{{URL::to('public/upload/sanpham/'.$sanpham->hinhanh_sp)}}' style='max-height: 170px;' alt=''>
                                        <div class='product-label'>
                                            <span class='sale'>-30%</span>
                                            <span class='new'>NEW</span>
                                        </div>
                                    </div>
                                
                                <div class='product-body' style="height: 170px;">
                                    
                                    <h3 class='product-name header-cart-item-name'><a href='product.php?p=$pro_id'>{{$sanpham->ten_sp}}</a></h3>
                                    <h4 class='product-price header-cart-item-info'>{{number_format($sanpham->gia_sp).' '.'VNĐ'}}</h4>
                                    <div class='product-rating'>
                                        <i class='fa fa-star'></i>
                                        <i class='fa fa-star'></i>
                                        <i class='fa fa-star'></i>
                                        <i class='fa fa-star'></i>
                                        <i class='fa fa-star'></i>
                                    </div>
                                    <div class='product-btns'>
                                        <button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>Yêu thích</span></button>
                                        
                                        <button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>Xem chi tiết</span></button>
                                    </div>
                                </div>
                                <div class='add-to-cart'>
                                    <button pid='$pro_id' id='product' class='add-to-cart-btn block2-btn-towishlist' href='#'><i class='fa fa-shopping-cart'></i>Thêm vào giỏ hàng</button>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
</div>


@endsection