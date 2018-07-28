<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use File;
use Response;
use Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function getusrprofile($uid)
	{
		$profile = DB::table('tbl_education_hub_users')->where(['id'=>decrypt($uid)])->first()->profile;
		$path = storage_path("app/profile/".$profile);
		$file = File::get($path);
		$type = File::mimeType($path);
		$response = Response::make($file, 200);
		$response->header("Content-Type", $type);
		$response->header("cache","false");
		return $response;
	}

	public function download($type,$filename)
	{
		$path = storage_path("app/$type/".decrypt($filename));
		return response()->download($path);
	}

	public function convert(Request $req)
	{
		$mimeTypes = array("video/avi", "video/divx", "video/mp4", "video/mpeg", "video/x-flv", "video/quicktime");
		$type = decrypt($req->input('type'));
		$file = $req->file('sourcefile');
		$mime = $file->getmimeType();
		if (!(is_null($type) && is_null($file))) {
			if (in_array($mime, $mimeTypes)) {
				$name = $file->getClientOriginalName();
				$path = storage_path('app\\coverted_temp\\');
				$file->move($path,$name);

				$ffmpegpath = base_path()."\\exe\\ffmpeg.exe";
				$cname = pathinfo($path.$name)['filename'].".".$type;
				
				if (!is_dir($path)) {
					mkdir($path);
				}
				
				$cmd = '"'.$ffmpegpath.'" -i "'.$path.$name.'" -vn -ar 44100 -ac 2 -ab 192k -f '.$type.' "'.$path.$cname.'"';
				shell_exec($cmd);
				unlink($path.$name);
				return response()->download($path.$cname)->deleteFileAfterSend(true);
			}
		}
	}
}
