<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['d_name'];

    public function teachers()
     {
        return $this->hasMany(Teacher::class);
     }
}
