<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
        'project_id', 'school_id', 'package_id',
        'status', 'delivery_date', 'arrival_date', 'remarks', 'proof_path',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'school_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}

