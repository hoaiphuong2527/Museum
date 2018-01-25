<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Museum</title>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('frontend/css/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('frontend/css/fonts.css')}}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('frontend/css/main.css')}}">
<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
<link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet'>
<link href='http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css' rel='stylesheet'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    function KiemTraCode(){
        var testCode = document.getElementById('telNumber');
        if(testCode.value == "1234")
        {
            location.href = '{{ URL::asset('/demo')}}';
        }else{
            testCode.value = "";
            alert("Không tìm thấy câu chuyện");
            return false;
        }
    }
    $(document).ready(function () {

        $('.num').click(function () {
            var num = $(this);
            var text = $.trim(num.find('.txt').clone().children().remove().end().text());
            var telNumber = $('#telNumber');
            $(telNumber).val(telNumber.val() + text);
        });

        $("#clear").click(function() {
            $("#telNumber").val("");
        });

        $('#telNumber').click(function(){
            document.getElementById('keyboard').style.display = "block";
        });

        $('.body-content, .logo').click(function() {
            document.getElementById('keyboard').style.display = "none";
        })
    });
</script>