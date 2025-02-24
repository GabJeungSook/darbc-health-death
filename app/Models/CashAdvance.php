<?php

namespace App\Models;


use App\Models\Member;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashAdvance extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'contact_numbers' => 'array',
    ];
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
    }

    // Define an accessor for member_name
    public function getMemberNameAttribute()
    {
        $apiMember = $this->fetchMemberData();
        return $apiMember['full_name'] ?? 'Unknown'; // Return member_name from API if available
    }
}
