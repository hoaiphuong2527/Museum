<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Museum</title>
        <link rel="shortcut icon" href="{{ URL::asset('frontend/images/favicon.ico')}}"/>
        <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        <link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet'>
        <link href='http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css' rel='stylesheet'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="{{ URL::asset('frontend/css/login.css')}}" rel="stylesheet" type="text/css"/>
        <script type="text/javascript">
            function KiemTraCode(){
                var testCode = document.getElementById('code');
                // alert(testCode);

                if(testCode.value == "112233")
                {
                    location.href = '{{ URL::asset('/homepage')}}';
                }else{
                    alert("Code không chính xác! Xin vui lòng nhập lại code");
                    return false;
                }
            }
            $(document).ready(function () {
                $('.num').click(function () {
                    var num = $(this);
                    var text = $.trim(num.find('.txt').clone().children().remove().end().text());
                    var telNumber = $('#code');
                    $(telNumber).val(telNumber.val() + text);
                });

                $("#clear").click(function() {
                    $("#code").val("");
                });

                $('#code').click(function(){
                    document.getElementById('keyboard').style.display = "block";
                });

                $('.body-content, .logo').click(function() {
                    document.getElementById('keyboard').style.display = "none";
                })
            });
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
                    <img src="{{ URL::asset('frontend/images/logo.png')}}" alt="logo">
                </div>
                <!-- Logo -->

                <!-- Form-->
                <div class="login-page account-container">
                    <h1>WELCOME TO THE WAR REMNANTS MUSEUM </h1>
                    <form action="" method="post">
                        {{ csrf_field() }}
                        <div class="form-group" >
                            <input class="form-control" placeholder="code" name="code" type="text" value="" id="code">
                            <div style="background-color: #f7f1e7">
                                 @include('Frontend.keyboard') 
                            </div>
                           
                        </div>
                        <!-- Button next -->
                        <a class="btn submit-button" onClick="return KiemTraCode('code')" href="{{ URL::asset('/homepage')}}" >Tiếp tục</a>
                        <!-- End Button next -->
                    </form>
                </div>
                <!-- End Form -->

            </div>
            <!-- End Form Code-->
        </div>
    </body>
</html>