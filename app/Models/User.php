<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'superadmins';

    public $timestamps = false;

    protected $fillable = ['email', 'password', 'secret_key', 'added_by', 'state'];

    protected $hidden = ['password', 'secret_key', 'remember_token'];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

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
