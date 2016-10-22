<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = ['gallery_id', 'image', 'title', 'description', 'image_credit'];
}
