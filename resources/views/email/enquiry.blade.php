<!DOCTYPE html>
<html lang="en">
<body>
<p>Hello Admin.</p>
<p>Here are the enquiry details:</p>
<p><b>Name</b> : <i>{{$data->first_name}} {{$data->last_name}}</i></p>
<p><b>Phone</b> : <i>{{$data->phone}}</i></p>
<p><b>Email</b> : <i>{{$data->email}}</i></p>
<p><b>Message</b> : <i>{{$data->message}}</i></p>
</body>
</html>