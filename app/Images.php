<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'images';
    protected $fillable = [
        'user_id', 'name', 'mime', 'path', 'size'
    ];

}