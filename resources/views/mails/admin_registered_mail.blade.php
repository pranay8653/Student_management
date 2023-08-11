<h1 style="color: #ff0066"> Welcome <strong>'{{ $user->first_name }} {{ $user->last_name }}'</strong> Your Details are given below</h1>

<h2 style="color: #3cca1f"> Your email/ Login Id: '{{ $user->email }}' </h2>
<h2 style="color: #3cca1f"> Your login Password: '{{ $password }}' </h2>
<h2 style="color: #e934e3da"> Your PhoneNumber: '{{ $user->phone }}' </h2>
<h2 style="color: #e934e3da"> Your Role: '{{ $user->role }}' </h2>

<h1 style="color:#00cc00; font-family: 'Water Brush', cursive;"> So let's Login  </h1>
