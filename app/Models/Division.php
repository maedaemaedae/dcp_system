<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $primaryKey = 'division_id';

    protected $fillable = [
        'division_name',
    ];

    public function schools()
    {
        return $this->hasMany(School::class, 'division_id');
    }
}
