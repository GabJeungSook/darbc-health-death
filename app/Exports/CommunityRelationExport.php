<?php

namespace App\Exports;

use App\Models\CommunityRelation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CommunityRelationExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.community-relations', [
            'communityRelations' => CommunityRelation::get(),
        ]);
    }
}
