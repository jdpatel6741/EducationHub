<?php

namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Model;

class Views extends Model
{
	protected $table = "tbl_articals_views";
	public $timestamps = false;
	protected $fillable = [
    	'article_id','visits','ip'
    ];
}
