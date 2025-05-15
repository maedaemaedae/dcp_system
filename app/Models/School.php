<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $primaryKey = 'school_id'; // ✅ Important for custom PK
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

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_school_assignments', 'school_id', 'project_id');
    }

        public function deliveries()
    {
        return $this->hasMany(PackageDelivery::class, 'school_id', 'school_id'); // custom FK
    }

}
