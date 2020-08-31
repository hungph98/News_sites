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
		Route::get('sua','loaitinController@getsua');
		Route::post('sua/{id}','loaitinController@postsua');
		//Xóa
		Route::get('xoa/{id}','loaitinController@getxoa');
	});
	Route::group(['prefix'=>'tintuc'],function(){
		Route::get('danhsach','theloaiController@getDanhsach');
		Route::get('them','theloaiController@getthem');	
		Route::get('sua','theloaiController@getsua');
	});
	Route::group(['prefix'=>'user'],function(){
		Route::get('danhsach','theloaiController@getDanhsach');
		Route::get('them','theloaiController@getthem');	
		Route::get('sua','theloaiController@getsua');
	});
	Route::group(['prefix'=>'slide'],function(){
		Route::get('danhsach','theloaiController@getDanhsach');
		Route::get('them','theloaiController@getthem');	
		Route::get('sua','theloaiController@getsua');
	});
});


