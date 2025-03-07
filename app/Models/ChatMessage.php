<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $table = 'chat_messages';

    protected $fillable = [
        'id',
        'building_id',
        'message',
        'chat_id',
        'created_at',
        'updated_at',
    ];

}
