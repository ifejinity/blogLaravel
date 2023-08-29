<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class commentModel extends Model
{
    protected $fillable = ['blogId', 'text', 'image'];
}
