<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function report_header()
    {
        return $this->HasMany(ReportHeader::class);
    }

    public function report_signatories()
    {
        return $this->HasMany(ReportSignatory::class);
    }
}
