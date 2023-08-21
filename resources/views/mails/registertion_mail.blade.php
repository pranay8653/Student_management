<h1 style="font-family: 'Water Brush', cursive;"> Welcome <strong>'{{ $user->first_name }} {{ $user->last_name }}'</strong> Your Details are given below</h1>
<p  > You Are Successfully Registered. Login By This Email-id Or This Mobile Number</p>
<h2  > Your email/ Login Id: '{{ $user->email }}' </h2>
<h2  > Your login Password: '{{ $password }}' </h2>
<h2  > Your PhoneNumber: '{{ $user->phone }}' </h2>
<h2  > Your Are a: '{{ $user->role }}' </h2>
<h2  > Your Department: '{{ $dept_name }}' </h2>

<h1 style= "font-family: 'Water Brush', cursive;"> So let's Login  </h1>
