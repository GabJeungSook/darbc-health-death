<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mortuary extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'contact_numbers' => 'array',
    ];
}
