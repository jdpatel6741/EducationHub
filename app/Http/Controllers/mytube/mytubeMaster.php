<?php

namespace App\Http\Controllers\mytube;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use DB;
use File;
use Response;

class mytubeMaster extends Controller
{
	public function get($cid = null)
	{
		$category = DB::table('tbl_mytube_category')->where(['status'=>1])->get();
		if (!is_null($cid)) {
			$videos = DB::table('tbl_mytube_videos')->join('tbl_education_hub_users', 'tbl_education_hub_users.id', '=', 'tbl_mytube_videos.user_id')->join('tbl_mytube_channel','tbl_mytube_channel.id','=','tbl_mytube_videos.channel_id')->select("*","tbl_mytube_videos.id as vid")->where(['tbl_mytube_videos.privacy'=>'public','tbl_mytube_videos.category_id'=>$cid,'tbl_mytube_channel.status'=>1,'tbl_mytube_videos.status'=>1])->orderBy('tbl_mytube_videos.id','desc')->paginate(10);
		}
		else if (isset($_GET['search'])) {
			$videos = DB::table('tbl_mytube_videos')->join('tbl_education_hub_users', 'tbl_education_hub_users.id', '=', 'tbl_mytube_videos.user_id')->join('tbl_mytube_channel','tbl_mytube_channel.id','=','tbl_mytube_videos.channel_id')->select("*","tbl_mytube_videos.id as vid")->where('tbl_mytube_videos.title','like','%'.$_GET['search'].'%')->where(['tbl_mytube_videos.privacy'=>'public','tbl_mytube_channel.status'=>1,'tbl_mytube_channel.status'=>1,'tbl_mytube_videos.status'=>1])->orderBy('tbl_mytube_videos.id','desc')->paginate(10);
			$videos->appends('search',$_GET['search'])->render();
		}
		else {
			$videos = DB::table('tbl_mytube_videos')->join('tbl_education_hub_users', 'tbl_education_hub_users.id', '=', 'tbl_mytube_videos.user_id')->join('tbl_mytube_channel','tbl_mytube_channel.id','=','tbl_mytube_videos.channel_id')->select("*","tbl_mytube_videos.id as vid")->where(['tbl_mytube_videos.privacy'=>'public','tbl_mytube_channel.status'=>1,'tbl_mytube_videos.status'=>1])->orderBy('tbl_mytube_videos.id','desc')->paginate(10);
		}
		return view('mytube.index',compact('category','videos'));
	}

	public function play($vid)
	{
		$vid = decrypt($vid);

		if($_SERVER['REMOTE_ADDR']!="::1")
			$IP = $_SERVER['REMOTE_ADDR'];
		else
			$IP = getHostByName(getHostName());

		$no = DB::table('tbl_mytube_viewcount')->where(['ip'=>$IP,'video_id'=>$vid])->count();
		
		if(0==$no)
		{
			DB::table('tbl_mytube_viewcount')->insert(['video_id'=>$vid,'visits'=>1,'ip'=>$IP]);
		}
		else {
			DB::table('tbl_mytube_viewcount')->where(['video_id'=>$vid,'ip'=>$IP])->increment('visits',1);
		}

		$category = DB::table('tbl_mytube_category')->where(['status'=>1])->get();
		$video = DB::table('tbl_mytube_videos')->join('tbl_mytube_channel','tbl_mytube_channel.id','=','tbl_mytube_videos.channel_id')->select('*','tbl_mytube_videos.id as vid')->where(['tbl_mytube_videos.id'=>$vid,'tbl_mytube_videos.privacy'=>'public','tbl_mytube_channel.status'=>1,'tbl_mytube_videos.status'=>1])->first();
		$videos = DB::table('tbl_mytube_videos')->join('tbl_education_hub_users', 'tbl_education_hub_users.id', '=', 'tbl_mytube_videos.user_id')->select("*","tbl_mytube_videos.id as vid")->orderBy('tbl_mytube_videos.id','desc')->where(['tbl_mytube_videos.user_id'=>$video->user_id])->where('tbl_mytube_videos.id','!=',$vid)->limit(10)->get();
		if (count($videos)<2) {
			$searchValues = explode(' ', preg_replace('/[^A-Za-z0-9]/', ' ', $video->title));
			$searchValues = array_filter($searchValues, function($var){return $var!='';} );
			$videos = DB::table('tbl_mytube_videos')->join('tbl_education_hub_users', 'tbl_education_hub_users.id', '=', 'tbl_mytube_videos.user_id')->select("*","tbl_mytube_videos.id as vid")->orderBy('tbl_mytube_videos.id','desc')->where(
				function ($q) use ($searchValues) {
				  foreach ($searchValues as $value) {
				    $q->orWhere('tbl_mytube_videos.title', 'like', "%{$value}%");
				  }
				})->where('tbl_mytube_videos.id','!=',$vid)->limit(10)->get();
		}
		$user = DB::table('tbl_education_hub_users')->where(['id'=>$video->user_id])->first();
		$comment = DB::table('tbl_mytube_comment')->join('tbl_education_hub_users', 'tbl_education_hub_users.id', '=', 'tbl_mytube_comment.user_id')->where(['video_id'=>$vid])->get();
		return view('mytube.play',compact('vid','category','video','videos','user','comment'));
	}

	public function channel($cid)
	{
		$videos = DB::table('tbl_mytube_videos')->join('tbl_education_hub_users', 'tbl_education_hub_users.id', '=', 'tbl_mytube_videos.user_id')->join('tbl_mytube_channel','tbl_mytube_channel.id','=','tbl_mytube_videos.channel_id')->select("*","tbl_mytube_videos.id as vid")->where(['tbl_mytube_videos.privacy'=>'public','tbl_mytube_videos.channel_id'=>decrypt($cid)])->orderBy('tbl_mytube_videos.id','desc')->get();
		$channel = DB::table('tbl_mytube_channel')->where(['id'=>decrypt($cid)])->first();
		return view('mytube.channel',compact('videos','channel'));
	}

	public function thumbnail($filename)
	{
		$path = storage_path("app/thumbnail/".decrypt($filename));
		$file = File::get($path);
		$type = File::mimeType($path);
		$response = Response::make($file, 200);
		$response->header("Content-Type", $type);
		$response->header("cache","false");
		return $response;
	}

	public function getvideo($vid)
	{
		$url = DB::table('tbl_mytube_videos')->where(['id'=>decrypt($vid)])->first()->url;
		$path = storage_path("app/videos/".$url);
		$file = File::get($path);
		$type = File::mimeType($path);
		$response = Response::make($file, 200);
		$response->header("Content-Type", $type);
		$response->header("cache","false");
		return $response;
	}

	public function covertvideo($filename)
	{
		$mimeTypes = array("video/avi", "video/divx", "video/mp4", "video/mpeg", "video/x-flv", "video/quicktime");
		$type = "mp3";
		$path = storage_path('app\\');
		$name = "videos\\".decrypt($filename);

		$ffmpegpath = base_path()."\\exe\\ffmpeg.exe";
		$cname = pathinfo($path.$name)['filename'].".".$type;
		
		if (!is_dir($path."\\coverted_temp\\")) {
			mkdir($path."\\coverted_temp\\");
		}
		
		$cmd = '"'.$ffmpegpath.'" -i "'.$path.$name.'" -vn -ar 44100 -ac 2 -ab 192k -f '.$type.' "'.$path."\\coverted_temp\\".$cname.'"';
		shell_exec($cmd);
		return response()->download($path."\\coverted_temp\\".$cname)->deleteFileAfterSend(true);
	}
}