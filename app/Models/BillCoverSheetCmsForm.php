<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillCoverSheetCmsForm extends Model
{
    use HasFactory;
    protected $table = 'bill_cover_sheet_cms_form';
    protected $fillable = ['bill_id','temp_document_name','doc_type' ];
}
