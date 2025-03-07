<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekognition extends Model
{
    protected $table = 'rekognitions';

    public function users()
    {
        return $this->hasOne(Visitor::class, 'id', 'userId');
    }
}
