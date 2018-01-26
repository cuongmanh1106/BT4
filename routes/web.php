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
Route::get('/abc',function(){
		echo "abc";
	});

Route::get('/', function () {
    return view('welcome');
});

Route::get('a',function(){
	echo "abc";
});

Route::get('/','HomeController@index')->name('/');

Route::group(['prefix'=>'admin' , 'middleware'=>'Login'],function() {

	Route::group(['prefix'=>'product'],function(){
		Route::get('/','ProductsController@index')->name('product.list');
		Route::post('/','ProductsController@index')->name('product.list');
		Route::get('/create','ProductsController@create')->name('product.create');
		Route::post('/store','ProductsController@store')->name('product.insert')->middleware('CheckId');
		Route::get('/edit/{id}','ProductsController@edit')->name('product.edit');
		Route::post('/update/{id}','ProductsController@update')->name('product.update')->middleware('CheckId');
		Route::get('/delete/{id}','ProductsController@delete')->name('product.delete');
		Route::get('delimg/{id}','ProductsController@getDelImg')->name('product.getDelImg');

	});

	Route::group(['prefix'=>'categories'],function() {
		Route::get('/','CategoriesController@index')->name('categories.list');
		Route::get('/create','CategoriesController@create')->name('categories.create');
		Route::post('/store','CategoriesController@store')->name('categories.store');
		Route::get('/edit/{id}','CategoriesController@edit')->name('categories.edit');
		Route::post('/update/{id}','CategoriesController@update')->name('categories.update');
		Route::get('/delete/{id}','CategoriesController@delete')->name('categories.delete');
		Route::get('/list_pro/{id}','CategoriesController@list_pro')->name('categories.list_pro');

		
	});

	Route::group(['prefix'=>'productImages'],function() {
		Route::get('/{id}','ProductImagesController@index')->name('pro_img.list');
		Route::get('/create/{id}','ProductImagesController@create')->name('pro_img.create');
		Route::post('/store/{id}','ProductImagesController@store')->name('pro_img.store');
		Route::get('/delete/{id_pro}/{id}','ProductImagesController@delete')->name('pro_img.delete');
	});

	Route::group(['prefix'=>'users'],function() {
		Route::get('/','UsersController@index')->name('users.list');
		Route::get('/create','UsersController@create')->name('users.create');
		Route::post('/store','UsersController@store')->name('users.store');
		Route::get('/edit/{id}','UsersController@edit')->name('users.edit');
		Route::post('/update/{id}','UsersController@update')->name('users.update');
		Route::get('/delete/{id}','UsersController@delete')->name('users.delete');
	});

	


});
Route::get('login', 'LoginController@getLogin')->name('login.get');
Route::post('login', 'LoginController@postLogin')->name('login.post');
Route::get('logout','LoginController@Logout')->name('logout');

Route::get('register', 'RegisterController@getRegister')->name('register.get');
Route::post('register', 'RegisterController@postRegister')->name('register.post');
//chuyen tat ca url k co ve trang 404
Route::any('{all?}','HomeController@notfound')->where('all','(.*)');

