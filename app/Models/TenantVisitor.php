<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TenantVisitor extends Authenticatable
{
    use HasFactory;
    protected $table = 'tenant_visitor';

    protected $fillable = [
        'id',
        'visitor_id',
        'visiter_purpose',
        'date',
        'photo',
        'building_id',
        'status',
        'full_name',
        'out_time',
        'tenant_block',
        'status_of_visitor',
        'id_proof',
        'out_time_remark',
        'reschedule_date',
        'in_time',
        'visitor_remark',
        'tenant_flat_office_no',
        'added_by',
        // 'edited_by',
        'created_at',
        'updated_at',
    ];

    public function Building_Master()
    {
        return $this->belongsTo(Building_Master::class, 'building_id');
    }

}
