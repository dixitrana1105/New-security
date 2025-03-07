<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class BlockVisitor extends Authenticatable
{
    use HasFactory;



    protected $table = 'block_visitor';

    protected $fillable = [
        'id',
        'building_id',
        'visitor_id',
        'tenant_id',
        'table_id',
        'block_from',
        'added_by',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

 
}
