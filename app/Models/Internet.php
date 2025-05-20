<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internet extends Model
{
    use HasFactory;

    // Define custom table name (if not default plural form)
    protected $table = 'internet';

    // Define the primary key
    protected $primaryKey = 'internet_id';

    // Allow mass assignment for these columns
    protected $fillable = [
        'school_id',
        'connected_to_internet',
        'isp',
        'type_of_isp',
        'fund_source',
    ];

    // Define relationship to School
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'school_id');
    }
}
