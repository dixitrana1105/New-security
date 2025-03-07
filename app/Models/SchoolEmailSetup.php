<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolEmailSetup extends Model
{
    use HasFactory;

    protected $table = 'school_email_setup';

    protected $fillable = [
        'mail_driver',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password',
        'mail_ency',
        'mail_address',
        'mail_name',
        'mail_test_email',
        'added_by',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
