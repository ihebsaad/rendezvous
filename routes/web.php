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
Route::get('/prestataires', 'UsersController@prestataires')->name('prestataires');
Route::get('/pricing', 'UsersController@pricing')->name('pricing');
Route::get('/abonnements', 'UsersController@abonnements')->name('abonnements');
Route::get('/contact', 'UsersController@contact')->name('contact');
Route::get('/apropos', 'UsersController@apropos')->name('apropos');
Route::get('/faqs', 'UsersController@faqs')->name('faqs');
Route::get('/conditions-utilisation', 'UsersController@ConditionsUtilisation')->name('ConditionsUtilisation');

Route::get('/listings', array('as' => 'listings','uses' => 'UsersController@listings'));
Route::get('/googlecalendar', 'CalendrierController@saveEventGoogleCalendar')->name('googlecalendar');
Route::get('/cal.index', 'CalendrierController@index')->name('cal.index');
Route::get('/oauthcallback', 'CalendrierController@oauth')->name('oauthCallback');
//Route::get('/oauthRedirect', 'ReservationsController@oauth')->name('oauthCallback');
Route::get('/enregistrergooglecalendar/{id}', 'CalendrierController@enregistrergooglecalendar')->name('enregistrergooglecalendar');


Route::group(['middleware' => 'auth'], function(){

	Route::get('/dashboard', array('as' => 'dashboard','uses' => 'UsersController@dashboard'));
	Route::get('/users', array('as' => 'users','uses' => 'UsersController@index'));

	Route::get('/profile/{id}', 'UsersController@profile')->name('profile');
	Route::get('/listing/{id}', 'UsersController@listing')->name('listing');
	//Route::get('/view/{id}', 'UsersController@viewlisting')->name('viewlisting');
	Route::post('/users/updating','UsersController@updating')->name('users.updating');
	Route::post('/users/ajoutimage','UsersController@ajoutimage')->name('users.ajoutimage');
	Route::post('/users/ajoutvideo','UsersController@ajoutvideo')->name('users.ajoutvideo');
	Route::post('/users/ajoutimages','UsersController@ajoutimages')->name('users.ajoutimages');
	Route::post('/users/ajoutcouv','UsersController@ajoutcouv')->name('users.ajoutcouv');
	Route::get('/users/removeimage/{id}/{user}', 'UsersController@removeimage');
	Route::get('/users/removevideo/{id}', 'UsersController@removevideo');
	Route::get('/users/remove/{id}', 'UsersController@remove');
	Route::get('/users/destroy/{id}', 'UsersController@destroy');

	Route::post('/users/parametring','UsersController@parametring')->name('users.parametring');
	Route::get('/parametres','UsersController@parametres')->name('parametres');
	Route::post('/users/ajoutlogo','UsersController@ajoutlogo')->name('users.ajoutlogo');
	Route::post('/users/ajoutvideoslider','UsersController@ajoutvideoslider')->name('users.ajoutvideoslider');
	Route::post('/users/sendsms','UsersController@sendsms')->name('users.sendsms');
	Route::post('/services/saving','ServicesController@store')->name('services.saving');
	Route::post('/services/add','ServicesController@add')->name('services.add');
	Route::post('/services/store','ServicesController@store')->name('services.store');
	Route::get('/services/add','ServicesController@add')->name('services.add');
	Route::post('/services/updating','ServicesController@updating')->name('services.updating');
	Route::post('/services/modif','ServicesController@modif')->name('services.modif'); 
	Route::post('/services/reduction','ServicesController@reductionUpdate')->name('services.reduction');

		Route::post('/services/CodePromo','ServicesController@codepromo')->name('services.CodePromo');
	Route::post('/services/reduction_CodePromo','ServicesController@CodePromoUpdate')->name('services.reduction_CodePromo');
	Route::get('/services/remove_CodePromo/{k}','ServicesController@CodePromoRemove');
	Route::post('/services/CodePromoCheck','ServicesController@CodePromoCheck')->name('services.CodePromoCheck');
	Route::post('/services/HappyHours','ServicesController@HappyHoursAdd')->name('services.HappyHours');
	Route::get('/services/remove_happyhour/{k}','ServicesController@HappyHoursRemove');

       

 
	Route::get('/services/remove/{id}/{user}', 'ServicesController@remove');

Route::post('/periodes_indisp/store','CalendrierController@store')->name('periodes_indisp.store');
Route::get('/periodes_indisp/remove/{id}/{user}', 'CalendrierController@remove');
Route::get('/ouv_fer/{id}', 'CalendrierController@ouverture_fermeture_horaire');


	Route::post('/faqs/saving','FaqsController@store')->name('faqs.saving');
	Route::post('/faqs/add','FaqsController@add')->name('faqs.add');
	Route::get('/faqs/add','FaqsController@add')->name('faqs.add');
	Route::post('/faqs/updating','FaqsController@updating')->name('faqs.updating'); 
	Route::get('/faqs/remove/{id}/{user}','FaqsController@remove');

	Route::get('/pagefaqs/remove_question_response/{id}', 'FaqsController@remove_question_response');
	Route::post('/pagefaqs/store_question_reponse','FaqsController@store_question_reponse')->name('pagefaqs.store_question_reponse');
	Route::post('/pagefaqs/update_question_reponse','FaqsController@update_question_reponse')->name('pagefaqs.update_question_reponse');
	
	

	Route::get('/reviews', array('as' => 'reviews','uses' => 'ReviewsController@index'));
	Route::post('/reviews/add','ReviewsController@add')->name('reviews.add');
	Route::post('/reviews/remove/{id}','ReviewsController@remove')->name('reviews.remove');
	Route::post('/reviews/addfavoris','ReviewsController@addfavoris')->name('reviews.addfavoris');
	Route::post('/reviews/removefavoris','ReviewsController@removefavoris')->name('reviews.removefavoris');
	Route::post('/reviews/removefavoris','ReviewsController@removefavoris')->name('reviews.removefavoris');
	Route::get('/favoris','UsersController@favoris')->name('favoris');


	Route::post('/reservations/add','ReservationsController@add')->name('reservations.add');
		Route::post('/reservations/add2','ReservationsController@addServiceRecurrent')->name('reservations.add2');

	Route::get('/reservations','ReservationsController@index')->name('reservations');
	Route::get('/reservations/remove/{id}','ReservationsController@remove');
	Route::get('/reservations/valider/{id}','ReservationsController@valider')->name('validation');
	Route::get('/reservations/annuler/{id}','ReservationsController@annuler');
	Route::post('/reservations/sendmessage','ReservationsController@sendmessage')->name('reservations.sendmessage');
	Route::post('/reservations/contactmessage','ReservationsController@contactmessage')->name('reservations.contactmessage');



	Route::get('/categories', array('as' => 'categories','uses' => 'CategoriesController@index'));
	Route::post('/categories/insert','CategoriesController@insert')->name('categories.insert');
	Route::post('/categories/add','CategoriesController@add')->name('categories.add');
	Route::get('/categories/add','CategoriesController@add')->name('categories.add');
	Route::post('/categories/updating','CategoriesController@updating')->name('categories.updating'); 
	Route::get('/categories/remove/{id}', 'CategoriesController@remove');
	Route::post('/categories/removecatuser', 'CategoriesController@removecatuser')->name('categories.removecatuser'); 

	Route::post('/payabn','PaymentController@payabn')->name('payabn');
	Route::get('/payabn','PaymentController@payabn')->name('payabn');
	Route::get('/statusabn','PaymentCodntroller@getPaymentStatusAbn')->name('statusabn');
 Route::get('/statusplan','PaymentController@statusplan')->name('statusplan');


	Route::post('/pay','PaymentController@pay')->name('pay');
	Route::get('/pay','PaymentController@pay')->name('pay');
	Route::post('/paypal','PaymentController@payWithpaypal')->name('paypal');
  Route::post('/createplan','PaymentController@createplan')->name('createplan'); 
	Route::get('/payreservation','PayPalController@payAcompteReservation')->name('payreservation');
    Route::post('/payreservation','PayPalController@payAcompteReservation')->name('payreservation');
    Route::get('/successPayAcompteReservation','PayPalController@successPay');


        Route::get('/check/paypal','PaypalController@CheckEmail')->name('check.paypal');


	Route::get('/status','PaymentController@getPaymentStatus')->name('status');
	Route::get('/statusres','PaymentController@getPaymentStatusRes')->name('statusres');
	Route::post('/statusres','PaymentController@getPaymentStatusRes')->name('statusres');


	Route::get('/abonnements','AbonnementsController@index')->name('abonnements');
	Route::get('/abonnements/remove/{id}', 'AbonnementsController@remove');
	

	Route::get('/carteFidelite','carteFideliteController@index')->name('carteFidelite');


	Route::get('/alertes','AlertesController@index')->name('alertes');
	Route::get('/alertes/remove/{id}', 'AlertesController@remove');


	Route::get('/payments','PaymentController@index')->name('payments');
	Route::get('/payments/remove/{id}', 'PaymentController@remove');

	Route::get('/googleagenda/{id}','CalendrierController@view')->name('googleagenda');
    


});

Route::post('/savejsonfile','CalendrierController@savejsonfile')->name('savejsonfile');
Route::post('/search_prestataires','RechercheController@search_prestataires')->name('search.prestataires');
Route::get('/{slug}/{id}', 'UsersController@viewlisting')->name('viewlisting');