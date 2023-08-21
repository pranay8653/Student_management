<h1 style="font-family: 'Water Brush', cursive;" >Hi <strong>'{{ $teacher_id->first_name }} {{ $teacher_id->last_name }}'</strong> </h1>
<p > Your Details Are Modified By Authority. After Modify Your Details are</p>
<h2> Your email / Login Id: '{{ $teacher_id->email }}' </h2>
<h2> Your Phone Number / Login Id: '{{ $teacher_id->phone }}' </h2>
<br>
<h2 > Your Address: '{{ $teacher_id->address }}' </h2>
<br>
<h2 > Your Date Of Birth: '{{ $teacher_id->dob }}' </h2>
<h2 > Your Gender: '{{ $teacher_id->gender }}' </h2>
<h2 > Your Department: '{{ $dept_name }}' </h2>
<h2> Updated at: '{{ $teacher_id->updated_at->format('d/m/Y ')}}' </h2>

<h1 style="font-family: 'Water Brush', cursive;"> So let's Login  </h1>
