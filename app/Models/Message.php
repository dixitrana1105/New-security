<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'sender_type',
        'receiver_type',
        'message',
    ];

    const SENDER_TYPES = [
        'tenant' => 1,
        'security' => 2,
    ];

    const RECEIVER_TYPES = [
        'tenant' => 1,
        'security' => 2,
    ];
    /**
     * Relationship: Get the sender of the message.
     */
    public function sender()
    {
        return $this->morphTo();
    }

    /**
     * Relationship: Get the receiver of the message.
     */
    public function receiver()
    {
        return $this->morphTo();
    }
}