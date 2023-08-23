<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studynote extends Model
{
    use HasFactory;
    protected $fillable = ['studynote_title','studynote','teachers_id','t_first_name','t_last_name','department_id'];

    public function department()
    {
       return $this->belongsTo(Department::class);
    }
}
