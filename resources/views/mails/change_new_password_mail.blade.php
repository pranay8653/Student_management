<h1 style="font-family: 'Water Brush', cursive;"> Hi {{ $user->first_name }} {{ $user->last_name }}</h1>
<p s >The New Change Password Is given Below</p>

<h2  > Your email/ Login Id: '{{ $user->email }}' </h2>
<h2  >  Password is: '{{ $password }}' </h2>
<h2  > Updated at: '{{ $user->updated_at->format('d/m/Y H:i:s')}}' </h2>

<h1 style="font-family: 'Water Brush', cursive;"> So let's Change  </h1>
