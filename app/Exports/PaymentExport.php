<?php

namespace App\Exports;

use App\Models\Payment;
use App\Models\Health;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.payment', [
            'payments' => Health::whereHas('payments')->where('status', 'PAID')->get(),
        ]);
    }
}
