<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
   protected $table = 'images';

   protected $fillable = ['gallery_id', 'upload_path', 'image', 'title', 'description', 'image_credit'];

   public function Gallery()
   {
      return $this->belongsTo(Gallery::class);
   }
}
