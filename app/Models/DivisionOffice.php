<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisionOffice extends Model
{
    use HasFactory;

    protected $table = 'division_offices';
    protected $primaryKey = 'division_id';

    public $timestamps = true;

    protected $fillable = [
        'division_name',
        'person_in_charge',
        'email',
        'contact_no',
        'regional_office_id',
        'created_by',
        'created_date',
        'modified_by',
        'modified_date',
    ];

    public function regionalOffice()
    {
        return $this->belongsTo(RegionalOffice::class, 'regional_office_id');
    }
}
