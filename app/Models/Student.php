<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['first_name','last_name','email','phone','address','image','dob','gender','department_id','guardian_name','guardian_number','10th_marks','10th_percentage','hs_marks','hs_percentage'];

    public function department()
    {
       return $this->belongsTo(Department::class);
    }
}
