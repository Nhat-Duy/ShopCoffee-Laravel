@extends('welcome')
@section('home_content')

<section class="section">
    <div class="container-fluid">	
        <div id="cart_checkout">
            <div class="main">
                <div class="table-responsive">
                    <form action="">
                        <div id="issessionset"></div>
                        <?php 
                        $content = Cart::content();
                        // echo '<pre>';
                        // print_r($content);
                        // echo '</pre>';
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
                            @foreach ($content as $v_content)
                            <tbody>
                                <tr>
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <img src="{{URL::to('public/upload/sanpham/'.$v_content->options->hinhanh)}}" style="height: 70px; width: 75px;">
                                                <h4 class="nomargin product-name header-cart-item-name">
                                                    <a href="">{{$v_content->name}}</a>
                                                </h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <div style="max-width=50px;">
                                                    <p>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price">
                                        <input type="text" class="form-control price" value="{{number_format($v_content->price).' '.'VNĐ'}}" readonly="readonly">
                                    </td>
                                    <td data-th="Quantity">
                                        {{-- <input type="text" class="form-control qty" value="1" > --}}
                                        <div class="qty-label">
                                            <div class="input-number">
                                                <form action="{{URL::to('/capnhat_giohang')}}" method="POST">
                                                    {{csrf_field()}}
                                                    <input name="qty" type="text" value="{{$v_content->qty}}">
                                                    <input name="rowId_cart" type="hidden" value="{{$v_content->rowId}}">
                                                    <input type="submit" value="Cập nhật" name="capnhat_giohang" class="btn btn-info btn-sm update">
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hidden-xs text-center">
                                        <p>
                                            <?php 
                                            $subtotal = $v_content->price * $v_content->qty;
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
                                            <a onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?')" href="{{URL::to('/xoagiohang/'.$v_content->rowId)}}" class="btn btn-danger btn-sm remove" update_id="70">
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
                                        <p>{{number_format(Cart::subtotal(0, ',' , '.')). ' '. 'VNĐ' }}</p>
                                    </td>
                                    <td>
                                        <?php 
                                            $id_kh = Session::get('id_kh');
                                            $id_tt = Session::get('id_tt');
                                            if($id_kh != NULL && $id_tt == NULL){
                                        
                                        ?>
                                            <a href="{{URL::to('/thanhtoan')}}" {{--data-toggle="modal" data-target="#Modal_register"--}} class="btn btn-success">Thanh toán</a>
                                        <?php 
                                            }elseif($id_kh != NULL && $id_tt != NULL){
                                        ?>
                                            <a href="{{URL::to('/payment')}}" {{--data-toggle="modal" data-target="#Modal_register"--}} class="btn btn-success">Thanh toán</a>
                                        <?php 
                                            }else{
                                        ?>
                                            <a href="{{URL::to('/login_checkout')}}" {{--data-toggle="modal" data-target="#Modal_register"--}} class="btn btn-success">Thanh toán</a>
                                        <?php 
                                            }
                                        ?>
                                        
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