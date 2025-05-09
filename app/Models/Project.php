<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
   
    protected $fillable = ['name', 'target_delivery_date', 'target_arrival_date', 'status'];

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function schools()
    {
        return $this->belongsToMany(School::class, 'project_school_assignments', 'project_id', 'school_id')
                    ->withPivot('delivery_status');
    }
        
}
