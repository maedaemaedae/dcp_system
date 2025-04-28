<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    protected $primaryKey = 'municipality_id';

    protected $fillable = [
        'municipality_name',
    ];

    public function schools()
    {
        return $this->hasMany(School::class, 'municipality_id');
    }
}
