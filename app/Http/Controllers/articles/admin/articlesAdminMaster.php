<?php

namespace App\Http\Controllers\articles\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Articles\Topics;
use App\Models\Articles\Subjects;
use App\Models\Articles\Favorite;
use Auth;

class articlesAdminMaster extends Controller
{
	public function add()
	{
		$subjects = Subjects::get();
		return view('articles.admin.addarticle',compact('subjects'));
	}

    public function addArticle(Request $req)
    {
        $sid = $req->input('sid');
        $tp = $req->input('topic');
        $content = $req->input('contents');
        if (!in_array('', [$sid,$tp,$content])) {
            $topic = new Topics;
            $topic->topic = $tp;
            $topic->sid = $sid;
            $topic->uid = Auth::id();
            $topic->content = $content;
            $topic->save();
            return redirect(route('articles_add'));
        }
        else {
            return "please field out this fields";
        }
    }

    public function manageArticle()
    {
        $articles = Topics::where('uid',Auth::id())->get();
        return view('articles.admin.managearticle',compact('articles'));
    }

    public function deletearticle($aid)
    {
        Topics::where(['id'=>decrypt($aid)])->delete();
        return redirect(route('articles_manage'));
    }

    public function editarticle($aid)
    {
        if ($this->getpermision($aid)) {
            $article = Topics::where(['id'=>decrypt($aid)])->first();
            $subjects = Subjects::get();
            return view('articles.admin.editarticle',compact('article','subjects'));
        }
        else {
            return abort(404);
        }
    }

    public function updatearticle(Request $req,$aid)
    {
        $sid = $req->input('sid');
        $topic = $req->input('topic');
        $content = $req->input('contents');
        if (!in_array('', [$sid,$topic,$content])) {
            if ($this->getpermision($aid)) {
                $article = Topics::find(decrypt($aid));
                $article->sid = $sid;
                $article->topic = $topic;
                $article->content = $content;
                $article->save();
                return "<div class='alert alert-success'>successfully update</a>";
            }
            else {
                return "you don't have permission";
            }
        }
        else {
    		return "<div class='alert alert-danger'>please field out this fields</div>";
    	}
    }

    public function getpermision($id)
    {
        return Auth::id()==Topics::find(decrypt($id))->first()->uid?true:false;
    }

    public function articles_favorite()
    {
        $favorite = Favorite::with('article')->where('user_id',Auth::id())->get();
        return view('articles.admin.favorite',compact('favorite'));
    }

    public function addfavorite($aid)
    {
        $aid = decrypt($aid);
        if (Favorite::where(['article_id'=>$aid,'user_id'=>Auth::user()->id])->count()==0) {
            $fav = new Favorite;
            $fav->user_id = Auth::user()->id;
            $fav->article_id = $aid;
            $fav->status = 1;
            $fav->save();
        }
        if (!isset($_GET['url'])) {
            return redirect(route('articles_manage'));
        }
        else {
            return redirect(decrypt($_GET['url']));
        }
    }

    public function removefavorite($aid)
    {
        Favorite::where(['article_id'=>decrypt($aid),'user_id'=>Auth::user()->id])->delete();
        if (!isset($_GET['url'])) {
            return redirect(route('articles_manage'));
        }
        else {
            return redirect(decrypt($_GET['url']));
        }
    }
}