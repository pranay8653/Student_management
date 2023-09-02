<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','studynotes_id','querry_id','reply','user_role'];

    public function querry()
    {
        return $this->belongsTo(Querry::class);
    }

}
