<h1 style="color: #ff0066"> Hi {{ $user->first_name }} {{ $user->last_name }}</h1>
<p style="color: #1500ff">The New Change Password Is given Below</p>

<h2 style="color: #3cca1f"> Your email/ Login Id: '{{ $user->email }}' </h2>
<h2 style="color: #3cca1f">  Password is: '{{ $password }}' </h2>
<h2 style="color: #1500ff"> Updated at: '{{ $user->updated_at->format('d/m/Y H:i:s')}}' </h2>

<h1 style="color:#00cc00; font-family: 'Water Brush', cursive;"> So let's Change  </h1>
