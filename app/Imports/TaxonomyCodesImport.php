<?php

namespace App\Imports;

use App\Models\Taxonomy_code; 
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Readers\LaravelExcelReader;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;


class TaxonomyCodesImport implements ToModel, WithStartRow 
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

         return new Taxonomy_code([
            'code' =>$row['code'],
            'name' =>$row['name'],
         ]);
    }
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    // public function sheets() : array
    //     {
    //         return [
    //             new FirstSheetImport()
    //         ];
    //     }
}
