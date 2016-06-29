<!DOCTYPE html>
<html>
<head>
    <title>IE Project 4</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('Stylesheets/ComposeEmail.css')}}">
</head>
<body>
<div id="container">
    <div class="forms">
        <form id="send" action="/send" method="post">
            {{ csrf_field() }}
            <div class="titles">
                <h5>To:</h5>
                <h5>Subject:</h5>
                <h5>Text:</h5>
                <h5 id="attach">Attachment:</h5>
                <input id="submit" type="submit" value="Send">
            </div>

            <div class="inputs">
                <input type="text" name="to">
                <input type="text" name="subject">
                <textarea rows="10" cols="70" name="text"></textarea>
                <input type="file" name="attachment">
            </div>
        </form>
    </div>
</div>
</body>
</html>
<script>
    document.getElementById("submit").onclick = function(){
        window.location.replace("/");
    };
</script>