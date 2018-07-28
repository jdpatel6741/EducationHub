<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$url = URL::to('/');
    	$list = array(
	        [
	            'Video Tutorials',
	            'you can learn using video tutorial and you can also download',
	            '#003399',
	            route('mytube_index'),
	            'fa fa-play'
	        ],
	        [
	            'Ebooks',
	            'ebooks you can read or download book',
	            '#31c50c',  
	            route('ebooks_index'),
	            'fa fa-book'
	        ],
	        [
	            'Articles',
	            'article in something like w3school/tutorials point',
	            '#ff0066',
	            route('articles'),
	            'fa fa-edit'
	        ],
	        [
	            'Forum',
	            'forum in you can ask qustion or also you can give your answer of the question',
	            '#ff3300',
	            $url.'/forum',
	            'fa fa-wpforms'
	        ],
	        [
	            'Source Code',
	            'you can download source code like make any project if you understand this project you can also understand using source code and you can download it',
	            '#990099',
	            $url.'/sourcecode',
	            'fa fa-code'
	        ],
	        [
	            'Chat/Support',
	            'you can message to faculty and any query you can ask them',
	            '#ffaa00',
	            $url.'/chatsupport',
	            'fa fa-comments'
	        ],
	        [
	            'Question Bank',
	            'you can get the question of your pepper if you have question bank you have more or better experience of how to write question pepper',
	            '#1a1aff',
	            $url.'/questionbank',
	            'fa fa-question-circle'
	        ],
	        [
	            'Mcq Exam',
	            'mcq exam in you can give mcq exam and know how do i prepare',
	            '#ff00cf',
	            $url.'/mcq',
	            'fa fa-question'
	        ]);
        return view('home')->with('list',$list);
    }
}
