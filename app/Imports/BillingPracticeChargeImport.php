<?php

namespace App\Imports;

use App\Models\master_billing_provider_charge;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Readers\LaravelExcelReader;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;

class BillingPracticeChargeImport implements ToModel, WithStartRow 
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!array_filter($row)) {
            return null;
         } 

        return new BillingProviderChargeProcedureCode($row);
    }
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
