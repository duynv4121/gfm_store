<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hóa Đơn Mua Hàng</title>
<link rel="shortcut icon" href="{{asset('admin/images/logo/logo.png')}}" type="image/png">
</head>

<body onLoad="window.print()">
    <div id="wrapper" style="margin:0 auto; width:500px;">
        <table width="100%">
            <tr>
                <td height="25" valign="top" align="center">
                    <div align="left">
                        <table width="100%">
                            <tbody>
                                <tr>
                                    <td width="5" height="95">&nbsp;</td>
                                    <td width="343">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2"><strong>CỬA HÀNG CUNG CẤP THỰC PHẨM GREEN FARM MARKET</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Địa chỉ: </td>
                                                                    <td>Công Viên Phần Mềm Quang Trung</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Hotline </td>
                                                                    <td>0859 380 670</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Email: </td>
                                                                    <td>greenfarmmarket@gfmstore.com</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="562" height="25" valign="top" align="center">
                    <hr>
                    <strong>
                        <font color="#FF0000" size="+2">HÓA ĐƠN XUẤT HÀNG</font>
                    </strong>
                </td>
            </tr>
            <tr>
                <td height="54">
                    <div align="left">

                        <b>Thông tin Khách hàng:</b>
                    </div>
                    <table width="100%">
                        <tr>
                            <td width="3%">&nbsp;</td>
                            <td width="34%">Họ tên:</td>
                            <td width="34%">{{$shipping->name}}</td>
                        </tr>
                        
                        <tr>
                            <td>&nbsp;</td>
                            <td>Email: </td>
                            <td>{{$shipping->email}}</td>
                        </tr>

                        <tr>
                            <td>&nbsp;</td>
                            <td>Số điện thoại: </td>
                            <td>{{$shipping->phone}}</td>
                        </tr>

                        <tr>
                            <td>&nbsp;</td>
                            <td>Địa chỉ: </td>
                            <td>{{$shipping->address}}</td>
                        </tr>

                        <tr>
                            <td>&nbsp;</td>
                            <td>Ghi chú: </td>
                            <td>{{$shipping->notes}}</td>
                        </tr>

                    </table>
                    <br />
                    <span class="style3"><B>Thông tin về đơn đặt hàng : </B></span>
                    <table width="100%" style="border-collapse:collapse;">
                        <tr>
                            <td width="5%" bgcolor="#CCCCCC" align="left" style="border:1px solid green;">
                                <div align="center">STT</div>
                            </td>
                            <td width="30%" bgcolor="#CCCCCC" align="left" style="border:1px solid green;">
                                <div align="center">Tên hàng</div>
                            </td>
                            <td width="25%" bgcolor="#CCCCCC" align="left" style="border:1px solid green;">
                                <div align="center">Giá</div>
                            </td>
                            <td width="20%" bgcolor="#CCCCCC" align="left" style="border:1px solid green;">
                                <div align="center">Số lượng</div>
                            </td>
                            <td width="35%" align="right" bgcolor="#CCCCCC" align="left"
                                style="border:1px solid green;">
                                <div align="center">Tổng cộng</div>
                            </td>
                        </tr>
                        @php
                            $stt = 1;
                        @endphp
                        @foreach ($order_detail as $val)
                            <tr>
                                <td align="left" style="border:1px solid green;">
                                   
                                    {{$stt++}}
                                </td>
                                <td align="left" style="border:1px solid green;">
                                    <div align="center">{{$val->product_name}}</div>
                                </td>
                                <td align="left" style="border:1px solid green;">
                                    <div align="center">{{number_format($val->product_price)}}</div>
                                </td>
                                <td align="left" style="border:1px solid green;">
                                    <div align="center">{{$val->product_quanlity}}</div>
                                </td>
                                <td align="left" style="border:1px solid green;">
                                    <div align="center">{{number_format($val->product_price * $val->product_quanlity)}} VNĐ</div>
                                </td>
                            </tr>
                        @endforeach
            
                        <br>
                        <tr style="border:1px solid green;">
                            @php $total = 0; @endphp
                            @foreach ($order_detail as $val)
                                @php
                                    $fee_ship = $val->product_feeship;
                                    $subtotal = $val->product_price * $val->product_quanlity;                                     
                                    $total += $subtotal;
                                    $mark_money = $val->mark_to_money;
                                @endphp
                            @endforeach
                            <td style="text-align: right;" colspan="5">
                                @if ($coupon_condition == 1)
                                    Số tiền đơn hàng: {{number_format(($total * $coupon_value)/100)}}đ<br>
                                    Phí vận chuyển: {{number_format($fee_ship)}} VNĐ<br>
                                    @if($mark_money != 0)
                                        Đổi điểm tích lũy: {{number_format($mark_money)}} đ<br>
                                    @endif
                                    Số tiền thu hộ thanh toán: {{number_format((($total * $coupon_value)/100) + $fee_ship - $mark_money)}} VNĐ
                                @elseif ($coupon_condition == 2)
                                    Số tiền đơn hàng: {{number_format($total - $coupon_value)}} VNĐ<br>
                                    Phí vận chuyển: {{number_format($fee_ship)}} VNĐ<br>
                                    @if($mark_money != 0)
                                        Đổi điểm tích lũy: {{number_format($mark_money)}} đ<br>
                                    @endif
                                    Số tiền thu hộ thanh toán: {{number_format(($total - $coupon_value) + $fee_ship - $mark_money)}} VNĐ
                                @elseif($shipping->payment_type == 2)
                                    Số tiền đơn hàng: {{number_format($total)}} VNĐ<br>
                                    @if($mark_money != 0)
                                        Đổi điểm tích lũy: {{number_format($mark_money)}} đ<br>
                                    @endif
                                    Số tiền thu hộ thanh toán: 0 VNĐ
                                @else
                                    Số tiền đơn hàng: {{number_format($total)}} VNĐ<br>
                                    Phí vận chuyển: {{number_format($fee_ship)}} VNĐ<br>
                                    @if($mark_money != 0)
                                        Đổi điểm tích lũy: {{number_format($mark_money)}} đ<br>
                                    @endif
                                    Số tiền thu hộ thanh toán: {{number_format($total + $fee_ship - $mark_money)}} VNĐ
                                @endif
                            </td>
                        </tr>

                    </table>

                    <table width="452" border="0" align="right">
                        <tr>
                            <td colspan="3">
                                <div align="right"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div align="center"><strong>Nhân viên Bán hàng</strong></div>
                            </td>
                            <td>&nbsp;</td>
                            <td>
                                <div align="center"><strong>Khách hàng</strong></div>
                            </td>
                        </tr>
                        <tr>
                            <td height="23">
                                <div align="center">(Ký tên + Đóng dấu Công ty)</div>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td height="73">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                    <p>&nbsp;</p>
                    <p><br></p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>