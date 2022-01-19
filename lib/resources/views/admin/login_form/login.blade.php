<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | GFM</title>
    <base href="{{asset('public/admin')}}/">
    <link rel="shortcut icon" href="images/logo/logo.png" type="image/png">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <section>
        <div class="color"></div>
        <div class="color"></div>
        <div class="color"></div>
        <div class="box">
            <div class="square" style="--i:0;"></div>
            <div class="square" style="--i:1;"></div>
            <div class="square" style="--i:2;"></div>
            <div class="square" style="--i:3;"></div>
            <div class="square" style="--i:4;"></div>
            <div class="container">
                <div class="form">
                    <img src="images/logo/logo.png" alt="GFM Logo">
                    <h2>Dashboard Login</h2>
                    <form method="post">
                        <div class="inputBox">
                            <input type="email" name="email" placeholder="Email của bạn" required>
                        </div>
                        <div class="inputBox">
                            <input type="password" name="password" placeholder="Mật khẩu của bạn" required>
                        </div>
                        @include('errors.note')
                        <div class="inputBox">
                            <input type="submit" value="Đăng nhập">
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>