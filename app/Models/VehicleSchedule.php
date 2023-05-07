<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleSchedule extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function deaths()
    {
        return $this->belongsTo(Death::class, 'death_id');
    }
}
