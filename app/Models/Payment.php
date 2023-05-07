<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function payment_attachments()
    {
        return $this->morphMany(PaymentAttachment::class, 'documentable');
    }

    public function healths()
    {
        return $this->belongsTo(Health::class, 'health_id');
    }
}
