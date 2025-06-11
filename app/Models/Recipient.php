<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipient extends Model
{
    use HasFactory;

    public $timestamps = true;
    
    protected $fillable = [
        'package_id',
        'recipient_type',
        'recipient_id',
        'quantity',
        'contact_person',
        'position',
        'contact_number',
        'created_by',
        'modified_by',
    ];

        public function package()
        {
            return $this->belongsTo(Package::class);
        }

        public function school()
        {
            return $this->belongsTo(School::class, 'recipient_id');
        }

        public function division() {
            return $this->belongsTo(DivisionOffice::class, 'recipient_id', 'division_id');
        }
        
        public function creator()
        {
            return $this->belongsTo(User::class, 'created_by');
        }

        public function modifier()
        {
            return $this->belongsTo(User::class, 'modified_by');
        }

        public function deliveries()
        {
            return $this->hasMany(\App\Models\Delivery::class);
        }
}

