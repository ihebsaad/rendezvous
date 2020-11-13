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

/*
Route::get('/', function () {
    return view('home');
});
*/
Auth::routes();


$this->post('logout', 'Auth\LoginController@logout')->name('logout');
$this->get('logout', 'Auth\LoginController@logout')->name('logout');


/*
Route::get('/dashboard', function () {
    return view('dashboard');
});
*/
Route::get('/', array('as' => 'home','uses' => 'UsersController@home'));
Route::get('/dashboard', array('as' => 'dashboard','uses' => 'UsersController@dashboard'));
Route::get('/listings', array('as' => 'listings','uses' => 'UsersController@listings'));
Route::get('/users', array('as' => 'users','uses' => 'UsersController@index'));
Route::get('/perstataires', 'UsersController@perstataires')->name('perstataires');
Route::get('/profile/{id}', 'UsersController@profile')->name('profile');
Route::get('/listing/{id}', 'UsersController@listing')->name('listing');
Route::get('/view/{id}', 'UsersController@viewlisting')->name('viewlisting');
Route::post('/users/updating','UsersController@updating')->name('users.updating');
Route::post('/users/ajoutimage','UsersController@ajoutimage')->name('users.ajoutimage');
Route::post('/users/ajoutvideo','UsersController@ajoutvideo')->name('users.ajoutvideo');
Route::post('/users/ajoutimages','UsersController@ajoutimages')->name('users.ajoutimages');
Route::post('/users/ajoutcouv','UsersController@ajoutcouv')->name('users.ajoutcouv');
Route::get('/users/removeimage/{id}/{user}', 'UsersController@removeimage');
Route::get('/users/removevideo/{id}', 'UsersController@removevideo');


Route::post('/services/saving','ServicesController@store')->name('services.saving');
Route::post('/services/add','ServicesController@add')->name('services.add');
Route::get('/services/add','ServicesController@add')->name('services.add');
Route::post('/services/updating','ServicesController@updating')->name('services.updating'); 
Route::get('/services/remove/{id}/{user}', 'ServicesController@remove');



Route::post('/faqs/saving','FaqsController@store')->name('faqs.saving');
Route::post('/faqs/add','FaqsController@add')->name('faqs.add');
Route::get('/faqs/add','FaqsController@add')->name('faqs.add');
Route::post('/faqs/updating','FaqsController@updating')->name('faqs.updating'); 
Route::get('/faqs/remove/{id}/{user}', 'FaqsController@remove');




Route::get('/categories', array('as' => 'categories','uses' => 'CategoriesController@index'));
Route::post('/categories/insert','CategoriesController@insert')->name('categories.insert');
Route::post('/categories/add','CategoriesController@add')->name('categories.add');
Route::get('/categories/add','CategoriesController@add')->name('categories.add');
Route::post('/categories/updating','CategoriesController@updating')->name('categories.updating'); 
Route::get('/categories/remove/{id}', 'CategoriesController@remove');
Route::post('/categories/removecatuser', 'CategoriesController@removecatuser')->name('categories.removecatuser'); 

