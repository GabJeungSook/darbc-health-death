<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportHeader extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function reports()
    {
        return $this->belongsTo(Report::class, 'report_id');
    }
}
