<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['package_type_id', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function packageType()
    {
        return $this->belongsTo(PackageType::class);
    }
}


