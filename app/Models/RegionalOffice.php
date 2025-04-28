<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionalOffice extends Model
{
    use HasFactory;

    protected $table = 'regional_offices';
    protected $primaryKey = 'ro_id';

    public $timestamps = true;

    protected $fillable = [
        'ro_office',
        'person_in_charge',
        'email',
        'contact_no',
        'created_by',
        'created_date',
        'modified_by',
        'modified_date',
    ];
}
