<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeathTransmittal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'documentable');
    }

    public function death()
    {
        return $this->belongsTo(Death::class, 'death_id');
    }
}
