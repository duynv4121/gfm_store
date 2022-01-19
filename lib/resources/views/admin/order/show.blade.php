@extends('admin.layout.index')
@section('title','Đơn hàng')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Đơn hàng</li>
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
                            <h3 class="card-title">Danh sách đơn hàng</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Chủ đơn hàng</th>
                                        <th>Tổng giá tiền</th>
                                        <th>Thanh toán</th>
                                        <th>Tình trạng</th>
                                        <th>Thời gian đặt hàng</th>
                                        <th>Chi tiết đơn hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order as $row)
                                    <tr>
                                        <td>{{$row->order_code}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{number_format($row->total_price)}}đ</td>
                                        <td>{{($row->payment_type==1)?"Thanh toán khi nhận hàng":"Đã thanh toán online"}}</td>
                                        <td>
                                            @if($row->status == 1)
                                                <button class="btn btn-success btn-xs">Đã xử lý - Đã giao hàng</button>
                                            @elseif($row->status == 0)
                                                <button class="btn btn-secondary btn-xs">Đã chờ xử lý</button>
                                            @else
                                                <button class="btn btn-warning btn-xs">Đơn hàng đã bị hủy</button>
                                            @endif
                                        </td>
                                        <td>{{date('d/m/Y H:i',strtotime($row->created_at))}}</td>
                                        <td><a href="{{url('admin/order-detail')}}/{{$row->order_code}}"><i class="fa fa-eye" aria-hidden="true"></i> Chi tiết</a></td>   
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection