<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Death extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function death_attachments()
    {
        return $this->morphMany(DeathAttachment::class, 'documentable');
    }

    public function members()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }

    public function mortuary()
    {
        return $this->belongsTo(Mortuary::class);
    }

    public function schedules()
    {
        return $this->hasMany(VehicleSchedule::class);
    }

    public function transmittals()
    {
        return $this->hasOne(DeathTransmittal::class);
    }

    public function in_houses()
    {
        return $this->hasOne(DeathInHouse::class);
    }

    public function payments()
    {
        return $this->hasOne(DeathPayment::class);
    }
}
