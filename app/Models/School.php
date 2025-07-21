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
        'school_name',
        'school_address',
        'has_internet',
        'internet_provider',   // ✅ must be included
        'electricity_provider',
        'school_head',
        'created_by',
        'created_date',
        'modified_by',
        'modified_date',
    ];

    public function division()
    {
        return $this->belongsTo(\App\Models\DivisionOffice::class, 'division_id', 'division_id');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_school_assignments', 'school_id', 'project_id');
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class, 'school_id', 'school_id');
    }
    
        public function internet()
    {
        return $this->hasOne(Internet::class, 'school_id', 'school_id');
    }

    public function electricity()
    {
        return $this->hasOne(Electricity::class, 'school_id', 'school_id');
    }

    public function inventories()
    {
        return $this->hasMany(\App\Models\Inventory::class, 'school_id', 'school_id');
    }

    public function getHasUpdatesAttribute()
    {
        return $this->inventories->first()?->created_at?->gt(now()->subDay()); // last 24 hours
    }

}
