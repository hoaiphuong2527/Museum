<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Museum</title>
        <link rel="shortcut icon" href="{{ URL::asset('backend/img/favicon.ico')}}"/>
        <link href="{{ URL::asset('backend/css/login.css')}}" rel="stylesheet" type="text/css"/>
        <script type="text/javascript">
            function KiemTraCode(code){
                var testCode = document.getElementById(code);
                if(testCode.value == "BML001ASD")
                {
                    return true;
                }else{
                    alert("Code không chính xác! Xin vui lòng nhập lại code");
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <div class="container">
            <!-- Background -->
            <div class="cover-bg"></div>
            <!-- Background -->
            <!-- Form Code -->
            <div class="landing-page">
                <!-- Logo -->
                <div class="logo">
                    <img src="{{ URL::asset('backend/images/logo.png')}}" alt="logo">
                </div>
                <!-- Logo -->

                <!-- Form-->
                <div class="login-page account-container">
                    <h1>WELCOME TO THE WAR REMNANTS MUSEUM </h1>
                    <form action="" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input class="form-control" placeholder="Email" name="email" type="text" id="email" autocomplete=false><hr>
                            <input class="form-control" placeholder="password" name="password" type="password" id="password">
                        </div>
                        <!-- Button next -->
                        <input class="btn submit-button" type="submit" value="Đăng nhập">
                        <!-- End Button next -->
                        <span class="help-block">
                            <strong style="color: yellow;padding-top: 10px">{{ $errors->first() }}</strong>
                        </span>
                        <!--OPTION LOGIN-->
                            <div class="extra-login-options">
                                <div class="checkbox">
                                    <input type="checkbox" id="remember-me" name="remember">
                                    <label for="remember-me" class="box">Nhớ mật khẩu</label>
                                    <a href="#" class="pull-right">Quên mật khẩu?</a>
                                </div> 

                                <label for="remember-me" class="noselect"></label>
                            </div>
                        <!--/END OPTION LOGIN-->
                    </form>
                </div>
                <!-- End Form -->

            </div>
            <!-- End Form Code-->
        </div>
    </body>
</html>