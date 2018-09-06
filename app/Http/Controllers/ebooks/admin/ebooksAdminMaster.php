<?php

namespace App\Http\Controllers\ebooks\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Ebooks\Books;
use App\Models\Ebooks\Category;
use App\Models\Ebooks\Subscribe;
use App\Models\Ebooks\Favorite;
use App\Models\Ebooks\Viewscount;
use View;
use DB;
use Auth;
use Storage;

class ebooksAdminMaster extends Controller
{
	public function postEbook()
	{
		$category = Category::get();
		return view('ebooks.admin.postebook',compact('category'));
	}

	public function post(Request $req)
	{
		$title = $req->input('title');
		$description = $req->input('description');
		$coverpage = $req->file('coverimage');
		$pdfbook = $req->file('book');
		$category_id = $req->input('category_id');
		$privacy = $req->input('privacy');

		$cover_mime = array("image/jpg","image/jpeg","image/png");
		$book_mime = array("application/pdf");

		$arr = array('title'=>$title,'description'=>$description,'category_id'=>$category_id,'privacy'=>$privacy);
		if (!in_array('', $arr)) {
			$arr['category_id'] = decrypt($category_id);
			if ($coverpage!='') {
				$cp = $coverpage->getmimeType();
				$booktype = $pdfbook->getmimeType();

				if (in_array($cp, $cover_mime) && in_array($booktype, $book_mime)) {
					$cppath = storage_path('app\\ebooks\\coverpage\\'.md5(Auth::user()->id).'\\');
					$bookpath = storage_path('app\\ebooks\\books\\'.md5(Auth::user()->id).'\\');
					$cpname = $coverpage->getClientOriginalName();
					$bookname = $pdfbook->getClientOriginalName();

					$coverpage->move($cppath,$cpname);
					$pdfbook->move($bookpath,$bookname);

					$this->generateThumbnail($cppath.$cpname,250,$cp,350);

					$ebookhash = hash_file('md5',$bookpath.$bookname);
					$arr1 = array('url'=>md5(Auth::user()->id)."/".$bookname,'user_id'=>Auth::user()->id,'thumbnail'=>md5(Auth::user()->id)."/".$cpname,'ebookhash'=>$ebookhash);
					$values = array_merge($arr,$arr1);
					if (Books::where('ebookhash',$ebookhash)->count()==0) {
						if (Books::create($values)) {
							echo "<div class='alert alert-success'>successfully Ebook uploaded</div>";
						}
						else {
							echo "<div class='alert alert-warning'>Database error please report an error</div>";
						}
					}
					else {
							echo "<div class='alert alert-danger'>Sorry Ebook is already exist</div>";
					}
				}
				else {
					echo "<div class='alert alert-info'>are you sure your selected file is a image and pdf</div>";
				}
			}
			else {
				echo "<div class='alert alert-danger'>please select Image file</div>";
			}
		}
		else {
			echo "<div class='alert aluser_ert-danger'>can't leave field empty</div>";
		}
	}

	public function subscription()
	{
		$subscription = Subscribe::with('user')->where('user_id',Auth::id())->get();
		return view('ebooks.admin.subscribe',compact('subscription'));
	}

	public function subscribe($uid,$url)
	{
		if (subscribe::where('user_id',decrypt($uid))->count()==0) {
			$sb = new subscribe;
			$sb->user_id = decrypt($uid);
			$sb->status = 1;
			$sb->save();
		}
		return redirect(decrypt($url));
	}

	public function unsubscribe($id)
	{
		subscribe::where('user_id',decrypt($id))->delete();
		if (!isset($_GET['url'])) {
			return redirect('mytube/admin/subscription');
		}
		else {
			return redirect(decrypt($_GET['url']));
		}
	}

	public function favorite()
	{
		$favorite = Favorite::with('books','user','viewscount')->where('user_id',Auth::id())->get();
		return view('ebooks.admin.favorite',compact('favorite'));
	}

	public function booksmanage()
    {
        $books = Books::where(['user_id'=>Auth::user()->id])->get();
        return view('ebooks.admin.manage_books',compact('books'));
    }

    public function editbook($bid)
    {
        if ($this->getbookpermision($bid)) {
            $book = Books::with('user')->where(['id'=>decrypt($bid)])->first();
            $category = Category::get();
            return view('ebooks.admin.editbook',compact('category','book'));
        }
        else {
            return abort(404);
        }
    }

    public function updatebook(Request $req,$bid)
    {
        $title = $req->input('title');
        $description = $req->input('description');
        $category_id = decrypt($req->input('category_id'));
        $privacy = $req->input('privacy');

        if ($this->getbookpermision($bid)) {
            $arr = array('title'=>$title,'description'=>$description,'category_id'=>$category_id,'privacy'=>$privacy);
            if (!in_array('', $arr)) {
                if (DB::table('tbl_ebooks_books')->where(['id'=>decrypt($bid)])->update($arr)) {
                    echo "<div class='alert alert-success'>successfully book updated</div>";
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

    public function deletebook($bid)
    {
        $bid = decrypt($bid);
        $book = Books::where('id',$bid)->first();
        if (Auth::user()->id==$book->user_id) {
            Storage::delete('ebooks\\books\\'.$book->url);
            Storage::delete('ebooks\\coverpage\\'.$book->thumbnail);
            Favorite::where(['book_id'=>$bid])->delete();
            Viewscount::where(['book_id'=>$bid])->delete();
            Books::where(['id'=>$bid])->delete();
        }
        return redirect("ebooks/admin/booksmanage");
    }

	public function addfavorite($bid)
	{
		$bid = decrypt($bid);
		if (Favorite::where(['book_id'=>$bid,'user_id'=>Auth::user()->id])->count()==0) {
			$fav = new Favorite;
			$fav->user_id = Auth::user()->id;
			$fav->book_id = $bid;
			$fav->status = 1;
			$fav->save();
		}
		if (!isset($_GET['url'])) {
			return redirect('ebooks/admin/favorite');
		}
		else {
			return redirect(decrypt($_GET['url']));
		}
	}

	public function removefavorite($bid)
	{
		Favorite::where(['book_id'=>decrypt($bid),'user_id'=>Auth::user()->id])->delete();
		if (!isset($_GET['url'])) {
			return redirect('mytube/admin/favorite');
		}
		else {
			return redirect(decrypt($_GET['url']));
		}
	}

	public function generateThumbnail($img, $desired_width, $mime,$quality = 90)
	{
		if (is_file($img)) {
		    if ($mime=="image/png") {
                $source_image = imagecreatefrompng($img);
            }
            else if ($mime=="image/jpeg") {
                $source_image = imagecreatefromjpeg($img);
            }
            else {
		        exit(0);
            }
            $width = imagesx($source_image);
            $height = imagesy($source_image);
            $desired_height = floor($height * ($desired_width / $width));
            $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
            imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
            if ($mime=="image/png") {
                imagepng($virtual_image, $img);
            }
            else if ($mime=="image/jpeg") {
                imagejpeg($virtual_image, $img);
            }
            else {
                exit(0);
            }
	    }
	}

    public function getbookpermision($bid)
    {
        return Auth::user()->id==Books::find(decrypt($bid))->first()->user_id?true:false;
    }
}
