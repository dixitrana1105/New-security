<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class BuildingAdminTicket extends Authenticatable
{
    use HasFactory;



    protected $table = 'building_admin_ticket';

    protected $fillable = [
        'id',
        'building_id',
        'ticket_id',
        'date_time',
        'subject',
        'role',
        'replay',
        'attachment',
        'description',
        'added_by',
        'edited_by',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;


    public function building()
    {
        return $this->belongsTo(Building_Master::class, 'building_id', 'building_id');
    }
    public function followUps()
{
    return $this->hasMany(BuildingAdminTicketFollow::class, 'ticket_id', 'ticket_id');
}

   
}
