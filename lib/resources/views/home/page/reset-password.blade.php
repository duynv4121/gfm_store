<link rel="stylesheet" href="{{asset('home/login/css/login2.css')}}">
<section style="background-image: url({{asset('home/login/img/dt.jpg')}})">
    <div class="containers">
        <div class="user signinBx">
            <div class="imgBx"><img src="{{asset('home/login/img/forgot.jpg')}}"></div>
            <div class="formBx">    
                @php
                    $token = $_GET['token'];
                @endphp     
                <form action="{{url('/update-password-new')}}" method="POST">
                    @csrf
                    <div style="text-align:center">
                        <img src="{{asset('home/login/img/logo.png')}}" width="70px" height="70px" >
                    </div>
                    <h2>Đặt lại mật khẩu</h2>
                        <input type="hidden" name="token" value="{{$token}}">
                        <input type="password" name="password" placeholder="Mật khẩu">
                            @error('password')<p class="alert-danger">{{ $message }}</p>@enderror
                        <input type="password" name="re-password" placeholder="Xác nhận mật khẩu">
                            @error('re-password')<p class="alert-danger">{{ $message }}</p>@enderror
                        <input type="submit" value="Đặt mật khẩu">
                    <p class="signup">Đi đến đăng nhập?<a href="{{url('login')}}">Đăng nhập</a></p>
                </form>
            </div>
        </div>
    </div>
</section>
<script src="{{asset('home/js/sweetalert2.all.js')}}"></script>
@include('sweetalert::alert')