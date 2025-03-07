<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationMaster extends Model
{
    use HasFactory;

    protected $table = 'notification_master';

    protected $fillable = [
        'message_template',
    ];

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'notification_master_id');
    }
}
