<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use League\Csv\Reader;
use App\Models\Member;
use App\Models\HealthDeath;
use App\Models\Death;
use Illuminate\Support\Facades\Storage;

class Upload extends Component
{
    use WithFileUploads;
    public $member;
    public $health;
    public $death;
    public function render()
    {
        return view('livewire.upload');
    }

    public function uploadMember()
    {
        $csvContents = Storage::get($this->member->getClientOriginalName());
        $csvReader = Reader::createFromString($csvContents);
        $csvRecords = $csvReader->getRecords();

        foreach ($csvRecords as $csvRecord) {
            Member::create([
                'member_id' => $csvRecord[0],
                'name' => $csvRecord[1],
            ]);
        }
    }

    public function uploadHealth()
    {
        $csvContents = Storage::get($this->health->getClientOriginalName());
        $csvReader = Reader::createFromString($csvContents);
        $csvRecords = $csvReader->getRecords();

        foreach ($csvRecords as $csvRecord) {
            HealthDeath::create([
                'member_id' => $csvRecord[0],
                'batch' => $csvRecord[1],
                'date' => \Carbon\Carbon::parse($csvRecord[2])->format('Y-m-d'),
                'patients_name' => $csvRecord[3],
                'contact_number' => $csvRecord[4],
                'age' => $csvRecord[5],
                'enrollment_status' => $csvRecord[6],
                'dhib' => $csvRecord[7],
                'date_of_confinement_from' => $csvRecord[8] ?? null,
                'date_of_confinement_to' => $csvRecord[9] ?? null,
                'hospital_name' => $csvRecord[10],
                'number_of_days' => $csvRecord[11],
                'amount' => $csvRecord[12],
                'transmittal_status' => $csvRecord[13],
                'batches' => $csvRecord[14],
                'transmittal_date' => \Carbon\Carbon::parse(
                    $csvRecord[15]
                )->format('Y-m-d'),
                'fortune_paid' => $csvRecord[16],
                'date_of_payment' => \Carbon\Carbon::parse(
                    $csvRecord[17]
                )->format('Y-m-d'),
                'status' => $csvRecord[18],
                'difference' => $csvRecord[19],
                '_batches' => $csvRecord[20],
                'with_hollographic-will' => $csvRecord[21],
                'vehicle_cash' => $csvRecord[22],
                'vehicle' => $csvRecord[23],
                'cannery' => $csvRecord[24],
                'polomolok' => $csvRecord[25],
            ]);
        }
    }

    public function uploadDeath()
    {
        $csvContents = Storage::get($this->death->getClientOriginalName());
        $csvReader = Reader::createFromString($csvContents);
        $csvRecords = $csvReader->getRecords();

        foreach ($csvRecords as $csvRecord) {
            Death::create([
                'member_id' => $csvRecord[0],
                'batch' => $csvRecord[1],
                'date' => \Carbon\Carbon::parse($csvRecord[2])->format('Y-m-d'),
                'dependents_name' => $csvRecord[3],
                'contact_number' => $csvRecord[4],
                'age' => $csvRecord[5],
                'enrollment_status' => $csvRecord[6],
                'status' => $csvRecord[7],
                'date_of_death' =>\Carbon\Carbon::parse($csvRecord[8])->format('Y-m-d'),
                'place_of_death' => $csvRecord[9],
                'replacement' => $csvRecord[10],
                'date_of_birth_m' =>\Carbon\Carbon::parse($csvRecord[11])->format('Y-m-d'),
                'date_of_birth_r' =>\Carbon\Carbon::parse($csvRecord[12])->format('Y-m-d'),
                'amount' => $csvRecord[13],
                'transmittal_status' => $csvRecord[14],
                'batches' => $csvRecord[15],
                'fortune_paid' => $csvRecord[16],
                'date_of_payment' => \Carbon\Carbon::parse(
                    $csvRecord[17]
                )->format('Y-m-d'),
                'remarks' => $csvRecord[18],
                'difference' => $csvRecord[19],
                '_batches' => $csvRecord[20],
                'with_hollographic_will' => $csvRecord[21],
                'vehicle_cash' => $csvRecord[22],
                'vehicle' => $csvRecord[23],
            ]);
        }
    }
}
