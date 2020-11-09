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
    return view('home');
});

Auth::routes();


$this->post('logout', 'Auth\LoginController@logout')->name('logout');
$this->get('logout', 'Auth\LoginController@logout')->name('logout');


/*
Route::get('/dashboard', function () {
    return view('dashboard');
});
*/
Route::get('/dashboard', array('as' => 'dashboard','uses' => 'UsersController@dashboard'));
Route::get('/users', array('as' => 'users','uses' => 'UsersController@index'));
Route::get('/perstataires', 'UsersController@perstataires')->name('perstataires');
Route::get('/profile/{id}', 'UsersController@profile')->name('profile');
Route::get('/listing/{id}', 'UsersController@listing')->name('listing');
Route::post('/users/updating','UsersController@updating')->name('users.updating');


Route::post('/services/saving','ServicesController@store')->name('services.saving');
Route::post('/services/add','ServicesController@add')->name('services.add');
Route::get('/services/add','ServicesController@add')->name('services.add');
Route::post('/services/updating','ServicesController@updating')->name('services.updating'); 
Route::get('/services/remove/{id}', 'ServicesController@remove');


Route::get('/categories', array('as' => 'categories','uses' => 'CategoriesController@index'));
Route::post('/categories/insert','CategoriesController@insert')->name('categories.insert');
Route::post('/categories/add','CategoriesController@add')->name('categories.add');
Route::get('/categories/add','CategoriesController@add')->name('categories.add');
Route::post('/categories/updating','CategoriesController@updating')->name('categories.updating'); 
Route::get('/categories/remove/{id}', 'CategoriesController@remove');
Route::post('/categories/removecatuser', 'CategoriesController@removecatuser')->name('categories.removecatuser'); 

