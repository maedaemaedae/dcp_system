<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $primaryKey = 'school_id'; // Keep this
    public $incrementing = false; // Important since school_id is not auto-incremented
    protected $keyType = 'string'; // Assuming alphanumeric IDs
    
    protected $fillable = [
        'school_id',
        'school_name',
        'school_address',
        'school_head',
        'level',
        'division_id',
        'municipality_id',
        'created_by',
        'created_date',
        'modified_by',
        'modified_date',
    ];
    
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'municipality_id');
    }
}
