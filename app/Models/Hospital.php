<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function healths()
    {
        return $this->hasMany(Health::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

}
