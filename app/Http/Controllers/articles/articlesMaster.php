<?php

namespace App\Http\Controllers\articles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Articles\Topics;
use App\Models\Articles\Subjects;
use App\Models\Articles\Views;
use View;

class articlesMaster extends Controller
{
    public function index($subject_id=null,$article_id=null) {
        $subjects = Subjects::get();
        if (isset($article_id) and decrypt($article_id)==1 and $subject_id!=null) {
            $article = Topics::with('favorite')->where(['sid'=>decrypt($subject_id)])->first();
            $topics = Topics::where('sid',decrypt($subject_id))->get();
        }
        else if ($article_id!=null and $subject_id!=null) {
            $article = Topics::with('favorite')->where(['id'=>decrypt($article_id),'sid'=>decrypt($subject_id)])->first();
            $topics = Topics::where('sid',decrypt($subject_id))->get();
        }
        else {
            $article = Topics::with('favorite')->first();
            $topics = Topics::get();
        }

        if($_SERVER['REMOTE_ADDR']!="::1")
            $IP = $_SERVER['REMOTE_ADDR'];
        else
            $IP = getHostByName(getHostName());
        
        if(0==Views::where(['ip'=>$IP,'article_id'=>$article->id])->count())
        {
            $view = new Views;
            $view->article_id = $article->id;
            $view->visits = 1;
            $view->ip = $IP;
            $view->save();
        }
        else {
            Views::where(['article_id'=>$article->id,'ip'=>$IP])->increment('visits',1);
        }

        return view('articles.index',compact('subjects','topics','article','subject_id'));
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