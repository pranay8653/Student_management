<h1 style="font-family: 'Water Brush', cursive;"> Hello '{{ $user->first_name }} {{ $user->last_name }}'</h1>
<p  >Your New Password Is Given Below</p>

<h2  > Your email/ Login Id: '{{ $user->email }}' </h2>
<h2 > Temporary Password is: '{{ $password }}' </h2>

<h1 style="font-family: 'Water Brush', cursive;"> So let's Login  </h1>
