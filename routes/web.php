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
Route::get('/testpaypal','PaymentController@createplan')->name('testrdsq');
Route::get('/statusplan','PaymentController@statusplan')->name('statusplan');

	Route::get('/testr','PaymentController@okk')->name('testr');
	Route::get('/payreservation','PaymentController@payreservationwithemail')->name('payreservation');
		Route::post('/payreservation','PaymentController@payreservationwithemail')->name('payreservation');

		Route::get('/statuspayreservationwithemail','PaymentController@statuspayreservationwithemail')->name('statuspayreservationwithemail');
			Route::get('/cancelpay','MyPaypalController@cancelpay')->name('cancelpay');
						Route::get('/statusagreement','PaymentController@statusagreement')->name('statusagreement');
Route::get('/successpay2','PaymentController@successpay2')->name('successpay2');
	Route::get('/cancelpay2','MyPaypalController@cancelpay2')->name('cancelpay2');




//------------------------Stripe-----------------------//



Route::get('/ConnectWithStripe','PaymentStripeController@connect')->name('ConnectWithStripe');
Route::get('/reauth','PaymentStripeController@reauth')->name('reauth');

Route::get('/return','PaymentStripeController@return')->name('return');
Route::get('/PayWithStripe/{k}','PaymentStripeController@pay')->name('PayWithStripe');
Route::get('/Pay4WithStripe/{k}','PaymentStripeController@pay4')->name('Pay4WithStripe');

Route::get('/success/pay/{k}','PaymentStripeController@successpayStripe')->name('success.pay');
Route::get('/save/customer','PaymentStripeController@addcustomerStripe')->name('save.customer');

Route::get('/reservations.annule/{id}','PaymentStripeController@Remboursement')->name('reservations.annule');


Route::post('/payabn','PaymentStripeController@payabn')->name('payabn');
	Route::get('/payabn','PaymentStripeController@payabn')->name('payabn');
	
Route::get('/success/payAbn/{k}','PaymentStripeController@successpayAbnStripe')->name('success.payAbn');





//------------------------fin Stripe-----------------------//

$this->post('logout', 'Auth\LoginController@logout')->name('logout');
$this->get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/reservations/newDate/{id}','ReservationsController@newDate')->name('reservations.newDate');
Route::get('/reservations/Addnewdate','ReservationsController@Addnewdate')->name('reservations.Addnewdate');
Route::get('/reservations/sendnewdate','ReservationsController@sendnewdate')->name('reservations.sendnewdate');
Route::get('/reservations/selectdate/{id}','ReservationsController@selectdate')->name('reservations.selectdate');
Route::get('/reservations/changeDate','ReservationsController@changeDate')->name('reservations.changeDate');
Route::get('/reservations/AnnulerRes','ReservationsController@AnnulerRes')->name('reservations.AnnulerRes');

Route::get('/reservations/AnnulerReservation/{id}','ReservationsController@AnnulerReservation')->name('reservations.AnnulerReservation');
Route::get('/reservations/modifier/{id}','ReservationsController@modifier')->name('modif');
Route::get('/reservations/facture/{id}','InvoiceController@Facture')->name('facture');
Route::get('/reservations/reporter','ReservationsController@reporter')->name('reservations.reporter');
Route::get('/reservations/deletenewdate','ReservationsController@deletenewdate')->name('reservations.deletenewdate');


Route::get('/Statistiques','StatistiqueController@index')->name('Statistiques');



Route::get('/ok', function () {
    return view('statistiques');
});
/*
Route::get('/dashboard', function () {
Route::get('/test', function () {
    return view('dashboard');
});
*/
Route::get('/test',function(){return view('test');});
Route::get('/test',function(){return view('Invoice.index');});
Route::post('/users/Firstservice','UsersController@FirstService')->name('users.FirstService');

Route::get('/inscription', array('as' => 'inscriptionclient','uses' => 'UsersController@inscriptionClient'));

Route::get('/comingsoon', array('as' => 'comingsoon','uses' => 'UsersController@comingsoon'));
Route::post('/users/addemail','UsersController@addemail')->name('users.addemail');


Route::get('/', array('as' => 'home','uses' => 'UsersController@home'));
Route::get('/accueil', array('as' => 'accueil','uses' => 'UsersController@accueil'));
Route::get('/pro', array('as' => 'inscription','uses' => 'UsersController@inscriptionpro'));
Route::get('/dashboard', array('as' => 'dashboard','uses' => 'UsersController@dashboard'));
Route::get('/listings', array('as' => 'listings','uses' => 'UsersController@listings'));
Route::get('/users', array('as' => 'users','uses' => 'UsersController@index'));
Route::get('/prestataires', 'UsersController@prestataires')->name('prestataires');
Route::get('/pricing', 'UsersController@pricing')->name('pricing');
Route::get('/abonnements', 'UsersController@abonnements')->name('abonnements');
Route::get('/offrelancement', 'UsersController@offrelancement')->name('offrelancement');
Route::get('/offrelancement_anne2', 'UsersController@OffreLancement_anne2')->name('OffreLancement_anne2');


Route::get('/contact', 'UsersController@contact')->name('contact');
Route::get('/apropos', 'UsersController@apropos')->name('apropos');
Route::get('/faqs', 'UsersController@faqs')->name('faqs');
Route::get('/conditions-utilisation', 'UsersController@ConditionsUtilisation')->name('ConditionsUtilisation');

Route::get('/listings', array('as' => 'listings','uses' => 'UsersController@listings'));
Route::get('/recherche', array('as' => 'recherche','uses' => 'UsersController@pageprestataires'));
Route::get('/googlecalendar', 'CalendrierController@saveEventGoogleCalendar')->name('googlecalendar');
Route::get('/cal.index', 'CalendrierController@index')->name('cal.index');
Route::get('/oauthcallback', 'CalendrierController@oauth')->name('oauthCallback');
//Route::get('/oauthRedirect', 'ReservationsController@oauth')->name('oauthCallback');
Route::get('/enregistrergooglecalendar/{id}', 'CalendrierController@enregistrergooglecalendar')->name('enregistrergooglecalendar');

// regle service supplementaires
Route::get('/get_liste_regles_services_suppl/{id}', 'ServicesController@get_liste_regles_services_suppl')->name('liste_regles_services_suppl');


Route::group(['middleware' => 'auth'], function(){

	//services  récurrent à abonnement

    Route::get('/servicesrec/annulerPprestataire/{id}','ServicesController@annulerPprestataire')->name('annulerPprestataire');
    Route::get('/servicesrec/annulerPclient/{id}','ServicesController@annulerPclient')->name('annulerPclient');
    Route::get('/servicesrec/accepterPropDates/{id}','ServicesController@accepterPropDates')->name('accepterPropDates');
    Route::post('/servicesrec/insererDatesfinales/','ServicesController@insererDatesfinales')->name('insererDatesfinales'); 
    Route::post('/servicesrec/rendezvousTel/','ServicesController@rendezvousTel')->name('rendezvousTel');     
    Route::post('/servicesrec/proposerDates/','ServicesController@proposerDates')->name('proposerDates'); 
    




	Route::get('/dashboard', array('as' => 'dashboard','uses' => 'UsersController@dashboard'));
	Route::get('/users', array('as' => 'users','uses' => 'UsersController@index'));
	Route::POST('/produit/clientProduits','UsersController@ClientProd')->name('ProductClient');
	Route::POST('/users/changehometext','UsersController@changetext')->name('users.changehometext');
		Route::POST('/users/ChangeBoxes','UsersController@ChangeBoxes')->name('users.ChangeBoxes');
		Route::POST('/users/ChangeApropos','UsersController@ChangeApropos')->name('users.ChangeApropos');

Route::get('/users/editPlan','UsersController@editPlan')->name('users.editPlan');
Route::get('/users/deleteLine','UsersController@deleteLine')->name('users.deleteLine');

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
	Route::post('/produit/modif','ServicesController@modifP')->name('produit.modif'); 
    Route::post('/produit/store','ServicesController@storeP')->name('produit.store');

    Route::get('/services/remove_product/{k}','ServicesController@ProductRemove');

	Route::post('/users/productSection','UsersController@SectionProd')->name('users.ProductSection');

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
	Route::post('/services/AssociateProd','ServicesController@insertServiceProd')->name('services.AssociateProd');

		Route::post('/services/CodePromo','ServicesController@codepromo')->name('services.CodePromo');
	Route::post('/services/reduction_CodePromo','ServicesController@CodePromoUpdate')->name('services.reduction_CodePromo');
	Route::get('/services/remove_CodePromo/{k}','ServicesController@CodePromoRemove');
	Route::post('/services/CodePromoCheck','ServicesController@CodePromoCheck')->name('services.CodePromoCheck');
	Route::post('/services/HappyHours','ServicesController@HappyHoursAdd')->name('services.HappyHours');
	Route::get('/services/remove_happyhour/{k}','ServicesController@HappyHoursRemove');
 
	 
//add associated product
	Route::post('/services/addProdtoService','ServicesController@insertServiceProd')->name('produit.Associate');
//remove associated product
	Route::post('/services/removeProduit', 'ServicesController@removeServiceProd')->name('service.removeProd');
	
	Route::get('/services/remove/{id}/{user}', 'ServicesController@remove');
	Route::post('/enregistrer_regle_services_supp/', 'ServicesController@enregistrer_regle_services_supp')->name('regle_service_suppls');
	Route::get('/supprimer_serv_suppl/{id}', 'ServicesController@supprimer_serv_suppl')->name('supprimer_serv_suppl');
	

Route::post('/periodes_indisp/store','CalendrierController@store')->name('periodes_indisp.store');
Route::get('/periodes_indisp/remove/{id}/{user}', 'CalendrierController@remove')->name('remove_indisp');
Route::get('/ouv_fer/{id}', 'CalendrierController@ouverture_fermeture_horaire')->name('ouv_ferm_hor');


	Route::post('/faqs/saving','FaqsController@store')->name('faqs.saving');
	Route::post('/faqs/add','FaqsController@add')->name('faqs.add');
	Route::get('/faqs/add','FaqsController@add')->name('faqs.add');
	Route::post('/faqs/updating','FaqsController@updating')->name('faqs.updating'); 
	Route::get('/faqs/remove/{id}/{user}','FaqsController@remove');

	Route::get('/pagefaqs/remove_question_response/{id}', 'FaqsController@remove_question_response');
	Route::post('/pagefaqs/store_question_reponse','FaqsController@store_question_reponse')->name('pagefaqs.store_question_reponse');
	Route::post('/pagefaqs/update_question_reponse','FaqsController@update_question_reponse')->name('pagefaqs.update_question_reponse');


	Route::post('/temoinages/store_temoinage','TemoinagesController@store_temoinage')->name('temoinages.store_temoinage');
	Route::get('/temoinages/remove_temoinage/{id}', 'TemoinagesController@remove_temoinage');
	Route::post('/temoinages/update_temoinage','TemoinagesController@update_temoinage')->name('temoinages.update_temoinage');
	
	Route::post('/temoinagesprest/store_temoinage','TemoinagesPrestController@store_temoinage')->name('temoinagesprest.store_temoinage');
	Route::get('/temoinagesprest/remove_temoinage/{id}', 'TemoinagesPrestController@remove_temoinage');
	Route::post('/temoinagesprest/update_temoinage','TemoinagesPrestController@update_temoinage')->name('temoinagesprest.update_temoinage');
	

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
	Route::get('/reservations/annuler/{id}','ReservationsController@annuler')->name('annul');
	Route::post('/reservations/sendmessage','ReservationsController@sendmessage')->name('reservations.sendmessage');
	Route::post('/reservations/contactmessage','ReservationsController@contactmessage')->name('reservations.contactmessage');



	Route::get('/categories', array('as' => 'categories','uses' => 'CategoriesController@index'));
	Route::post('/categories/insert','CategoriesController@insert')->name('categories.insert');
	Route::post('/categories/add','CategoriesController@add')->name('categories.add');
	Route::get('/categories/add','CategoriesController@add')->name('categories.add');
	Route::post('/categories/updating','CategoriesController@updating')->name('categories.updating'); 
	Route::get('/categories/remove/{id}', 'CategoriesController@remove');
	Route::post('/categories/removecatuser', 'CategoriesController@removecatuser')->name('categories.removecatuser'); 
	
	Route::post('/categories/Edit','CategoriesController@Edit')->name('categories.Edit');
	//Route::post('/payabn','PaymentController@payabn')->name('payabn');
	//Route::get('/payabn','PaymentController@payabn')->name('payabn');
	Route::get('/statusabn','PaymentController@getPaymentStatusAbn')->name('statusabn');
// Route::get('/statusplan','PaymentController@statusplan')->name('statusplan');


	Route::post('/pay','PaymentController@pay')->name('pay');
	Route::get('/pay','PaymentController@pay')->name('pay');
	Route::post('/paypal','PaymentController@payWithpaypal')->name('paypal');
 // Route::post('/createplan','PaymentController@createplan')->name('createplan');
//	Route::get('/payreservation','PaymentController@payreservation')->name('payreservation');
 //   Route::post('/payreservation','PaymentController@payreservation')->name('payreservation');

    //Route::post('/payreservation','MyPaypalController@payReservation')->name('payreservation');
   // Route::get('/successPayAcompteReservation','PayPalController@successPay');
    Route::get('/check/paypal','MyPaypalController@CheckEmail')->name('check.paypal');

		
	Route::get('/status','PaymentController@getPaymentStatus')->name('status');
	Route::get('/statusres','PaymentController@getPaymentStatusRes')->name('statusres');
	Route::post('/statusres','PaymentController@getPaymentStatusRes')->name('statusres');

	
	Route::get('/cancelpay','MyPaypalController@cancelpay')->name('cancelpay');
	
	
	 Route::get('/preapproved','MyPaypalController@preapproved')->name('preapproved');
	 Route::get('/approved','MyPaypalController@approved')->name('approved');
	 Route::get('/canceled','MyPaypalController@canceled')->name('canceled');
     Route::get('/getpreapproved','MyPaypalController@getpreapproved')->name('getpreapproved');
    Route::post('/getpreapproved','MyPaypalController@getpreapproved')->name('getpreapproved');
	
	Route::get('/notification','MyPaypalController@notification')->name('notification');
	
	

	Route::get('/abonnements','AbonnementsController@index')->name('abonnements');
	Route::get('/abonnements/remove/{id}', 'AbonnementsController@remove');
	

	Route::get('/carteFidelite','carteFideliteController@index')->name('carteFidelite');


	Route::get('/alertes','AlertesController@index')->name('alertes');
	Route::get('/alertes/remove/{id}', 'AlertesController@remove');


	Route::get('/payments','PaymentController@index')->name('payments');
	Route::get('/payments/remove/{id}', 'PaymentController@remove');

	Route::get('/googleagenda/{id}','CalendrierController@view')->name('googleagenda');
    

//Route::get('/payertranche/{reservation}/{email}/{montant}/{key}', 'MyPaypalController@payertranche')->name('payertranche');
//Route::get('/payertranche/{id}', 'MyPaypalController@payertranchesuccess')->name('payertranchesuccess');

});

Route::post('/savejsonfile','CalendrierController@savejsonfile')->name('savejsonfile');
Route::post('/search_prestataires','RechercheController@search_prestataires')->name('search.prestataires');
Route::get('/{slug}/{id}', 'UsersController@viewlisting')->name('viewlisting');
 

Route::group(['middleware'=>['guest']], function(){
//Your routes
Route::get('/payertranche', 'MyPaypalController@payertranche')->name('payertranche');


});