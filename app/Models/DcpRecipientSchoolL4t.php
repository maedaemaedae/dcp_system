<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DcpRecipientSchoolL4t extends Model
{
    use HasFactory;

    protected $table = 'dcp_recipient_schools_l4t';

    protected $fillable = [
        'region',
        'division',
        'school_id',
        'school_name',
        'school_address',
        'quantity',
        'contact_person',
        'position',
        'contact_number',
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'school_id');
    }
}
