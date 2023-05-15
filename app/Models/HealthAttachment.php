<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthAttachment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function documentable()
    {
        return $this->morphTo();
    }
}
