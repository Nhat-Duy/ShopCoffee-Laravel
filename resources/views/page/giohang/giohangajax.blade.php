@extends('welcome')
@section('home_content')

<section class="section">
    <div class="container-fluid">	
        <div id="cart_checkout">
            <div class="main">
                <div class="table-responsive">
                    <form action="">
                        <div id="issessionset"></div>
                        
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
                            @foreach (Session::get('cart') as $key => $cart)
                            @php
                                // print_r(Session::get('cart'));
                            @endphp
                            @php
                                $total = 2;
                            @endphp

                            @php
                                // print_r(Session::get('cart'));
                                
                                // $total += $subtotal;
                            @endphp
                            
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
                                                <form action="" method="POST">
            
                                                    <input name="qty" type="text" value=" {{$cart['qty_sp']}}">
                                                    <input name="rowId_cart" type="hidden" value="">
                                                    <input type="submit" value="Cập nhật" name="capnhat_giohang" class="btn btn-info btn-sm update">
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hidden-xs text-center">
                                        <p>
                                            <?php 
                                            $subtotal = $cart['gia_sp'] * $cart['qty_sp'];
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
                                            <a onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?')" href="" class="btn btn-danger btn-sm remove" update_id="70">
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
                                        <a href="" class="btn btn-warning">
                                            <i class="fa fa-angle-left"></i>
                                            Quay về
                                        </a>
                                    </td>
                                    <td colspan="2" class="hidden-xs"></td>
                                    <td class="hidden-xs text-center">
                                        <p><?php 
                                            // $subtotal = $cart['gia_sp'] * $cart['qty_sp'];
                                            $total += $subtotal;
                                            echo number_format($total). ' '. 'VNĐ';    
                                            ?></p>
                                    </td>
                                    <td>        
                                        <a href="" {{--data-toggle="modal" data-target="#Modal_register"--}} class="btn btn-success">Thanh toán</a>
                                    </td>
                                </tr>
                            </tfoot>
                            
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection