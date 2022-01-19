
    <div id="wrap-inner">
        <div id="khach-hang">
            <h3>Thông tin khách hàng</h3>
            <p>
                <span class="info">Khách hàng: </span>
                {{($name == null)?"":"$name"}}
            </p>
            <p>
                <span class="info">Email: </span>
                {{($email == null)?"":"$email"}}
            </p>
            <p>
                <span class="info">Điện thoại: </span>
                {{($phone == null)?"":"$phone"}}
            </p>
            <p>
                <span class="info">Địa chỉ: </span>
                {{($address == null)?"":"$address"}}
            </p>
            <p>
                <span class="info">Ghi chứ đơn hàng: </span>
                {{($note == null)?"":"$note"}}
            </p>
        </div>						
        <div id="hoa-don">
            <h3>Hóa đơn mua hàng</h3>							
            <table border="1" class="table-bordered table-responsive">
                <tr class="bold">
                    <td width="30%">Tên sản phẩm</td>
                    <td width="25%">Giá</td>
                    <td width="25%">Số lượng</td>
                    <td width="15%">Thành tiền</td>
                </tr>
                @php
                    $total = 0;
                @endphp
                @foreach ($cart as $key => $val)
                    @php
                        $sub_total = $val['product_price'] * $val['product_amount'];
                        $total += $sub_total;
                    @endphp
                    <tr>
                        <td>{{$val['product_name']}}</td>
                        <td class="price">{{$val['product_price']}}</td>
                        <td class="price">{{number_format($val['product_amount'])}}</td>
                        <td class="price">{{number_format($val['product_price'] * $val['product_amount'])}}</td>
                    </tr>
                @endforeach
                
                <tr>
                    <td colspan="3">Tổng tiền:</td>
                    <td colspan="3" class="total-price">{{number_format($total)}} VNĐ</td>
                </tr>
            </table>
        </div>
        <div id="xac-nhan">
            <br>
            <p align="justify">
                <b>Quý khách đã đặt hàng thành công!</b><br />
                • Sản phẩm của Quý khách sẽ được chuyển đến Địa chỉ có trong phần Thông tin Khách hàng của chúng Tôi sau thời gian 2 đến 3 ngày, tính từ thời điểm này.<br />
                • Nhân viên giao hàng sẽ liên hệ với Quý khách qua Số Điện thoại trước khi giao hàng 24 tiếng.<br />
                <b><br/> Cảm ơn Quý khách đã sử dụng Sản phẩm của shop chúng tôi </b>
            </p>
        </div>
    </div>	
