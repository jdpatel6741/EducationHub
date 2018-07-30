<?php

namespace App\Http\Controllers\articles\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Articals\Topics;
use App\Models\Articals\Subjects;

class articlesAdminMaster extends Controller
{
	public function add()
	{
		$subjects = Subjects::get();
		return view('articles.admin.addarticle',compact('subjects'));
	}

    public function addArticle(Request $r)
    {
        $topic = new Topics;
        $topic->topic = $r->topic;
        $topic->sid = $r->sid;
        $topic->content = $r->contents;
        $topic->save();
        return redirect(route('articles_add'));
    }
}
