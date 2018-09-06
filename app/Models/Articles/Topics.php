<?php

namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
    protected $table = "tbl_articals_topics";

    public function user()
    {
    	return $this->hasOne('App\User','id','user_id');
    }

    public function favorite()
    {
    	return $this->hasOne('App\Models\Articles\Favorite','article_id','id');
    }
}
