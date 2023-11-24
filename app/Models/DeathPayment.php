<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeathPayment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function payment_attachments()
    {
        return $this->morphMany(DeathPaymentAttachment::class, 'documentable');
    }

    public function deaths()
    {
        return $this->belongsTo(Death::class, 'death_id');
    }
}
