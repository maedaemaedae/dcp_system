<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DcpRecipientSchoolStv extends Model
{
    use HasFactory;

    protected $table = 'dcp_recipient_schools_stv';

    protected $fillable = [
        'region_id',
        'division_id',
        'school_id',
        'school_name',
        'school_address',
        'quantity',
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
        return $this->belongsTo(DivisionOffice::class, 'division_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
}

