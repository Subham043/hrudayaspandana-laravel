<!DOCTYPE html>
<html lang="en">
<body>
<p>Hello Admin.</p>
<p>Here are the volunteer details:</p>
<p><b>Name</b> : <i>{{$data->first_name}} {{$data->last_name}}</i></p>
<p><b>Phone</b> : <i>{{$data->phone}}</i></p>
<p><b>Email</b> : <i>{{$data->email}}</i></p>
<p><b>Address</b> : <i>{{$data->address}}</i></p>
<p><b>Aadhar</b> : <i>{{$data->aadhar}}</i></p>
<p><b>Interest</b> : <i>{{$data->interest}}</i></p>
</body>
</html>