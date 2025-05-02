<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $table = 'schools';
    protected $primaryKey = 'school_id';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'school_id',
        'division_id',
        'municipality_id',
        'school_name',
        'school_address',
        'school_head',
        'level',
        'created_by',
        'created_date',
        'modified_by',
        'modified_date',
    ];

    public function division()
    {
        return $this->belongsTo(DivisionOffice::class, 'division_id');
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'municipality_id');
    }
}
