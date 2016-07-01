
<!DOCTYPE html>
<html>
<head>
    <title>IE Project 4</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('Stylesheets/Inbox.css') }}">
</head>
<body>

<div id="header">
    <h1>Inbox</h1>
    <a style="color: red" href="/profile">{{$user->name.':'.$user->email}}</a>
    <a style="color: red" href="/logout">LOG OUT!!</a>
</div>

<div id="box">
    <h5 id="refresh">Refresh</h5>
    <h5 id="compose">Compose</h5>
    <h5 id="inbox">Inbox</h5>
    <h5 id="sent">Sent</h5>
    Num of Mail:<input type="text" name="numOfMail" id="numOfMail" value="4"><br>
    <input type="radio" name="sortby" id="date" checked="checked" value="date">Sort By Date<br>
    <input type="radio" name="sortby" id="sender" checked="checked" value="sender">Sort By sender<br>
    <input type="radio" name="sortby" id="attach" checked="checked" value="attach">Sort By attachment<br>

</div>
<div id="mails">
</div>
</body>
</html>
<script src="{{ URL::asset('Js/jquery-1.12.0.js') }}"></script>
<script type="text/javascript">
    var last;
    $(document).ready(function(){
        var numOfMail=$("#numOfMail").val();
        $.ajax({
            type:"GET",
            url : "/server?inbox=true&nom="+numOfMail,
            dataType : "xml",
            cache : false ,
            async : false ,
            success : function (xml) {
                last = $(xml).children('mails').children("update").text();
                var all=$(xml).children('mails').children("mail");
                all.each(function(){
                    var text = $(this).children("text").text();

                    if($(this).attr("read")!==undefined){//the email has been read
                        var email='<div class="eachMail" >'+'<div style="background-color:green" class="from">'+$(this).children("from").text();
                    }else if($(this).attr("spam")!==undefined){
                        var email='<div class="eachMail" >'+'<div style="background-color:yellow" class="from">'+$(this).children("from").text();
                    }else{
                        var email='<div class="eachMail" >'+'<div style="background-color:white" class="from">'+$(this).children("from").text();
                    }


                    email+='</div><div class="subject">'+$(this).children("subject").text();
                    email+='</div><div class="text">'+text.substring(0,10);
                    email+='</div><div class="date">'+$(this).children("date").text()+'</div></div>';
                    $("#mails").append(email);

                });
                $(document).on('click','.eachMail',function(){
                    window.location="../server?email=true & from="+$(this).children(".from").text()+"& date="+$(this).children(".date").text();
                });
            },error: function(jqXHR, textStatus, errorThrown)
            {
                // Handle errors here
                console.log('ERRORS: ' + textStatus);
                console.log(jqXHR.responseText);
                // STOP LOADING SPINNER
            }
        });

        $(document).on('click','#refresh',function(){
            window.alert(last);
            numOfMail=$("#numOfMail").val();
            $.ajax({
                type:"GET",
                url : "/server?refresh=true&nom="+numOfMail+"&last="+last,
                dataType : "xml",
                cache : false ,
                async : false ,
                success : function (xml) {
                    var xmlText = new XMLSerializer().serializeToString(xml);
                    window.alert(xmlText);
                    var all=$(xml).children('mails').children("mail");
                    last = $(xml).children('mails').children("update").text();
                    all.each(function(){
                        var text = $(this).children("text").text();

                        if($(this).attr("read")!==undefined){//the email has been read
                            var email='<div class="eachMail" >'+'<div style="background-color:green" class="from">'+$(this).children("from").text();
                        }else if($(this).attr("spam")!==undefined){
                            var email='<div class="eachMail" >'+'<div style="background-color:yellow" class="from">'+$(this).children("from").text();
                        }else{
                            var email='<div class="eachMail" >'+'<div style="background-color:white" class="from">'+$(this).children("from").text();
                        }


                        email+='</div><div class="subject">'+$(this).children("subject").text();
                        email+='</div><div class="text">'+text.substring(0,10);
                        email+='</div><div class="date">'+$(this).children("date").text()+'</div></div>';
                        $("#mails").prepend(email);

                    });
                    $(document).on('click','.eachMail',function(){
                        window.location="../server?email=true & from="+$(this).children(".from").text()+"& date="+$(this).children(".date").text();
                    });
                },error: function(jqXHR, textStatus, errorThrown)
                {
                    // Handle errors here
                    console.log('ERRORS: ' + textStatus);
                    console.log(jqXHR.responseText);
                    // STOP LOADING SPINNER
                }

            });
        });

        $(document).on('click','#compose',function(){
            window.location="/server?compose=true";
        });

        $(document).on('click','#inbox',function(){
            numOfMail=$("#numOfMail").val();
            $("#mails").empty();
            $.ajax({
                type:"GET",
                url : "/server?inbox=true&nom="+numOfMail,
                dataType : "xml",
                cache : false ,
                async : false ,
                success : function (xml) {
                    var all=$(xml).children('mails').children("mail");
                    last = $(xml).children('mails').children("update").text();
                    all.each(function(){
                        var text = $(this).children("text").text();

                        if($(this).attr("read")!==undefined){//the email has been read
                            var email='<div class="eachMail" >'+'<div style="background-color:green" class="from">'+$(this).children("from").text();
                        }else if($(this).attr("spam")!==undefined){
                            var email='<div class="eachMail" >'+'<div style="background-color:yellow" class="from">'+$(this).children("from").text();
                        }else{
                            var email='<div class="eachMail" >'+'<div style="background-color:white" class="from">'+$(this).children("from").text();
                        }


                        email+='</div><div class="subject">'+$(this).children("subject").text();
                        email+='</div><div class="text">'+text.substring(0,10);
                        email+='</div><div class="date">'+$(this).children("date").text()+'</div></div>';
                        $("#mails").append(email);

                    });
                    $(document).on('click','.eachMail',function(){
                        window.location="../server?email=true & from="+$(this).children(".from").text()+"& date="+$(this).children(".date").text();
                    });
                },error: function(jqXHR, textStatus, errorThrown)
                {
                    // Handle errors here
                    console.log('ERRORS: ' + textStatus);
                    console.log(jqXHR.responseText);
                    // STOP LOADING SPINNER
                }
            });
        });

        $(document).on('click','#sent',function(){
            numOfMail=$("#numOfMail").val();
            $("#mails").empty();
            $.ajax({
                type:"GET",
                url : "/server?sent=true&nom="+numOfMail,
                dataType : "xml",
                cache : false ,
                async : false ,
                success : function (xml) {
                    var all=$(xml).children('mails').children("mail");
                    all.each(function(){
                        var text = $(this).children("text").text();

                        if($(this).attr("read")!==undefined){//the email has been read
                            var email='<div class="eachMail" >'+'<div style="background-color:green" class="from">'+$(this).children("from").text();
                        }else if($(this).attr("spam")!==undefined){
                            var email='<div class="eachMail" >'+'<div style="background-color:yellow" class="from">'+$(this).children("from").text();
                        }else{
                            var email='<div class="eachMail" >'+'<div style="background-color:white" class="from">'+$(this).children("from").text();
                        }


                        email+='</div><div class="subject">'+$(this).children("subject").text();
                        email+='</div><div class="text">'+text.substring(0,10);
                        email+='</div><div class="date">'+$(this).children("date").text()+'</div></div>';
                        $("#mails").append(email);
                    });
                    $(document).on('click','.eachMail',function(){
                        window.location="/server?email=true&from="+$(this).children(".from").text()+"&date="+$(this).children(".date").text();
                    });
                },error: function(jqXHR, textStatus, errorThrown)
                {
                    // Handle errors here
                    console.log('ERRORS: ' + textStatus);
                    console.log(jqXHR.responseText);
                    // STOP LOADING SPINNER
                }
            });
        });


        $('input[type=radio][name=sortby]').change(function() {
            numOfMail=$("#numOfMail").val();
            $("#mails").empty();
            $.ajax({
                type:"GET",
                url : "/server?inbox=true&sortby="+this.value+"&nom="+numOfMail,
                dataType : "xml",
                cache : false ,
                async : false ,
                success : function (xml) {
                    last = $(xml).children('mails').children("update").text();
                    var all=$(xml).children('mails').children("mail");

                    all.each(function(){
                        var text = $(this).children("text").text();

                        if($(this).attr("read")!==undefined){//the email has been read
                            var email='<div class="eachMail" >'+'<div style="background-color:green" class="from">'+$(this).children("from").text();
                        }else if($(this).attr("spam")!==undefined){
                            var email='<div class="eachMail" >'+'<div style="background-color:yellow" class="from">'+$(this).children("from").text();
                        }else{
                            var email='<div class="eachMail" >'+'<div style="background-color:white" class="from">'+$(this).children("from").text();
                        }


                        email+='</div><div class="subject">'+$(this).children("subject").text();
                        email+='</div><div class="text">'+text.substring(0,10);
                        email+='</div><div class="date">'+$(this).children("date").text()+'</div></div>';
                        $("#mails").append(email);

                    });
                    $(document).on('click','.eachMail',function(){
                        window.location="/server?email=true&from="+$(this).children(".from").text()+"&date="+$(this).children(".date").text();
                    });
                },error: function(jqXHR, textStatus, errorThrown)
                {
                    // Handle errors here
                    console.log('ERRORS: ' + textStatus);
                    console.log(jqXHR.responseText);
                    // STOP LOADING SPINNER
                }
            });
        });

    });

</script>