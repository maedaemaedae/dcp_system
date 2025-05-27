<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'recipient_type',
        'recipient_id',
        'notes',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'recipient_id');
    }

    public function division()
    {
        return $this->belongsTo(DivisionOffice::class, 'recipient_id');
    }
}

