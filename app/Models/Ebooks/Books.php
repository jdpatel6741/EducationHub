<?php

namespace App\Models\Ebooks;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $table = 'tbl_ebooks_books';

    protected $fillable = [
    	'user_id', 'category_id', 'title', 'description', 'privacy', 'url', 'thumbnail', 'ebookhash', 'status', 'created_at', 'updated_at'
    ];

    public function user()
    {
    	return $this->hasOne('App\User','id','user_id');
    }

    public function favorite()
    {
    	return $this->hasMany('App\Models\Ebooks\Favorite','book_id','id');
    }

    public function viewscount()
    {
    	return $this->hasMany('App\Models\Ebooks\Viewscount','book_id','id');
    }
}
