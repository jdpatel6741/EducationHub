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
})->name('converter');
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
	
	Route::group(['prefix'=>'admin','middleware'=>'auth'],function()
	{
		Route::get('dashboard', 'mytube\admin\mytubeAdminMaster@dashboard')->name('mytube_dashboard');
		Route::get('postvideo', 'mytube\admin\mytubeAdminMaster@postvideo');
		Route::post('postvideo/post', 'mytube\admin\mytubeAdminMaster@post');
		Route::get('videomanager', 'mytube\admin\mytubeAdminMaster@videomanager');
		Route::get('videomanager/edit/{vid}', 'mytube\admin\mytubeAdminMaster@editvideo');
		Route::get('videomanager/delete/{vid}', 'mytube\admin\mytubeAdminMaster@deletevideo');
		Route::post('videomanger/updatevideo/{vid}', 'mytube\admin\mytubeAdminMaster@updatevideo');
		Route::get('channel', 'mytube\admin\mytubeAdminMaster@channel');
		Route::get('channel/add/{name}', 'mytube\admin\mytubeAdminMaster@addchannel');
		Route::get('channel/delete/{id}', 'mytube\admin\mytubeAdminMaster@deletechannel');
		Route::get('channel/deactive/{id}', 'mytube\admin\mytubeAdminMaster@deactivechannel');
		Route::get('channel/active/{id}', 'mytube\admin\mytubeAdminMaster@activechannel');
		Route::get('channel/edit/{id}/{name}', 'mytube\admin\mytubeAdminMaster@editchannel');
		Route::get('favorite', 'mytube\admin\mytubeAdminMaster@favorite');
		Route::get('favorite/remove/{vid}', 'mytube\admin\mytubeAdminMaster@removefavorite');
		Route::get('favorite/add/{vid}', 'mytube\admin\mytubeAdminMaster@addfavorite');
		Route::get('subscription', 'mytube\admin\mytubeAdminMaster@subscription');
		Route::get('subscription/subscribe/{id}/{url}', 'mytube\admin\mytubeAdminMaster@subscribe');
		Route::get('subscription/unsubscribe/{id}', 'mytube\admin\mytubeAdminMaster@unsubscribe');
		Route::get('video/like/{id}', 'mytube\admin\mytubeAdminMaster@like');
		Route::get('mytube/video/unlike/{id}', 'mytube\admin\mytubeAdminMaster@unlike');
		Route::get('video/removelikeunlike/{id}', 'mytube\admin\mytubeAdminMaster@removelikeunlike');
		Route::post('video/postcomment', 'mytube\admin\mytubeAdminMaster@postcomment');
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
	Route::get('', ["uses"=>'ebooks\ebooksMaster@index',"as"=> 'ebooks_index']);
	Route::get('/{category_id}', ["uses"=>'ebooks\ebooksMaster@index',"as"=> 'ebooks_index_cat']);
	Route::get('/author/{au_id}', ["uses"=>'ebooks\ebooksMaster@author',"as"=> 'ebooks_author']);
	Route::get('/show/{bid}', ["uses"=>'ebooks\ebooksMaster@showPDF',"as"=> 'book_show']);
	Route::get('/thumbnail/{bid}',["uses" => 'ebooks\ebooksMaster@thumbnail',"as" => 'book_thumb']);

	Route::group(['prefix'=>'admin','middleware'=>'auth'],function() {
		Route::get('favorite', 'ebooks\admin\ebooksAdminMaster@favorite')->name('ebooks_favorite');
		Route::get('postebook', ["uses"=>'ebooks\admin\ebooksAdminMaster@postebook',"as"=>'postebook']);
		Route::get('subscription', ["uses"=>'ebooks\admin\ebooksAdminMaster@subscription',"as"=>'ebooks_subscription']);
		Route::get('subscription/subscribe/{uid}/{url}', ["uses"=>'ebooks\admin\ebooksAdminMaster@subscribe',"as"=>'ebooks_author_subscribe']);
		Route::get('subscription/unsubscribe/{id}', ["uses"=>'ebooks\admin\ebooksAdminMaster@unsubscribe',"as"=>'ebooks_author_unsubscribe']);
		Route::post('postebook/post', ["uses"=>'ebooks\admin\ebooksAdminMaster@post',"as"=>'ebooks_post_book']);
		Route::get('favorite/add/{bid}', ["uses"=>'ebooks\admin\ebooksAdminMaster@addfavorite',"as"=>'ebooks_favorite_book']);
		Route::get('favorite/remove/{bid}', ["uses"=>'ebooks\admin\ebooksAdminMaster@removefavorite',"as"=>'ebooks_remove_favorite_book']);
		Route::get('booksmanage',["uses"=>'ebooks\admin\ebooksAdminMaster@booksmanage',"as"=>'ebooks_books_manage']);
		Route::get('bookmanager/edit/{bid}', ["uses"=>'ebooks\admin\ebooksAdminMaster@editbook',"as"=>'ebooks_books_edit']);
		Route::get('bookmanager/delete/{bid}', ["uses"=>'ebooks\admin\ebooksAdminMaster@deletebook',"as"=>'ebooks_books_deletebook']);
		Route::post('bookmanger/updatebook/{bid}', ["uses"=>'ebooks\admin\ebooksAdminMaster@updatebook',"as"=>'ebooks_books_updatebook']);
	});
});

// routes of articals
Route::group(['prefix'=>'articles'],function()
{
	Route::get('show', ["uses"=>'articles\articlesMaster@index',"as"=> 'articles']);
	Route::get('show/{subject_id}/{article_id}', ["uses"=>'articles\articlesMaster@index',"as"=> 'articles_index']);

	Route::group(['prefix'=>'admin','middleware' => 'auth'],function()
	{
		Route::get('add', ['uses'=>'articles\admin\articlesAdminMaster@add','as'=>'articles_add']);
		Route::post('addArticle', ['uses'=>'articles\admin\articlesAdminMaster@addArticle','as'=>'articles_add_article']);
		Route::get('manageArticle', ['uses'=>'articles\admin\articlesAdminMaster@manageArticle','as'=>'articles_manage']);
		Route::get('articlesmanager/edit/{aid}', ["uses"=>'articles\admin\articlesAdminMaster@editarticle',"as"=>'article_edit']);
		Route::get('articlesmanager/delete/{aid}','articles\admin\articlesAdminMaster@deletearticle')->name('articles_article_deletearticle');
		Route::post('articlesmanager/updatearticle/{aid}','articles\admin\articlesAdminMaster@updatearticle')->name('articles_updatearticle');
		Route::get('favorite', 'articles\admin\articlesAdminMaster@articles_favorite')->name('articles_favorite');
		Route::get('favorite/add/{aid}', 'articles\admin\articlesAdminMaster@addfavorite')->name('articles_article_addfavorite');
		Route::get('favorite/remove/{aid}', 'articles\admin\articlesAdminMaster@removefavorite')->name('articles_article_removefavorite');
	});
});

// users route
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');
Route::get('user/profile/{uid}',["uses" => 'Controller@getusrprofile',"as" => 'profile']);
Auth::routes();