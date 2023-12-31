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
                            {{-- @foreach ($donhang as $key => $ord) --}}
                                <li class="active">
                                    <a href="{{URL::to('/lichsudonhang')}}">Tất cả</a>
                                </li>
                            {{-- @endforeach --}}
                            <li>
                                <a href="{{URL::to('/chothanhtoan')}}">Chờ thanh toán</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/dathanhtoan')}}">Đã thanh toán</a>
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

                <div class="container">
                    <div class="row">
                      <div class="col-12">
                        <div class="card shadow">
                          <div class="card-header">
                            <div class="row">
                              <div class="col-md-6">
                                {{-- <h6>Quản lý đơn hàng</h6> --}}
                              </div>
                              <div class="col-md-6 text-right">
                                <!-- Nút thêm danh mục sản phẩm -->
                                <!-- <a class="btn btn-primary" href="{{URL::to('themdanhmuc')}}">
                                  <i class="fas fa-plus"></i> Thêm danh mục sản phẩm
                                </a> -->
                              </div>
                            </div>
                            <?php
                            $message = Session::get('message');
                            if ($message) {
                              echo $message;
                              Session::put('message', null);
                            }
                            ?>
                          </div>
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-bordered table-hover">
                                <thead>
                                  <tr>
                                    <th>Thứ tự</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày đặt hàng</th>
                                    <th>Tình trạng đơn hàng</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @php
                                  $i = 0;
                                  @endphp
                                  @foreach ($donhang as $key => $ord)
                                  @php
                                  $i += 1;
                                  @endphp
                                  <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$ord->ma_dh}}</td>
                                    <td>{{$ord->created_at}}</td>
                                    <td>
                                      @if($ord->tinhtrang_dh == 1)
                                      Chờ thanh toán
                                      @elseif($ord->tinhtrang_dh == 2)
                                      Đã thanh toán
                                      @elseif($ord->tinhtrang_dh == 3)
                                      Đang giao
                                      @elseif($ord->tinhtrang_dh == 4)
                                      Hoàn thành
                                      @else
                                      Đơn hàng bị hủy
                                      @endif
                                    </td>
                                    <td>
                                      <div class="btn-group">
                                        <a class="btn btn-primary" href="{{URL::to('/xemchitietdonhang/'. $ord->ma_dh)}}">
                                          <i class="fas fa-pencil-alt"></i> Xem chi tiết đơn hàng
                                        </a>
                                        {{-- <button onclick="return confirm('Bạn chắc chắn muốn xóa?')" class="btn btn-danger">
                                          <i class="far fa-trash-alt"></i> Hủy đơn hàng
                                        </button> --}}
                                      </div>
                                      {{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#huydon">Hủy đơn hàng</button>

                                        <!-- Modal -->
                                        <div id="huydon" class="modal fade" role="dialog">
                                          <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Lý do hủy đơn hàng</h4>
                                              </div>
                                              <div class="modal-body">
                                                <p><textarea class="with-full" required placeholder="Lý do hủy đơn hàng...(bắt buộc nhập)"></textarea></p>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                <button type="button" class="btn btn-success">Gửi</button>
                                              </div>
                                            </div>

                                          </div>
                                        </div> --}}
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
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