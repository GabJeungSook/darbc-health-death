<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Health extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['darbc_id', 'member_name']; // Append custom attributes

    public function getDarbcIdAttribute()
    {
        $url = 'https://darbcmembership.org/api/member-information/'.$this->member_id;
        $response = Http::withOptions(['verify' => false])->get($url);
        $member_data = $response->json();
        return $member_data['darbc_id'] ?? 'N/A'; // Default 'N/A'
    }

    public function getMemberNameAttribute()
    {
        $url = 'https://darbcmembership.org/api/member-information/'.$this->member_id;
        $response = Http::withOptions(['verify' => false])->get($url);
        $member_data = $response->json();
        if (isset($member_data['user'])) {
            $surname = strtoupper($member_data['user']['surname'] ?? '');
            $first_name = strtoupper($member_data['user']['first_name'] ?? '');
            $middle_name = strtoupper($member_data['user']['middle_name'] ?? '');
            return $surname . ', ' . $first_name . ' ' . $middle_name;
        }
        return 'N/A'; // Default 'N/A' if user data is not available
    }

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
