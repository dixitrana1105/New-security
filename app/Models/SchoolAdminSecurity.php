<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SchoolAdminSecurity extends Authenticatable
{
    use HasFactory;
    protected $table = 'school_security';

    protected $fillable = [
        'id',
        'name',
        'email',
        'contant_number',
        'whatsapp',
        'c_address_1',
        'c_address_2',
        'c_landmark',
        'current_city',
        'p_address_1',
        'p_address_2',
        'country',
        'state',
        'city',
        'photo_id',
        'address_proof',
        'photo',
        'working_date',
        'secret_key',
        'password',
        'status',
        'added_by',
        'edited_by',
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