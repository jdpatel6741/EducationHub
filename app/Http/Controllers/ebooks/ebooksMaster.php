<?php

namespace App\Http\Controllers\ebooks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ebooks\Books;
use App\Models\Ebooks\Category;
use App\Models\Ebooks\Favorite;
use App\Models\Ebooks\Subscribe;
use App\Models\Ebooks\Viewscount;
use App\User;
use View;
use File;
use Response;

class ebooksMaster extends Controller
{
    public function index($category_id = null)
    {
    	$category = Category::get();
    	$favorite = Favorite::get();
    	$subscribe = Subscribe::get();
    	if(isset($category_id)) {
    		$books = Books::with('user')->where(['category_id'=>$category_id,'privacy'=>'public','status'=>1])->paginate(15);
    	}
    	else if (isset($_GET['search'])) {
    		$books = Books::with('user')->where('title','like','%'.$_GET['search'].'%')->where(['privacy'=>'public','status'=>1])->paginate(15);
    	}
    	else {
    		$books = Books::with('user','favorite','viewscount')->where(['privacy'=>'public','status'=>1])->paginate(15);
    	}
		return view('ebooks.index',compact('books','category','favorite','subscribe'));
    }

    public function author($id)
    {
    	$books = Books::with('user')->where('user_id',decrypt($id))->get();
    	$author = User::with('ebooks_author')->where('id',decrypt($id))->first();
    	return view('ebooks.author',compact('author','books'));
    }

    public function thumbnail($filename)
	{
		$path = storage_path("app/ebooks/coverpage/".decrypt($filename));
		$file = File::get($path);
		$type = File::mimeType($path);
		$response = Response::make($file, 200);
		$response->header("Content-Type", $type);
		$response->header("cache","false");
		return $response;
	}

	public function showPDF($bid)
	{
		$id = decrypt($bid);
		$book = Books::find($id);
		$path = storage_path("app/ebooks/books/".$book->url);
		$file = File::get($path);
		$type = File::mimeType($path);
		if($type=="application/pdf")
		{
			if($_SERVER['REMOTE_ADDR']!="::1")
				$IP = $_SERVER['REMOTE_ADDR'];
			else
				$IP = getHostByName(getHostName());
			
			if(0==Viewscount::where(['ip'=>$IP,'book_id'=>$id])->count())
			{
				$view = new Viewscount;
				$view->book_id = $id;
				$view->visits = 1;
				$view->ip = $IP;
				$view->save();
			}
			else {
				Viewscount::where(['book_id'=>$id,'ip'=>$IP])->increment('visits',1);
			}

			$response = Response::make($file, 200);
			$response->header("Content-Type", $type);
			return $response;
		}
		else {
			return false;
		}
	}
}
