<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillTempDocForSendPacket extends Model
{
    use HasFactory;
    protected $table = 'bill_send_pdf_temp_files_detail';
}
