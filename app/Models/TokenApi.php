<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class TokenApi extends Model
{
    use HasFactory;
    protected $table = 'login_api_tokens';

    protected $fillable = [
        'id',
        'token',
        'user_id',
        'current_session_tocken',
        'user_type',
        'created_at',
        'updated_at',
    ];


}
