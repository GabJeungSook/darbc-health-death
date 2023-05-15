<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mortuary extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function mortuary_attachments()
    {
        return $this->morphMany(MortuaryAttachment::class, 'documentable');
    }

    public function death()
    {
        return $this->hasOne(Death::class);
    }
}
