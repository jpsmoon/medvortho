<?php

namespace App\Exports;

use App\Models\InjuryBill;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BillSendDownloadPDFExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return InjuryBill::all();
    }
    public function view(): View
    {
        return view('patients.injury.bills.exports.index', [
            'invoices' => InjuryBill::all()
        ]);
    }
}