<?php

namespace App\Http\Controllers\articles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Articals\Topics;
use App\Models\Articals\Subjects;
use View;

class articlesMaster extends Controller
{
    public function index($subject_id=null,$article_id=null) {
        $subjects = Subjects::get();
        if ($article_id!=null and $subject_id!=null) {
            $article = Topics::where(['id'=>decrypt($article_id),'sid'=>decrypt($subject_id)])->first();
        }
    else {
        $article = Topics::where('id',1)->first();
    }
        $topics = Topics::get();
        return view('articles.index',compact('subjects','topics','article'));
    }

    public function viewFirstArticle(Request $r)
    {
        $subjects = Subject::All();
        $topics = Topic::where('sid',$r->sid)->get();
        $article = Topic::where('sid',$r->sid)->get();
        return view('index',compact('subjects','topics','article'));
    }

    public function viewSpecificArticle(Request $r)
    {
        $subjects = Subject::All();
        $sid = DB::table('topics')->select('sid')->where('id', $r->tid)->get();
        $topics = Topic::where('sid',$sid[0]->sid)->get();
        $article = Topic::where('id',$r->tid)->get();
        return view('index',compact('subjects','topics','article'));
    }
}