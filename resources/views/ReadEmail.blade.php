<!DOCTYPE html>
<html>
<head>
    <title>IE Project 4</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('Stylesheets/ReadEmail.css') }}">
</head>
<body>

    <div id="email">
    <p>An email from:</p><p id="from">{{$mail->from}}</p><br>
    <p>with subject of:</p><p id="subject">{{$mail->title}}</p><br>
    <p>received in date:</p><p id="date">{{$mail->created_at}}</p><br>
    <div id="test"><p id="text">{{$mail->text}}</p></div>
    @if($mail->attachment != 0)
        <button type="button" id="Attchment" name="{{$mail->attachment}}"> Get Attachment</button>
    @endif
    <button type="button" id="deleteMail">Delete this Email</button>

</div>

</body>
</html>
<script src="{{ URL::asset('Js/jquery-1.12.0.js') }}"></script>

    <script type="text/javascript">
                    $(document).on('click','#deleteMail',function(){


                        $.ajax({
                            method: 'get',
                            url: '/server?delete=true&from='+$('#from').text()+'&date='+$('#date').text(),
                            success: function(data){
                                window.location.replace("/");

                            },error: function(jqXHR, textStatus, errorThrown)
                            {
                             // Handle errors here
                             console.log('ERRORS: ' + textStatus);
                             console.log(jqXHR.responseText);
                             // STOP LOADING SPINNER
                             }
                            });

                    });
                    $(document).on('click','#Attchment',function(){


//                        window.alert("/attachment/"+$('#Attchment').attr("name"));

                        window.location.replace("/attachment/"+$('#Attchment').attr("name"));
                    });


    </script>


