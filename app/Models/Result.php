<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable = ['student_id','dept_id', 'sub_1','sub_2','sub_3','sub_4','sub_5','sub_6','sub_7','total','percentage','grade'];

    public function department_name()
    {
       return $this->belongsTo(Department::class,'dept_id');
    }

    public function student()
    {
       return $this->belongsTo(student::class );
    }

}
