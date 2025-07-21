<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisionOffice extends Model
{
    use HasFactory;

    protected $table = 'division_offices';
    protected $primaryKey = 'division_id';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'division_id',
        'division_name',
        'regional_office_id',
        'office',
        'sdo_address',
        'person_in_charge',
        'email',
        'contact_no',
        'created_by',
        'created_date',
        'modified_by',
        'modified_date',
    ];


    public function regionalOffice()
    {
        return $this->belongsTo(RegionalOffice::class, 'regional_office_id');
    }

    public function schools()
    {
        return $this->hasMany(School::class, 'division_id');
    }

    public function inventories()
    {
        return $this->hasMany(\App\Models\Inventory::class, 'division_id', 'division_id');
    }

    public function getHasUpdatesAttribute()
    {
        return $this->inventories->first()?->created_at?->gt(now()->subDay());
    }

}
