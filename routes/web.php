<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// education hub home
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

// for file download
Route::get('download/{type}/{filename}', 'Controller@download');

// conver video to mp3
Route::get('converter', function() {
	return view('converter');
});
Route::post('convert', 'Controller@convert');


// mytube routes
Route::group(['prefix'=>'mytube'],function()
{
	Route::get('{cid}', ["uses"=>'mytube\mytubeMaster@get',"as"=>'mytube_index']);
	Route::get('', ["uses"=>'mytube\mytubeMaster@get',"as"=>'mytube_index']);
	Route::get('channel/{cid}', 'mytube\mytubeMaster@channel');
	Route::get('play/{vid}', 'mytube\mytubeMaster@play');
	Route::get('thumbnail/{filename}',["uses" => 'mytube\mytubeMaster@thumbnail',"as" => 'thumbnail']);
	Route::get('video/{vid}',["uses" => 'mytube\mytubeMaster@getvideo',"as" => 'video']);
	Route::get('video/convert/{id}', 'mytube\mytubeMaster@covertvideo');
	
	Route::group(['prefix'=>'admin'],function()
	{
		Route::get('dashboard', 'mytube\admin\mytubeAdminMaster@dashboard')->middleware('auth');
		Route::get('postvideo', 'mytube\admin\mytubeAdminMaster@postvideo')->middleware('auth');
		Route::post('postvideo/post', 'mytube\admin\mytubeAdminMaster@post')->middleware('auth');
		Route::get('videomanager', 'mytube\admin\mytubeAdminMaster@videomanager')->middleware('auth');
		Route::get('videomanager/edit/{vid}', 'mytube\admin\mytubeAdminMaster@editvideo')->middleware('auth');
		Route::get('videomanager/delete/{vid}', 'mytube\admin\mytubeAdminMaster@deletevideo')->middleware('auth');
		Route::post('videomanger/updatevideo/{vid}', 'mytube\admin\mytubeAdminMaster@updatevideo')->middleware('auth');
		Route::get('channel', 'mytube\admin\mytubeAdminMaster@channel')->middleware('auth');
		Route::get('channel/add/{name}', 'mytube\admin\mytubeAdminMaster@addchannel')->middleware('auth');
		Route::get('channel/delete/{id}', 'mytube\admin\mytubeAdminMaster@deletechannel')->middleware('auth');
		Route::get('channel/deactive/{id}', 'mytube\admin\mytubeAdminMaster@deactivechannel')->middleware('auth');
		Route::get('channel/active/{id}', 'mytube\admin\mytubeAdminMaster@activechannel')->middleware('auth');
		Route::get('channel/edit/{id}/{name}', 'mytube\admin\mytubeAdminMaster@editchannel')->middleware('auth');
		Route::get('favorite', 'mytube\admin\mytubeAdminMaster@favorite')->middleware('auth');
		Route::get('favorite/remove/{vid}', 'mytube\admin\mytubeAdminMaster@removefavorite')->middleware('auth');
		Route::get('favorite/add/{vid}', 'mytube\admin\mytubeAdminMaster@addfavorite')->middleware('auth');
		Route::get('subscription', 'mytube\admin\mytubeAdminMaster@subscription')->middleware('auth');
		Route::get('subscription/subscribe/{id}/{url}', 'mytube\admin\mytubeAdminMaster@subscribe')->middleware('auth');
		Route::get('subscription/unsubscribe/{id}', 'mytube\admin\mytubeAdminMaster@unsubscribe')->middleware('auth');
		Route::get('video/like/{id}', 'mytube\admin\mytubeAdminMaster@like')->middleware('auth');
		Route::get('mytube/video/unlike/{id}', 'mytube\admin\mytubeAdminMaster@unlike')->middleware('auth');
		Route::get('video/removelikeunlike/{id}', 'mytube\admin\mytubeAdminMaster@removelikeunlike')->middleware('auth');
		Route::post('video/postcomment', 'mytube\admin\mytubeAdminMaster@postcomment')->middleware('auth');
	});
});


// source code routes
Route::group(['prefix'=>'sourcecode'],function()
{
	Route::get('/', function () {
		return view('sourcecode.index');
	});
	Route::get('{un}', function () {
		return view('sourcecode.profile');
	});
	Route::get('{un}/tab', function () {
		return view('sourcecode.profile_tab_data');
	});
	Route::get('download/code', function () {
	    return view('sourcecode.download');
	});
});

// routes of ebook
Route::group(['prefix'=>'ebooks'],function()
{
	Route::get('ebooks', ["uses"=>'ebooks\ebooksMaster@index',"as"=> 'ebooks_index']);
	Route::get('ebooks/{category_id}', ["uses"=>'ebooks\ebooksMaster@index',"as"=> 'ebooks_index_cat']);
	Route::get('ebooks/author/{au_id}', ["uses"=>'ebooks\ebooksMaster@author',"as"=> 'ebooks_author']);
	Route::get('ebooks/show/{bid}', ["uses"=>'ebooks\ebooksMaster@showPDF',"as"=> 'book_show']);
	Route::get('ebooks/thumbnail/{bid}',["uses" => 'ebooks\ebooksMaster@thumbnail',"as" => 'book_thumb']);

	Route::group(['prefix'=>'admin'],function() {
		Route::get('favorite', 'ebooks\admin\ebooksAdminMaster@favorite')->middleware('auth');
		Route::get('postebook', 'ebooks\admin\ebooksAdminMaster@postebook')->middleware('auth');
		Route::get('subscription', ["uses"=>'ebooks\admin\ebooksAdminMaster@subscription',"as"=>'ebooks_subscription'])->middleware('auth');
		Route::get('subscription/subscribe/{uid}/{url}', ["uses"=>'ebooks\admin\ebooksAdminMaster@subscribe',"as"=>'ebooks_author_subscribe'])->middleware('auth');
		Route::get('subscription/unsubscribe/{id}', ["uses"=>'ebooks\admin\ebooksAdminMaster@unsubscribe',"as"=>'ebooks_author_unsubscribe'])->middleware('auth');
		Route::post('postebook/post', ["uses"=>'ebooks\admin\ebooksAdminMaster@post',"as"=>'ebooks_post_book'])->middleware('auth');
		Route::get('favorite/add/{bid}', ["uses"=>'ebooks\admin\ebooksAdminMaster@addfavorite',"as"=>'ebooks_favorite_book'])->middleware('auth');
		Route::get('favorite/remove/{bid}', ["uses"=>'ebooks\admin\ebooksAdminMaster@removefavorite',"as"=>'ebooks_remove_favorite_book'])->middleware('auth');
		Route::get('booksmanage',["uses"=>'ebooks\admin\ebooksAdminMaster@booksmanage',"as"=>'ebooks_books_manage'])->middleware('auth');
		Route::get('bookmanager/edit/{bid}', ["uses"=>'ebooks\admin\ebooksAdminMaster@editbook',"as"=>'ebooks_books_edit'])->middleware('auth');
		Route::get('bookmanager/delete/{bid}', ["uses"=>'ebooks\admin\ebooksAdminMaster@deletebook',"as"=>'ebooks_books_deletebook'])->middleware('auth');
		Route::post('bookmanger/updatebook/{bid}', ["uses"=>'ebooks\admin\ebooksAdminMaster@updatebook',"as"=>'ebooks_books_updatebook'])->middleware('auth');
	});
});

// routes of articals
Route::group(['prefix'=>'articles'],function()
{
	Route::get('/', ["uses"=>'articles\articlesMaster@index',"as"=> 'articles']);
	Route::get('/{subject_id}/{article_id}', ["uses"=>'articles\articlesMaster@index',"as"=> 'articles_index']);

	Route::group(['prefix'=>'admin'],function()
	{
		Route::get('add', function () {return view('articles.addarticle');});
		Route::post('addArticle','articles\admin\articlesAdminMaster@addArticle');
	});
});

// users route
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');
Route::get('user/profile/{uid}',["uses" => 'Controller@getusrprofile',"as" => 'profile']);
Auth::routes();