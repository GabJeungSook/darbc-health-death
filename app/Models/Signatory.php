<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signatory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function report_headers()
    {
        return $this->belongsTo(ReportHeader::class, 'report_header_id');
    }
}
