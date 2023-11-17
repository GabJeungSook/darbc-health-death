<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Health extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function health_attachments()
    {
        return $this->morphMany(HealthAttachment::class, 'documentable');
    }

    public function members()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }

    public function hospitals()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    public function transmittals()
    {
        return $this->hasOne(Transmittal::class);
    }

    public function in_houses()
    {
        return $this->hasOne(InHouse::class);
    }

    public function payments()
    {
        return $this->hasOne(Payment::class);
    }



}
