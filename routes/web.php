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

Route::get('/', function () {
    return view('welcome');
   
});

Route::get('/mppp', function () {
    return view('./layouts/cltviews/MapView');
   
});





Route::get('/map1', 'MapController@index');


//Route::group(['middleware' => ['auth']], function() {
    // your routes


Route::prefix('admin')->group(function(){
    Route::get('/',function(){
        return view('./layouts/adminview/master');
    });
 Route::get('/users', 'Auth\RegisterController@index');

 Route::post('/users/delete','Auth\RegisterController@delete'  )->name('admin/users/delete');

 Route::post('/users/update','Auth\RegisterController@update')->name('admin/users/editUser');

 Route::post('/users/add','Auth\RegisterController@registerAdmin')->name('admin/users/addadmin');

 Route::get('/restaurants','RestaurantController@index')->name('admin/restaurants');

 Route::post('/restaurants/ajout','RestaurantController@store')->name('ajout_restaurant');

 Route::post('/restaurants/update','RestaurantController@update')->name('edit_restaurant');
 Route::post('/restaurants/delete','RestaurantController@destroy')->name('delete_restaurant');
 Route::get('/categories' ,'CategorieController@index')->name('get_liste_categorie');
 Route::post('/categorie/add' ,'CategorieController@store')->name('add_categorie');
  Route::post('/categorie/edit' ,'CategorieController@update')->name('edit_categorie');
   Route::post('/categorie/delete' ,'CategorieController@destroy')->name('delete_categorie');
   Route::get('/foods' ,'Food_Controller@index')->name('get_list_foods');
    Route::get('/foud/list' ,'Food_Controller@get_categorie')->name('get_list_categorie');
 Route::get('/dashbord',function(){
    return view('layouts.adminview.dashborad');
 })->name('dashbord');
   
});

//});

Route::get('/map', function(){
    $config = array();
    $config['center'] = 'New York, USA';
    GMaps::initialize($config);
    $map = GMaps::create_map();

    echo $map['js'];
    echo $map['html'];
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




