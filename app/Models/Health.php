<?php

namespace App\Models;

use App\Models\Member;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Health extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['darbc_id', 'member_name']; // Append custom attributes

    private function fetchMemberData()
    {
        // Cache API data for 10 minutes to reduce API calls
        $apiData = Cache::remember('darbc_members', 600, function () {
            $url = 'https://darbcmembership.org/api/member-darbc-names';
            $response = Http::withOptions(['verify' => false])->get($url);

            return $response->successful() ? collect($response->json()) : collect();
        });

        return $apiData->where('id', $this->member_id)->first(); // Filter API data by member_id
    }

    // Define an accessor for darbc_id
    public function getDarbcIdAttribute()
    {
        $apiMember = $this->fetchMemberData();
        return $apiMember['darbc_id'] ?? null; // Return darbc_id from API if available
        dd($apiMember);
    }

    // Define an accessor for member_name
    public function getMemberNameAttribute()
    {
        $apiMember = $this->fetchMemberData();
        return $apiMember['member_name'] ?? 'Unknown'; // Return member_name from API if available
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
