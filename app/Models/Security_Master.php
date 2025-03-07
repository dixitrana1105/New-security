<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Security_Master extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes ;

    protected $dates = ['deleted_at'];


    protected $table = 'security_master';

    protected $fillable = [
        'security_id',
        'contact',
        'whatsup',
        'email',
        'token',
        'current_address_1',
        'current_address_2',
        'landmark',
        'city',
        'permanent_address_1',
        'permanent_address_2',
        'country',
        'state',
        'permanent_city',
        'photo',
        'addressproof',
        'tenantPhoto',
        'name',
        'workingFromDate',
        'password',
        'building_id',
        'current_city',
        'secret_key',
        'added_by',
        'edited_by',
        'logo',
        'created_at',
        'updated_at',
        'status'
    ];

    public $timestamps = true;

    // Relationships
    public function Country()
    {
        return $this->belongsTo(Country::class, 'country');
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
