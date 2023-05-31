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
}
