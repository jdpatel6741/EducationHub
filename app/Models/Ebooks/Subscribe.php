<?php

namespace App\Models\Ebooks;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $table = 'tbl_ebooks_subscribe';

    public $timestamps = false;

    public function user()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }
}
