<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
	body {
		font-family: Arial;
	}

	.coupon {
		border: 5px dotted #bbb;
		width: 80%;
		border-radius: 15px;
		margin: 0 auto;
		max-width: 600px;
	}

	.container {
		padding: 2px 16px;
		background-color: #f1f1f1;
	}

	.promo {
		background: #ccc;
		padding: 3px;
	}

	.expire {
		color: red;
	}
	p.code {
    text-align: center;
    font-size: 20px;
	}
	p.expire {
    text-align: center;
	}
	h2.note {
    text-align: center;
    font-size: large;
    text-decoration: underline;
	}
</style>
</head>
<body>

	<div class="coupon">

		<div class="container">
			<h3>
                Mã khuyến mãi dành cho khách hàng từ shop <a href="{{URL::to('/')}}">Green Farm Martket</a>
			</h3>
		</div>
		<div class="container" style="background-color:white">

			<h2 class="note"><b><i>
				@if($coupon_mail['coupon_condition'] == 1)
					Giảm {{$coupon_mail['coupon_value']}}%
				@else
					Giảm {{number_format($coupon_mail['coupon_value'],0,',','.')}} VNĐ
				@endif
			    cho tổng đơn hàng đặt mua</i></b></h2> 

			<p>Quý khách đã từng mua hàng tại shop <a href="{{URL::to('/')}}">Green Farm Martket</a> nếu đã có tài khoản xin vui lòng <a style="color:red" href="{{URL::to('/login')}}">đăng nhập</a> vào tài khoản để mua hàng và nhập mã code phía dưới để được giảm giá mua hàng ,xin cảm ơn quý khách.Chúc quý khách thật nhiều sức khỏe và bình an trong cuộc sống. </p>
		</div>
		<div class="container">
			<p class="code">Sử dụng Code sau: <span class="promo">{{$coupon_mail['coupon_code']}}</span>với chỉ {{$coupon_mail['coupon_quanlity']}} mã giảm giá,nhanh tay kẻo hết.</p>
			<p class="expire">Ngày bắt đầu : {{$coupon_mail['date_start']}} / Ngày hết hạn: {{$coupon_mail['date_end']}}</p>
		</div>

	</div>

</body>
</html> 
