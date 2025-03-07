<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class BuildingAdminTicketFollow extends Authenticatable
{
    use HasFactory;



    protected $table = 'building_admin_ticket_follow_up';

    protected $fillable = [
        'id',
        'ticket_id',
        'description',
        'image',
        'follow_up_by',
        'added_by',
        'edited_by',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;



   
}
