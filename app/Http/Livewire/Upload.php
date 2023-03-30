<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use League\Csv\Reader;
use App\Models\Member;
use App\Models\HealthDeath;
use Illuminate\Support\Facades\Storage;

class Upload extends Component
{
    use WithFileUploads;
    public $member;
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

    public function uploadDeath()
    {
        $csvContents = Storage::get($this->death->getClientOriginalName());
        $csvReader = Reader::createFromString($csvContents);
        $csvRecords = $csvReader->getRecords();

        foreach ($csvRecords as $csvRecord) {
            HealthDeath::create([
                'member_id' => $csvRecord[0],
                'batch' => $csvRecord[1],
                'date' => $csvRecord[2] ?? null,
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
                'transmittal_date' => $csvRecord[15] ?? null,
                'fortune_paid' => $csvRecord[16],
                'date_of_payment' => $csvRecord[17] ?? null,
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
}
