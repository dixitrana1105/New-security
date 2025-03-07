<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'cities';

    protected $fillable = [
        'name',
        'state_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function Building_Master()
    {
        return $this->hasOne(Building_Master::class, 'city','name');
    }


    public function profile()
    {
        return $this->hasOne(User::class, 'city','name');
    }

}
