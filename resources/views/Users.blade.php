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
@foreach($contacts as $contact)

<div class="person">
    <img src=""><br>
    <span>First Name: </span>
    <span >{{$contact->name}}</span><br>
    <span>Last Name: </span>
    <span>{{$contact->last_name}}</span><br>
    <span>Email: </span>
    <span>{{$contact->email}}</span><br>
    @if($contact->id != 0)
    <form action="/add" method="get">
        <input type="hidden" name="id" value="{{$contact->id}}">
        <input type="submit" value="Add friend"/>
    </form>
    @endif
    <form action="/block" method="get">
        <input type="hidden" name="id" value="{{$contact->id}}">
        <input type="submit" value="Block"/>
    </form>
</div>

@endforeach
</div>
</body>
</html>
