
<h1> allpatient </h1>
<table border="1">
<tr>
<td>id</td>
<td>name</td>
<td>email</td>
<td>mobile</td>
<td>city</td>
<td>address</td>
<td>role</td>
</tr>
@foreach($Plist as $p)
<tr>
<td>{{$p['id']}}</td>
<td>{{$p['name']}}</td>
<td>{{$p['email']}}</td>
<td>{{$p['mobile']}}</td>
<td>{{$p['city']}}</td>
<td>{{$p['address']}}</td>
<td>{{$p['role_id']}}</td>
</tr>
@endforeach
</table>