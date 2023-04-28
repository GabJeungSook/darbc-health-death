<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Health extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function members()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }

    public function hospitals()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }



}
