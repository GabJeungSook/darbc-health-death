<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\HealthDeath;
use App\Models\Member;
use App\Models\ReportHeader;
use Livewire\WithPagination;
use App\Models\CommunityRelation;

class CommunityRelationReport extends Component
{
    use WithPagination;
    public $report_get;
    public $date_from;
    public $date_to;

    public function redirectToCommunityRelation()
    {
        return redirect()->route('community-relations');
    }

    public function render()
    {
        return view('livewire.community-relation-report', [
            'communityRelations' =>
            $this->report_get != 6 ? [] : CommunityRelation::when($this->date_from && $this->date_to, function ($query) {
                $query->where(function ($query) {
                    $query->whereBetween('created_at', [$this->date_from, $this->date_to]);
                });
            })->paginate(100),
            'reports' => ReportHeader::where('report_id', 6)->get(),
            'first_report' => ReportHeader::where('report_id', 6)->where('report_name', 'Community Relations')->first(),
        ]);
    }

    public function exportReport($id)
    {
        switch ($this->report_get) {
            case 6:
                return \Excel::download(
                    new \App\Exports\CommunityRelationExport(),
                    'CommunityRelations.xlsx'
                );
                break;
            default:
                # code...
                break;
        }
    }
}
