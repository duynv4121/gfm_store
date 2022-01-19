@extends('admin.layout.index')
@section('title','Đơn hàng chi tiết')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Đơn hàng chi tiết</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin giao hàng</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tên khách hàng</th>
                                            <th>Email</th>
                                            <th>Địa chỉ giao hàng</th>
                                            <th>Số điện thoại</th>
                                            <th>Ghi chú khách hàng</th>
                                            <th>Thời gian đặt hàng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php 
                                            $i = 0;
                                        @endphp
                                        @foreach($order as $row)
                                        <tr>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->email}}</td>
                                            <td>{{$row->address}}</td>
                                            <td>{{$row->phone}}</td>
                                            <td>{{$row->notes}}</td>
                                            <td>{{date('H:i d/m/Y',strtotime($row->created_at))}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Chi tiết đơn hàng</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã đơn hàng</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                            <th>Mã giảm giá</th>
                                            {{-- <th></th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php 
                                            $i = 0;
                                            $total = 0;
                                        @endphp
                                        @foreach($order_detail as $row)
                                        @php 
                                            $i++;
                                            $subtotal = $row->product_price * $row->product_quanlity;
                                            $total += $subtotal;
                                            $mark_money = $row->mark_to_money;
                                        @endphp
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$row->order_code}}</td>
                                            <td>{{$row->product_name}}</td>
                                            <td>{{number_format($row->product_price)}}đ</td>
                                            <td>{{$row->product_quanlity}}</td>
                                            <td>{{number_format($subtotal)}}đ</td>
                                            <td>{{$row->product_coupon}}</td>
                                        </tr>
                                        @endforeach

                                       
                                        

                                        <tr>
                                            <td colspan="8" style="font-weight: bold">
                                                @if ($coupon_condition == 1)
                                                    Hóa đơn ban đầu: {{number_format($total)}}đ<br>
                                                    Số tiền sau giảm giá: {{number_format(($total * $coupon_value)/100)}}đ<br>                                          
                                                    Phí vận chuyển: {{number_format($row->product_feeship)}}đ<br> 
                                                    @if($mark_money != 0)
                                                        Đổi điểm tích lũy: {{number_format($mark_money)}} đ<br>
                                                    @endif
                                                    Tổng hóa đơn: {{number_format((($total * $coupon_value)/100) + $row->product_feeship - $mark_money)}}đ
                                                @elseif ($coupon_condition == 2)
                                                    Hóa đơn ban đầu: {{number_format($total)}}đ<br>
                                                    Số tiền sau giảm giá: {{number_format($total - $coupon_value)}}đ <br>                                               
                                                    Phí vận chuyển: {{number_format($row->product_feeship)}}đ<br>  
                                                    @if($mark_money != 0)
                                                        Đổi điểm tích lũy: {{number_format($mark_money)}} đ<br>
                                                    @endif                                              
                                                    Tổng hóa đơn: {{number_format(($total - $coupon_value) + $row->product_feeship -$mark_money)}}đ 
                                                @else
                                                    Hóa đơn ban đầu: {{number_format($total)}}đ<br>
                                                    Phí vận chuyển: {{number_format($row->product_feeship)}}đ<br>  
                                                    @if($mark_money != 0)
                                                        Đổi điểm tích lũy: {{number_format($mark_money)}} đ<br>
                                                    @endif                                            
                                                    Tổng hóa đơn: {{number_format($total + $row->product_feeship - $mark_money)}}đ
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                @foreach ($order as $val)
                                                @if($val->status == 0)
                                                <form style="width: 250px;"">
                                                    @csrf
                                                    <select class="form-control order_detail">
                                                        <option value="">-----Chọn tình trạng đơn hàng-----</option>
                                                        <option id="{{$val->id}}" value="0" selected>Chưa xử lý</option>
                                                        <option id="{{$val->id}}" value="1">Đã xử lý</option>
                                                        <option id="{{$val->id}}" value="2" >Đơn hàng bị hủy</option>
                                                    </select>
                                                </form>
                                                @elseif ($val->status == 1)
                                                <form style="width: 250px;">
                                                    @csrf
                                                    <select class="form-control order_detail">
                                                        <option value="">-----Chọn tình trạng đơn hàng-----</option>
                                                        <option id="{{$val->id}}" value="0">Chưa xử lý</option>
                                                        <option id="{{$val->id}}" value="1" selected>Đã xử lý</option>
                                                        <option id="{{$val->id}}" value="2">Đơn hàng bị hủy</option>
                                                    </select>
                                                </form>
                                                @else
                                                <form style="width: 250px;">
                                                    @csrf
                                                    <select class="form-control order_detail">
                                                        <option value="">-----Chọn tình trạng đơn hàng-----</option>
                                                        <option id="{{$val->id}}" value="0">Chưa xử lý</option>
                                                        <option id="{{$val->id}}" value="1">Đã xử lý</option>
                                                        <option id="{{$val->id}}" value="2" selected>Đơn hàng bị hủy</option>
                                                    </select>
                                                </form>
                                                @endif
                                                @endforeach
                                            </td>
                                            <td><a href="{{url('admin/printOrder/'.$val->order_code)}}"><i class="fa fa-print"></i>In đơn hàng</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection