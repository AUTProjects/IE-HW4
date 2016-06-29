<!DOCTYPE html>
<html>
<head>
    <title>IE Project 4</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('Stylesheets/Profile.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('Stylesheets/LoginRegister.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('Stylesheets/Users.css') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div id="data">

</div>
<form id="registeration" action="/profile" method="POST" style="margin-left: auto;margin-right: auto;">
    {{ csrf_field() }}
    <div style="width: 70%;height: 300px;margin-left: auto;margin-right: auto;">
        <div class="titles">
            <h5>First Name :</h5>
            <h5>Last Name :</h5>
            <h5>Email :</h5>
            <h5>Password :</h5>
            <h5>Image :</h5>
        </div>
        <div class="inputs">

            <input type="text" name="firstname">
            <input type="text" name="lastname">
            <input type="email" name="email">
            <input type="password" name="pass">
            <input type="file" name="image">
        </div>
        <input type="submit" value="Save Changes" style="background-color: #97d9ff">
    </div>
</form>
<div id="contacts">

</div>
</body>
</html>
    <script src="{{ URL::asset('Js/jquery-1.12.0.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                type: "get",
                url: "/profile?ajax=true",
                dataType: "xml",
                cache: false,
                async: false,
                success: function (xml) {
                    var data = $(xml).children('data');
                    var contacts = data.children('contacts');
                    var it = '<img src="' +""+ data.children('image').text() + '"><br><span>First Name: </span><sapn >' + data.children('first').text() + '</span><br><span>Last Name: </span><span>' + data.children('last').text() + '</span><br><span>Email: </span><span>' + data.children('username').text() + '</span>';
                    $("#data").append(it);
                    contacts.children('contact').each(function () {
                        var person = '<div class="person"><img src="' + $(this).children('img').text() + '"><br><span>First Name: </span><span >' + $(this).children('first').text() + '</span><br><span>Last Name: </span><span>' + $(this).children('last').text() + '</span><br><span>Email: </span><span>' + $(this).children('username').text() + '</span><br></div>';
                        $("#contacts").append(person);
                    });
                }, error: function (jqXHR, textStatus, errorThrown) {
                    // Handle errors here
                    window.alert(jqXHR.responseText);
                    console.log('ERRORS: ' + textStatus);
                    console.log(jqXHR.responseText);
                    // STOP LOADING SPINNER
                }
            });
        });

    
    </script>