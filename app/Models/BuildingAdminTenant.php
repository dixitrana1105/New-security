<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BuildingAdminTenant extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'building_tenant';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'date',
        'tenant_id',
        'building_id',
        'flat_office_no',
        'no_sub_user',
        'sub_tenant_id',
        'email',
        'country',
        'state',
        'city',
        'password',
        'secret_key',
        'contact_person',
        'contact_number',
        'whatsapp_no',
        'emergency_contact_no',
        'visiting_hour_from',
        'visiting_hour_to',
        'tenant_photo',
        'tenant_id_proof',
        'added_by',
        'edited_by',
        'created_at',
        'updated_at',        
    ];

    public function Building_Master()
    {
        return $this->belongsTo(Building_Master::class, 'building_id');
    }

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
