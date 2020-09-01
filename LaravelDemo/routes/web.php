<?php

use Illuminate\Support\Facades\Route;
use App\theloai;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('thu',function(){
	$data = theloai::find(1);
	foreach($data->loaitin as $loaitin)
	{
		echo $loaitin->Ten."<br>";
	}
});
//Route Groups
Route::group(['prefix'=>'admin'],function(){
	Route::group(['prefix'=>'theloai'],function(){
		Route::get('danhsach','theloaiController@getdanhsach');
		//Thêm
		Route::get('them','theloaiController@getthem');	
		Route::post('them','theloaiController@postthem');
		//Sửa
		Route::get('sua/{id}','theloaiController@getsua');
		Route::post('sua/{id}','theloaiController@postsua');
		//Xoa
		Route::get('xoa/{id}','theloaiController@getxoa');
	});
	Route::group(['prefix'=>'loaitin'],function(){
		Route::get('danhsach','loaitinController@getdanhsach');
		//Thêm
		Route::get('them','loaitinController@getthem');	
		Route::post('them','loaitinController@postthem');
		//Sửa
		Route::get('sua/{id}','loaitinController@getsua');
		Route::post('sua/{id}','loaitinController@postsua');
		//Xóa
		Route::get('xoa/{id}','loaitinController@getxoa');
	});
	Route::group(['prefix'=>'tintuc'],function(){
		Route::get('danhsach','tintucController@getdanhsach');
		//Thêm
		Route::get('them','tintucController@getthem');
		Route::post('them','tintucController@postthem');

		//Sửa
		Route::get('sua/{id}','tintucController@getsua');
		Route::post('sua/{id}','tintucController@postsua');
		//Xóa
		Route::get('xoa/{id}','tintucController@getxoa');
	});
	//Quản lí comment
	Route::group(['prefix'=>'comment'],function(){
		Route::get('xoa/{id}/{idtintuc}','commentController@getxoa');
	});
	//Slide
	Route::group(['prefix'=>'slide'],function(){
		Route::get('danhsach','slideController@getDanhsach');
		//Thêm
		Route::get('them','slideController@getthem');	
		Route::post('them','slideController@postthem');
		//Sửa
		Route::get('sua/{id}','slideController@getsua');
		Route::post('sua/{id}','slideController@postsua');
	});
	//User
	Route::group(['prefix'=>'user'],function(){
		Route::get('danhsach','theloaiController@getDanhsach');
		Route::get('them','theloaiController@getthem');	
		Route::get('sua','theloaiController@getsua');
	});
	
	//Ajax
	Route::group(['prefix'=>'ajax'],function(){
		Route::get('loaitin/{idtheloai}','ajaxController@getloaitin');
	});
});


