<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityRelation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function community_purpose()
    {
        return $this->belongsTo(Purpose::class, 'purpose_id', 'id');
    }

    public function community_type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
}
