<?php

namespace App\Models\articles;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
	protected $table = "tbl_articals_favorite";
	public $timestamps = false;

	public function article()
    {
    	return $this->belongsTo('App\Models\Articles\Topics','article_id','id');
    }
}