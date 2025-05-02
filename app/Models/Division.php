<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisionOffice extends Model
{
    use HasFactory;

    protected $primaryKey = 'division_id';

    protected $fillable = [
        'division_name',
        'regional_office_id',
        'person_in_charge',
        'email',
        'contact_no',
        'created_by',
        'created_date',
        'modified_by',
        'modified_date',
    ];
}
