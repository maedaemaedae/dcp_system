<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electricity extends Model
{
    use HasFactory;

    // Custom table name (if not pluralized)
    protected $table = 'electricity';

    // Custom primary key
    protected $primaryKey = 'electricity_id';

    // Allow mass assignment for these columns
    protected $fillable = [
        'school_id',
        'electricity_source',
    ];

    // Relationship to School
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'school_id');
    }
}
