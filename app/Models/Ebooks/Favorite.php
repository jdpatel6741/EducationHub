<?php

namespace App\Models\Ebooks;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'tbl_ebooks_favorite';

    public function books()
    {
    	return $this->belongsTo('App\Models\Ebooks\Books','book_id','id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }

    public function viewscount()
    {
    	return $this->hasMany('App\Models\Ebooks\Viewscount','book_id','book_id');
    }
}