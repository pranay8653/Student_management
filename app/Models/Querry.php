<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Querry extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','studynotes_id','querry','user_role'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
