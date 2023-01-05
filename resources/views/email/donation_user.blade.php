<!DOCTYPE html>
<html lang="en">
<body>
<p>Hello {{$data->first_name}} {{$data->last_name}}.</p>
<p>Thank you for your kind donation made towards {{$data->trust==1 ? 'Sai Mayee Trust' : 'Sri Sai Meru Mathi Trust'}}</p>
<p>Here is the detail of the donation made by you </p>
<p><b>Name</b> : <i>{{$data->first_name}} {{$data->last_name}}</i></p>
<p><b>Phone</b> : <i>{{$data->phone}}</i></p>
<p><b>Email</b> : <i>{{$data->email}}</i></p>
<p><b>City</b> : <i>{{$data->city}}</i></p>
<p><b>State</b> : <i>{{$data->state}}</i></p>
<p><b>Amount</b> : <i>{{$data->amount}}</i></p>
<p><b>Trust</b> : <i>{{$data->trust==1 ? 'Sai Mayee Trust' : 'Sri Sai Meru Mathi Trust'}}</i></p>
<p><b>Pan No.</b> : <i>{{$data->pan}}</i></p>
</body>
</html>