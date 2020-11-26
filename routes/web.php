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
Route::get('/prestatires', 'UsersController@prestatires')->name('prestatires');
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
Route::get('/users/remove/{id}', 'UsersController@remove');
Route::get('/users/destroy/{id}', 'UsersController@destroy');


Route::post('/services/saving','ServicesController@store')->name('services.saving');
Route::post('/services/add','ServicesController@add')->name('services.add');
Route::post('/services/store','ServicesController@store')->name('services.store');
Route::get('/services/add','ServicesController@add')->name('services.add');
Route::post('/services/updating','ServicesController@updating')->name('services.updating'); 
Route::get('/services/remove/{id}/{user}', 'ServicesController@remove');



Route::post('/faqs/saving','FaqsController@store')->name('faqs.saving');
Route::post('/faqs/add','FaqsController@add')->name('faqs.add');
Route::get('/faqs/add','FaqsController@add')->name('faqs.add');
Route::post('/faqs/updating','FaqsController@updating')->name('faqs.updating'); 
Route::get('/faqs/remove/{id}/{user}', 'FaqsController@remove');

Route::get('/reviews', array('as' => 'reviews','uses' => 'ReviewsController@index'));
Route::post('/reviews/add','ReviewsController@add')->name('reviews.add');
Route::post('/reviews/remove/{id}','ReviewsController@remove')->name('reviews.remove');
Route::post('/reviews/addfavoris','ReviewsController@addfavoris')->name('reviews.addfavoris');
Route::post('/reviews/removefavoris','ReviewsController@removefavoris')->name('reviews.removefavoris');
Route::post('/reviews/removefavoris','ReviewsController@removefavoris')->name('reviews.removefavoris');
Route::get('/favoris','UsersController@favoris')->name('favoris');



Route::post('/reservations/add','ReservationsController@add')->name('reservations.add');
Route::get('/reservations','ReservationsController@index')->name('reservations');
Route::get('/reservations/remove/{id}','ReservationsController@remove');




Route::get('/categories', array('as' => 'categories','uses' => 'CategoriesController@index'));
Route::post('/categories/insert','CategoriesController@insert')->name('categories.insert');
Route::post('/categories/add','CategoriesController@add')->name('categories.add');
Route::get('/categories/add','CategoriesController@add')->name('categories.add');
Route::post('/categories/updating','CategoriesController@updating')->name('categories.updating'); 
Route::get('/categories/remove/{id}', 'CategoriesController@remove');
Route::post('/categories/removecatuser', 'CategoriesController@removecatuser')->name('categories.removecatuser'); 


Route::post('/pay','PaymentController@pay')->name('pay');
Route::get('/pay','PaymentController@pay')->name('pay');
Route::post('/paypal','PaymentController@payWithpaypal')->name('paypal');
Route::post('/payreservation','PaymentController@payreservation')->name('payreservation');
Route::get('/payreservation','PaymentController@payreservation')->name('payreservation');
Route::get('/status','PaymentController@getPaymentStatus')->name('status');
Route::get('/statusres','PaymentController@getPaymentStatusRes')->name('statusres');
Route::post('/statusres','PaymentController@getPaymentStatusRes')->name('statusres');

