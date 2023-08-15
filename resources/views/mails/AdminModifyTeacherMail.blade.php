<h1 style="color: #ff0066"> Hi <strong>'{{ $teacher_id->first_name }} {{ $teacher_id->last_name }}'</strong> </h1>
<p style="color: #1417ceda"> Your Details Are Modified By Authority. After Modify Your Details are</p>
<h2 style="color: #3cca1f"> Your email/ Login Id: '{{ $teacher_id->email }}' </h2>
<h2 style="color: #3cca1f"> Your Phone Number: '{{ $teacher_id->phone }}' </h2>
<br>
<h2 style="color: #e934e3da"> Your Address: '{{ $teacher_id->address }}' </h2>
<br>
<h2 style="color: #e934e3da"> Your Date Of Birth: '{{ $teacher_id->dob }}' </h2>
<h2 style="color: #e934e3da"> Your Gender: '{{ $teacher_id->gender }}' </h2>
<h2 style="color: #e934e3da"> Your Department: '{{ $dept_name }}' </h2>
<h2 style="color: #1500ff"> Updated at: '{{ $teacher_id->updated_at->format('d/m/Y ')}}' </h2>

<h1 style="color:#00cc00; font-family: 'Water Brush', cursive;"> So let's Login  </h1>
