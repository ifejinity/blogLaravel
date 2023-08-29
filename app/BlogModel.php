<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model
{
    protected $fillable = ['image', 'title', 'description', 'content'];
}
