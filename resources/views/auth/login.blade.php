<!DOCTYPE html>
<html>
<head>
    <title>IE Project 4</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('Stylesheets/LoginRegister.css') }}">
    <link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
</head>
</head>
<body>

<div id="container">
    <div class="forms"  style="height: 350px;     width: 510px;">

        <form id="registeration" method="POST" action="/register" enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="titles">
                <h5>First Name :</h5>
                <h5>Last Name :</h5>
                <h5>Email :</h5>
                <h5>Password :</h5>
                <h5></h5><h6></h6>
                <h5>Captcha :</h5>
                <h5>Image :</h5>
                <input type="submit" value="Register" name="Register">
            </div>
            <div class="inputs">
                <input type="text" name="name">
                <input type="text" name="lastname">
                <input type="email" name="email">
                <input type="password" name="password">
                {!! captcha_image_html('RegisterCaptcha') !!}
                <input type="text" id="CaptchaCode" name="CaptchaCode">
                <input type="file" name="image">


            </div>
        </form>
    </div>
    <div class="forms" style="height: 260px;     width: 510px;">
        <form id="login"  method="POST" action="/login">
            {{ csrf_field() }}
            <div class="titles">
                <h5>Email :</h5>
                <h5>Password :</h5>
                <h5>Captcha :</h5>
                <input type="checkbox" id="checkremember" name="remember"> <h6>Remember me</h6>
                <input type="submit" value="Login" name="Login">
            </div>
            <div class="inputs">
                <input type="email" name="email">
                <input type="password" name="password">
                <input type="text" id="CaptchaCode" name="CaptchaCode">
            </div>
        </form>
    </div>
</div>
@if ($errors->has())
<div class="alert alert-danger" style="color: red; ">
    <br>
    <br>
    @foreach ($errors->all() as $error)
    {{ $error }}<br>
    @endforeach
</div>
@endif
</body>

</html>

<script type="text/javascript" src="../../S95-HW4/HTMLs/jquery-1.12.0.js"></script>
<script>
    $(document).ready( function (){
            $.post("../server.php", { login: "user"} , function(data)
            {
                console.log(data);
                if(data==1){
                    var url="../html/inbox.html?"+ getCookie("username");
                    alert(url);
                    setTimeout(function(){ window.location = url; }, 1000);
                }

            });
        }
    );
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1);
            if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
        }
        return "";
    }
</script>




