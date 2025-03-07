<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class State extends Model
{
    use HasFactory;
    protected $table = 'states';

    protected $fillable = [
        'name',
        'country_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function Building_Master()
    {
        return $this->hasOne(Building_Master::class, 'state','name');
    }

    public function profile()
    {
        return $this->hasOne(User::class, 'state','name');
    }
    
}
