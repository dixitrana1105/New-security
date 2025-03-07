<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;


class Building_Master extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;

    protected $table = 'building_master';

    protected $fillable = [
        'id',
        'date',
        'type',
        'building_id',
        'school_id',
        'name',
        'type_of_building',
        'email',
        'contact_person',
        'contact_number',
        'no_of_tenant',
        'password',
        'secret_key',
        'business_name',
        'no_security_person',
        'address_1',
        'address_2',
        'country',
        'state',
        'city',
        'added_by',
        'edited_by',
        'status',
        'created_at',
        'updated_at'
    ];

    public function Country()
    {
        return $this->belongsTo(Country::class,'country');
    }

    public function State()
    {
        return $this->belongsTo(State::class, 'state');
    }

    public function City()
    {
        return $this->belongsTo(City::class, 'city');
    }

}
