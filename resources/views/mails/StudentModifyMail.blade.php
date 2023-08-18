<h1 style="color: #ff0066"> Hi <strong>'{{ $student_id->first_name }} {{ $student_id->last_name }}'</strong> </h1>
<p style="color: #1417ceda"> Your Details Are Modified By Authority. After Modify Your Details are</p>
<h2 style="color: #3cca1f"> Guardian Name: '{{ $student_id->guardian_name }}' </h2>
<h2 style="color: #3cca1f"> Guardian Mobile Number: '{{ $student_id->guardian_number }}' </h2>
<h2 style="color: #3cca1f"> Your email/ Login Id: '{{ $student_id->email }}' </h2>
<h2 style="color: #3cca1f"> Your Phone Number/ Login Id: '{{ $student_id->phone }}' </h2>
<h2 style="color: #e934e3da"> Your Address: '{{ $student_id->address }}' </h2>
<h2 style="color: #e934e3da"> Your Date Of Birth: '{{ $student_id->dob }}' </h2>
<h2 style="color: #e934e3da"> Your Gender: '{{ $student_id->gender }}' </h2>
<h2 style="color: #e934e3da"> Your Department: '{{ $dept_name }}' </h2>
<h2 style="color: #e934e3da"> Your 10th Marks: '{{ $student_id->marks_10th }}' </h2>
<h2 style="color: #e934e3da"> Your 10th Percentage: '{{ $student_id->percentage_10th }}' </h2>
<h2 style="color: #e934e3da"> Your 12th Marks: '{{ $student_id->hs_marks }}' </h2>
<h2 style="color: #e934e3da"> Your 12th Percentage: '{{ $student_id->hs_percentage }}' </h2>
<h2 style="color: #1500ff"> Updated at: '{{ $student_id->updated_at->format('d/m/Y ')}}' </h2>

<h1 style="color:#00cc00; font-family: 'Water Brush', cursive;"> So let's Login  </h1>
