<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';

    protected $fillable = ['name', 'slug', 'description', 'cover_image'];

    public function Images()
    {
        return $this->hasMany(Image::class);
    }
}
