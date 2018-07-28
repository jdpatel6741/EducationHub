<?php

namespace App\Http\Controllers\mytube\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use DB;
use Auth;
use Storage;

class mytubeAdminMaster extends Controller
{
	public function dashboard()
	{
		$videos = DB::table('tbl_mytube_videos')->where(['user_id'=>Auth::user()->id])->count();
		$channel = DB::table('tbl_mytube_channel')->where(['user_id'=>Auth::user()->id])->count();
		$subscribe = DB::table('tbl_mytube_subscribe')->where(['user_id'=>Auth::user()->id])->count();
		$favorite = DB::table('tbl_mytube_favorite')->where(['user_id'=>Auth::user()->id])->count();
		$views = DB::table('tbl_mytube_videos')->join('tbl_mytube_viewcount','tbl_mytube_viewcount.video_id','=','tbl_mytube_videos.id')->where(['tbl_mytube_videos.user_id'=>Auth::user()->id])->count();
		$data = array('videos'=>$videos, 'channel'=>$channel, 'subscribe'=>$subscribe ,'favorite'=>$favorite,'views'=>$views);
		return View::make('mytube.admin.dashboard')->with('data',$data);
	}

	public function postvideo()
	{
		$category = DB::table('tbl_mytube_category')->where(['status'=>1])->get();
		$channel = DB::table('tbl_mytube_channel')->where(['user_id'=>Auth::user()->id,'status'=>1])->get();
		return view('mytube.admin.postvideo',compact('category','channel'));
	}

	public function post(Request $req)
	{
		$title = $req->input('title');
		$description = $req->input('description');
		$video = $req->file('file');
		$category_id = $req->input('category_id');
		$channel_id = $req->input('channel_id');
		$privacy = $req->input('privacy');
		$playlist = $req->input('playlist');
		$mime = array("video/avi", "video/divx", "video/mp4", "video/mpeg", "video/x-flv", "video/quicktime");

		$arr = array('title'=>$title,'description'=>$description,'category_id'=>$category_id,'channel_id'=>$channel_id,'privacy'=>$privacy);
		if (!in_array('', $arr)) {
			$arr['category_id'] = decrypt($category_id);
			$arr['channel_id'] = decrypt($channel_id);
			if ($video!='') {
				$vfe = $video->getmimeType();
				if (in_array($vfe, $mime)) {
					$vidpath = storage_path('app\\videos\\'.md5(Auth::user()->id).'\\');
					$vidname = $video->getClientOriginalName();

					$video->move($vidpath,$vidname);
					
					$ffmpegpath = base_path()."\\exe\\ffmpeg.exe";
					$thumbpath = storage_path('app\\thumbnail\\'.md5(Auth::user()->id).'\\');
					$thumbname = pathinfo($vidpath.$vidname)['filename'].".jpg";
					if (!is_dir($thumbpath)) {
						mkdir($thumbpath);
					}
					$cmd = '"'.$ffmpegpath.'" -i "'.$vidpath.$vidname.'" -an -ss 10 -s 196x110 "'.$thumbpath.$thumbname.'"';
					shell_exec($cmd);
					
					$videohash = hash_file('md5',$vidpath.$vidname);
					$arr1 = array('url'=>md5(Auth::user()->id)."/".$vidname,'user_id'=>Auth::user()->id,'thumbnail'=>md5(Auth::user()->id)."/".$thumbname,'videohash'=>$videohash);
					$values = array_merge($arr,$arr1);

					if (DB::table('tbl_mytube_videos')->where(['videohash'=>$videohash])->count()==0) {
						if (DB::table('tbl_mytube_videos')->insert($values)) {
							if ($playlist=="yes") {
								$getid = DB::table('tbl_mytube_videos')->where($values)->first()->id;
								DB::table('tbl_mytube_favorite')->insert(['user_id'=>Auth::user()->id,'video_id'=>$getid,'status'=>1]);
							}
							echo "<div class='alert alert-success'>successfully video uploaded</div>";
						}
						else {
							echo "<div class='alert alert-warning'>Database error please report an error</div>";
						}
					}
					else {
							echo "<div class='alert alert-danger'>Sorry video is already exist</div>";
					}
				}
				else {
					echo "<div class='alert alert-info'>are you sure your selected file is a video</div>";
				}
			}
			else {
				echo "<div class='alert alert-danger'>please select video file</div>";
			}
		}
		else {
			echo "<div class='alert alert-danger'>can't leave field empty</div>";
		}
	}

	public function videomanager()
	{
		$videos = DB::table('tbl_mytube_videos')->where(['user_id'=>Auth::user()->id])->get();
		return view('mytube.admin.videomanager',compact('videos'));
	}

	public function editvideo($vid)
	{
		if ($this->getvidpermision($vid)) {
			$category = DB::table('tbl_mytube_category')->where(['status'=>1])->get();
			$channel = DB::table('tbl_mytube_channel')->where(['user_id'=>Auth::user()->id])->get();
			$video = DB::table('tbl_mytube_videos')->where(['id'=>decrypt($vid)])->first();
			return view('mytube.admin.editvideo',compact('category','channel','video'));
		}
		else {
			 return abort(404);
		}
	}

	public function updatevideo(Request $req,$vid)
	{
		$title = $req->input('title');
		$description = $req->input('description');
		$category_id = decrypt($req->input('category_id'));
		$channel_id = decrypt($req->input('channel_id'));
		$privacy = $req->input('privacy');

		if ($this->getvidpermision($vid)) {
			$arr = array('title'=>$title,'description'=>$description,'category_id'=>$category_id,'channel_id'=>$channel_id,'privacy'=>$privacy);
			if (!in_array('', $arr)) {
				if (DB::table('tbl_mytube_videos')->where(['id'=>decrypt($vid)])->update($arr)) {
					echo "<div class='alert alert-success'>successfully video updated</div>";
				}
				else {
					echo "<div class='alert alert-warning'>No any updates found</div>";
				}
			}
			else {
				echo "<div class='alert alert-danger'>can't leave field empty</div>";
			}
		}
		else {
			echo "<div class='alert alert-danger'>you don't have permision to edit this video</div>";
		}
	}

	public function deletevideo($vid)
	{
		$vid = decrypt($vid);
		$video = DB::table('tbl_mytube_videos')->where(['id'=>$vid])->first();
		if (Auth::user()->id==$video->user_id) {
			Storage::delete('videos\\'.$video->url);
			Storage::delete('thumbnail\\'.$video->thumbnail);
			DB::table('tbl_mytube_comment')->where(['video_id'=>$vid])->delete();
			DB::table('tbl_mytube_favorite')->where(['video_id'=>$vid])->delete();
			DB::table('tbl_mytube_likecount')->where(['video_id'=>$vid])->delete();
			DB::table('tbl_mytube_viewcount')->where(['video_id'=>$vid])->delete();
			DB::table('tbl_mytube_videos')->where(['id'=>$vid])->delete();
		}
		return redirect("mytube/admin/videomanager");
	}

	public function channel() 
	{
		$channel = DB::table('tbl_mytube_channel')->where(['user_id'=>Auth::user()->id])->get();
		return view('mytube.admin.channel',compact('channel'));
	}

	public function addchannel($name)
	{
		if (!is_null($name)) {
			DB::table("tbl_mytube_channel")->insert(['name'=>$name,'user_id'=>Auth::user()->id,'status'=>1]);
		}
	}

	public function deletechannel($id)
	{
		$channels = DB::table('tbl_mytube_videos')->where(['channel_id'=>decrypt($id)])->get();
		$channel = DB::table('tbl_mytube_channel')->where(['id'=>decrypt($id)])->first();
		if (Auth::user()->id==$channel->user_id) {
			foreach ($channels as $value) {
				$this->deletevideo(encrypt($value->id));
			}
			DB::table('tbl_mytube_channel')->where(['id'=>decrypt($id)])->delete();
		}
		return redirect("mytube/admin/channel");
	}

	public function activechannel($id)
	{
		if (Auth::user()->id==DB::table('tbl_mytube_channel')->where(['id'=>decrypt($id)])->first()->user_id) {
			DB::table('tbl_mytube_channel')->where(['id'=>decrypt($id)])->update(['status'=>1]);
		}
		return redirect("mytube/admin/channel");	
	}

	public function deactivechannel($id)
	{
		if (Auth::user()->id==DB::table('tbl_mytube_channel')->where(['id'=>decrypt($id)])->first()->user_id) {
			DB::table('tbl_mytube_channel')->where(['id'=>decrypt($id)])->update(['status'=>0]);
		}
		return redirect("mytube/admin/channel");
	}

	public function editchannel($id,$name)
	{
		if (Auth::user()->id==DB::table('tbl_mytube_channel')->where(['id'=>decrypt($id)])->first()->user_id) {
			DB::table('tbl_mytube_channel')->where(['id'=>decrypt($id)])->update(['name'=>$name]);
		}
		return redirect("mytube/admin/channel");
	}

	public function favorite()
	{
		$favorite = DB::table('tbl_mytube_favorite')->join('tbl_mytube_videos', 'tbl_mytube_videos.id', '=', 'tbl_mytube_favorite.video_id')->where(['tbl_mytube_favorite.user_id'=>Auth::user()->id])->get();
		$data = array('favorite'=>$favorite);
		return View('mytube.admin.favorite')->with('data',$data);
	}

	public function addfavorite($id)
	{
		$id = decrypt($id);
		if (DB::table('tbl_mytube_favorite')->where(['video_id'=>$id,'user_id'=>Auth::user()->id])->count()==0) {
			DB::table('tbl_mytube_favorite')->insert(['user_id'=>Auth::user()->id,'video_id'=>$id,'status'=>1]);
		}
		if (!isset($_GET['url'])) {
			return redirect('mytube/admin/favorite');
		}
		else {
			return redirect(decrypt($_GET['url']));
		}
	}

	public function removefavorite($vid)
	{
		DB::table('tbl_mytube_favorite')->where(['video_id'=>decrypt($vid),'user_id'=>Auth::user()->id])->delete();
		if (!isset($_GET['url'])) {
			return redirect('mytube/admin/favorite');
		}
		else {
			return redirect(decrypt($_GET['url']));
		}
	}

	public function subscription()
	{
		$subscription = DB::table('tbl_mytube_subscribe')->join('tbl_mytube_channel', 'tbl_mytube_channel.id', '=', 'tbl_mytube_subscribe.channel_id')->join('tbl_education_hub_users','tbl_education_hub_users.id','=','tbl_mytube_channel.user_id')->select('*','tbl_mytube_channel.name as cname')->where(['tbl_mytube_subscribe.user_id'=>Auth::user()->id])->get();
		$data = array('subscription'=>$subscription);
		return View("mytube.admin.subscription")->with('data',$data);
	}

	public function unsubscribe($id)
	{
		DB::table('tbl_mytube_subscribe')->where(['channel_id'=>decrypt($id),'user_id'=>Auth::user()->id])->delete();
		if (!isset($_GET['url'])) {
			return redirect('mytube/admin/subscription');
		}
		else {
			return redirect(decrypt($_GET['url']));
		}
	}

	public function subscribe($cid,$url)
	{
		if (DB::table('tbl_mytube_subscribe')->where(['channel_id'=>decrypt($cid),'user_id'=>Auth::user()->id])->count()==0) {
			DB::table('tbl_mytube_subscribe')->insert(['channel_id'=>decrypt($cid),'user_id'=>Auth::user()->id,'status'=>1]);
		}
		return redirect(decrypt($url));
	}

	public function like($id)
	{
		$id = decrypt($id);
		$data = DB::table('tbl_mytube_likecount')->where(['video_id'=>$id,'user_id'=>Auth::user()->id]);
		if ($data->count()==0) {
			DB::table('tbl_mytube_likecount')->insert(['user_id'=>Auth::user()->id,'video_id'=>$id,'status'=>1]);
		}
		else {
			if ($data->first()->status==0) {
				DB::table('tbl_mytube_likecount')->where(['user_id'=>Auth::user()->id,'video_id'=>$id])->update(['status'=>1]);
			}
		}
		if (!isset($_GET['url'])) {
			return redirect('mytube');
		}
		else {
			return redirect(decrypt($_GET['url']));
		}
	}

	public function unlike($id)
	{
		$id = decrypt($id);
		$data = DB::table('tbl_mytube_likecount')->where(['video_id'=>$id,'user_id'=>Auth::user()->id]);
		if ($data->count()==0) {
			DB::table('tbl_mytube_likecount')->insert(['user_id'=>Auth::user()->id,'video_id'=>$id,'status'=>2]);
		}
		else {
			if ($data->first()->status==0) {
				DB::table('tbl_mytube_likecount')->where(['user_id'=>Auth::user()->id,'video_id'=>$id])->update(['status'=>2]);
			}
		}
		if (!isset($_GET['url'])) {
			return redirect('mytube');
		}
		else {
			return redirect(decrypt($_GET['url']));
		}
	}

	public function removelikeunlike($id)
	{
		$id = decrypt($id);
		$data = DB::table('tbl_mytube_likecount')->where(['video_id'=>$id,'user_id'=>Auth::user()->id]);
		if ($data->first()->status!=0) {
			DB::table('tbl_mytube_likecount')->where(['user_id'=>Auth::user()->id,'video_id'=>$id])->update(['status'=>0]);
		}
		if (!isset($_GET['url'])) {
			return redirect('mytube');
		}
		else {
			return redirect(decrypt($_GET['url']));
		}
	}

	public function postcomment(Request $req)
	{
		$uid = Auth::user()->id;
		$vid = decrypt($req->input('vid'));
		$comment = $req->input('comment');
		if (!(is_null($comment) && is_null($vid))) {
			DB::table('tbl_mytube_comment')->insert(['video_id'=>$vid,'comment'=>$comment,'status'=>1,'user_id'=>$uid]);
		}
		return redirect(decrypt($req->input('url')));
	}

	public function getvidpermision($vid) 
	{
		return Auth::user()->id==DB::table('tbl_mytube_videos')->where(['id'=>decrypt($vid)])->first()->user_id?true:false;
	}
}