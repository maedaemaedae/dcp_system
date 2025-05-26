<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DcpRecipientDivisionOffice extends Model
{
    use HasFactory;

    protected $table = 'dcp_recipient_division_offices';

    protected $fillable = [
        'region_id',
        'division_id',
        'quantity',
        'office',
        'sdo_address',
        'contact_person',
        'position',
        'contact_number',
    ];

        public function region()
    {
        return $this->belongsTo(RegionalOffice::class, 'region_id');
    }

    public function division()
    {
        return $this->belongsTo(DivisionOffice::class, 'division_id', 'division_id');
    }
}
