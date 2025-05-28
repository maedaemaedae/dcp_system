<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'project_id',
        'package_type_id',
        'batch',
        'lot',
        'description',
    ];

    public function packageType()
    {
        return $this->belongsTo(PackageType::class);
    }

    public function contents()
    {
        return $this->hasMany(PackageContent::class);
    }

        public function project()
    {
        return $this->belongsTo(\App\Models\Project::class);
    }

}



