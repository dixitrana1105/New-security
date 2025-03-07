<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'countries';

    protected $fillable = [
        'code',
        'name',
        'status',
        'created_at',
        'deleted_at'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function Building_Master()
    {
        return $this->hasOne(Building_Master::class, 'country','name');
    }


    public function profile()
    {
        return $this->hasOne(User::class, 'country','name');
    }

}
