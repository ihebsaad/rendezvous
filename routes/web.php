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
// those two routes for the new  contact front
Route::get('/contactv2',function(){return view('contactv2');})->name('contactv2');
Route::post('/contactAdd', 'UsersController@contactv2')->name('contactAdd');
//end contact routes
Route::get('/Facture_Impayee', 'UsersController@Facture_Impayee')->name('Facture_Impayee');
Route::get('/contact', 'UsersController@contact')->name('contact');

Auth::routes();
Route::get('/login', 'UsersController@inscriptionpro')->name('login');
Route::post('login', 'Auth\LoginController@login');



Route::post('/create','Auth\RegisterController@create')->name('create');

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

Route::post('/existanceemail','UsersController@existance_email')->name('existance.email');


//------------------------Stripe-----------------------//


Route::post('/testWebhooks','PaymentStripeController@stripeWebhook')->name('testWebhooks');
Route::get('/ConnectWithStripe','PaymentStripeController@connect')->name('ConnectWithStripe');
Route::get('/reauth','PaymentStripeController@reauth')->name('reauth');

Route::get('/return','PaymentStripeController@return')->name('return');
Route::get('/PayWithStripe/{k}','PaymentStripeController@pay')->name('PayWithStripe');
Route::get('/Pay4WithStripe/{k}','PaymentStripeController@pay4')->name('Pay4WithStripe');

Route::get('/success/pay/{k}','PaymentStripeController@successpayStripe')->name('success.pay');
Route::get('/save/customer','PaymentStripeController@addcustomerStripe')->name('save.customer');
Route::get('/save/customerAbn','PaymentStripeController@addcustomerStripeAbn')->name('save.customerAbn');


Route::get('/reservations.annule/{id}','PaymentStripeController@Remboursement')->name('reservations.annule');
Route::post('/paiement_Abonnement_Mensuel','PaymentStripeController@payabnMensuel')->name('paiement_Abonnement_Mensuel');

Route::post('/payabn','PaymentStripeController@payabnMensuel')->name('payabn');
	Route::get('/payabn','PaymentStripeController@payabnMensuel')->name('payabn');
	
Route::get('/success/payAbn/{k}','PaymentStripeController@successpayAbnStripe')->name('success.payAbn');





//------------------------fin Stripe-----------------------//

$this->post('logout', 'Auth\LoginController@logout')->name('logout');
$this->get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/reservations/newDate/{id}','ReservationsController@newDate')->name('reservations.newDate')->middleware('auth');
Route::get('/reservations/Addnewdate','ReservationsController@Addnewdate')->name('reservations.Addnewdate')->middleware('auth');
Route::get('/reservations/sendnewdate','ReservationsController@sendnewdate')->name('reservations.sendnewdate')->middleware('auth');
Route::get('/reservations/selectdate/{id}','ReservationsController@selectdate')->name('reservations.selectdate')->middleware('auth');

Route::get('/reservations/changeDate','ReservationsController@changeDate')->name('reservations.changeDate')->middleware('auth');
Route::get('/reservations/AnnulerRes','ReservationsController@AnnulerRes')->name('reservations.AnnulerRes')->middleware('auth');

Route::get('/reservations/AnnulerReservation/{id}','ReservationsController@AnnulerReservation')->name('reservations.AnnulerReservation')->middleware('auth');
Route::get('/reservations/modifier/{id}','ReservationsController@modifier')->name('modif')->middleware('auth');
Route::get('/reservations/facture/{id}','InvoiceController@Facture')->name('facture')->middleware('auth');
Route::get('/reservations/reporter','ReservationsController@reporter')->name('reservations.reporter')->middleware('auth');
Route::get('/reservations/deletenewdate','ReservationsController@deletenewdate')->name('reservations.deletenewdate')->middleware('auth');


Route::get('/Statistiques','StatistiqueController@index')->name('Statistiques')->middleware('auth');


Route::get('/Statistiques','StatistiqueController@index2')->name('Statistiques')->middleware('auth');
Route::get('/StatistiquesPro','StatistiqueController@index')->name('StatistiquesPro')->middleware('auth');

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
Route::post('/addService','ServicesController@addService')->name('addService');

Route::get('/', array('as' => 'home','uses' => 'UsersController@home'));
Route::get('/accueil', array('as' => 'accueil','uses' => 'UsersController@accueil'));
Route::get('/pro', array('as' => 'inscription','uses' => 'UsersController@inscriptionpro'));
Route::get('/dashboard', array('as' => 'dashboard','uses' => 'UsersController@dashboard'))->middleware('auth');
Route::get('/monespace', array('as' => 'monespace','uses' => 'UsersController@monespace'))->middleware('auth');

Route::get('/listings', array('as' => 'listings','uses' => 'UsersController@listings'))->middleware('auth');
Route::get('/users', array('as' => 'users','uses' => 'UsersController@index'))->middleware('auth');
Route::get('/Clients', array('as' => 'Clients','uses' => 'UsersController@bindex'))->middleware('auth');
Route::get('/prestataires', 'UsersController@prestataires')->name('prestataires');
Route::get('/Prestataire', 'UsersController@prestatairesPro')->name('Prestataire');
Route::get('/pricing', 'UsersController@pricing')->name('pricing');
Route::get('/abonnements', 'UsersController@abonnements')->name('abonnements');
Route::get('/remerciements', 'UsersController@remerciments')->name('remerciments');
Route::get('/offrelancement', 'UsersController@offrelancement')->name('offrelancement');
Route::get('/offrelancement_mensuel', 'UsersController@offrelancement_mensuel')->name('offrelancement.mensuel');
Route::get('/offre_lancement_mensuel', 'UsersController@offrelancement_annuel')->name('offre_lancement.mensuel');

Route::get('/choixpayement', 'UsersController@choixpayement')->name('choixpayement');
Route::get('/offrelancement_anne2', 'UsersController@OffreLancement_anne2')->name('OffreLancement_anne2');
Route::get('/mail_prestataire_offre_lancement', 'UsersController@envoi_email_aux_prestataires_offre_lancement')->name('mail_prestataire.offre_lancement');


Route::get('/apropos', 'UsersController@apropos')->name('apropos');
Route::get('/faqs', 'UsersController@faqs')->name('faqs');
Route::get('/conditions-utilisation', 'UsersController@ConditionsUtilisation')->name('ConditionsUtilisation');

Route::get('/listings', array('as' => 'listings','uses' => 'UsersController@listings'));
Route::get('/recherche', array('as' => 'recherche','uses' => 'UsersController@pageprestataires'));
Route::post('/recherche', array('as' => 'recherche.prestataires','uses' => 'UsersController@pageprestataires'));
Route::get('/googlecalendar', 'CalendrierController@saveEventGoogleCalendar')->name('googlecalendar')->middleware('auth');
Route::get('/cal.index', 'CalendrierController@index')->name('cal.index');
Route::get('/oauthcallback', 'CalendrierController@oauth')->name('oauthCallback');
//Route::get('/oauthRedirect', 'ReservationsController@oauth')->name('oauthCallback');
Route::get('/enregistrergooglecalendar/{id}', 'CalendrierController@enregistrergooglecalendar')->name('enregistrergooglecalendar')->middleware('auth');

// regle service supplementaires
Route::get('/get_liste_regles_services_suppl/{id}', 'ServicesController@get_liste_regles_services_suppl')->name('liste_regles_services_suppl');


Route::group(['middleware' => 'auth'], function(){

	//changer password page profile

	Route::post('changepassword', 'UsersController@changepassword')->name('change.password')->middleware('auth');;
	Route::post('/changeinfoprofile','UsersController@changeinfoprofile')->name('changeinfoprofile')->middleware('auth');;


	//services  récurrent à abonnement

    Route::get('/servicesrec/annulerPprestataire/{id}','ServicesController@annulerPprestataire')->name('annulerPprestataire')->middleware('auth');;
    Route::get('/servicesrec/annulerPclient/{id}','ServicesController@annulerPclient')->name('annulerPclient')->middleware('auth');;
    Route::get('/servicesrec/accepterPropDates/{id}','ServicesController@accepterPropDates')->name('accepterPropDates')->middleware('auth');;
    Route::get('/servicesrec/insererDatesfinales/','ServicesController@insererDatesfinales')->name('insererDatesfinales')->middleware('auth');; 
    Route::get('/servicesrec/rendezvousTel/','ServicesController@rendezvousTel')->name('rendezvousTel')->middleware('auth');;     
    Route::get('/servicesrec/proposerDates/','ServicesController@proposerDates')->name('proposerDates')->middleware('auth');; 
    
    Route::get('/services/modifier/{id}','ServicesController@servicemodifier')->name('servicemodifier')->middleware('auth');; 

 Route::post('/editService','ServicesController@editService')->name('editService')->middleware('auth');; 


	Route::get('/dashboard', array('as' => 'dashboard','uses' => 'UsersController@dashboard'))->middleware('auth');;
	Route::get('/users', array('as' => 'users','uses' => 'UsersController@index'))->middleware('auth');;
	Route::POST('/produit/clientProduits','UsersController@ClientProd')->name('ProductClient')->middleware('auth');;
	Route::get('/users/changehometext','UsersController@changetext')->name('users.changehometext')->middleware('auth');;
		Route::get('/users/ChangeBoxes','UsersController@ChangeBoxes')->name('users.ChangeBoxes')->middleware('auth');;
		Route::get('/users/ChangeApropos','UsersController@ChangeApropos')->name('users.ChangeApropos')->middleware('auth');;

Route::get('/users/editPlan','UsersController@editPlan')->name('users.editPlan')->middleware('auth');;
Route::get('/users/deleteLine','UsersController@deleteLine')->name('users.deleteLine')->middleware('auth');;

	Route::get('/profile/{id}', 'UsersController@profile')->name('profile')->middleware('auth');;
	Route::get('/listing/{id}', 'UsersController@listing')->name('listing')->middleware('auth');;
	// les pages entreprise
	Route::get('/titredescription/{id}', 'UsersController@titredescription')->name('titredescription')->middleware('auth');;
	Route::get('/portefeuilles/{id}', 'UsersController@portefeuilles')->name('portefeuilles')->middleware('auth');;
	
	Route::post('/changetitredescription','UsersController@changetitredescription')->name('changetitredescription')->middleware('auth');;
	Route::post('/changeInfosContact','UsersController@changeInfosContact')->name('changeInfosContact')->middleware('auth');;
	Route::post('/changeHeuresOuverture','UsersController@changeHeuresOuverture')->name('changeHeuresOuverture')->middleware('auth');;
	Route::get('/emplacement/{id}', 'UsersController@emplacement')->name('emplacement')->middleware('auth');;
	Route::get('/InfosContact/{id}', 'UsersController@InfosContact')->name('InfosContact')->middleware('auth');;
	Route::get('/HoraireOuverture/{id}', 'UsersController@HoraireOuverture')->name('HoraireOuverture')->middleware('auth');;
	Route::get('/Categories/{id}', 'UsersController@Categories')->name('Categories')->middleware('auth');;
	Route::get('/ImagesVideo/{id}', 'UsersController@ImagesVideo')->name('ImagesVideo')->middleware('auth');;
Route::get('/downloadCSV', 'UsersController@downloadCSV')->name('downloadCSV')->middleware('auth');;
Route::get('/downloadCSVday', 'UsersController@downloadCSVday')->name('downloadCSVday')->middleware('auth');;
Route::get('/downloadCSVweek', 'UsersController@downloadCSVweek')->name('downloadCSVweek')->middleware('auth');;
Route::get('/downloadCSVmonth', 'UsersController@downloadCSVmonth')->name('downloadCSVmonth')->middleware('auth');

Route::get('/downloadCSVyear', 'UsersController@downloadCSVyear')->name('downloadCSVyear')->middleware('auth');;


	Route::post('/AjouterService','UsersController@AjouterService')->name('AjouterService')->middleware('auth');;

Route::get('/changeAcompte','UsersController@changeAcompte')->name('changeAcompte')->middleware('auth');;
	
Route::get('/HeuresIndisponibilite/{id}', 'UsersController@HeuresIndisponibilite')->name('HeuresIndisponibilite')->middleware('auth');;
Route::get('/Services/{id}', 'UsersController@Services')->name('Services')->middleware('auth');
Route::post('/clientcheck','UsersController@clientcheck')->name('clientcheck')->middleware('auth');


Route::post('/clientValid','UsersController@clientValid')->name('clientValid')->middleware('auth');

Route::get('/ServicesSupplementaires/{id}', 'UsersController@ServicesSupplementaires')->name('ServicesSupplementaires')->middleware('auth');;
Route::get('/Produits/{id}', 'UsersController@Produits')->name('Produits')->middleware('auth');;
Route::get('/CodesPromo/{id}', 'UsersController@CodesPromo')->name('CodesPromo')->middleware('auth');;

Route::get('/CarteFidelite/{id}', 'UsersController@CarteFidelite')->name('CarteFidelite')->middleware('auth');;
Route::get('/HappyHours/{id}', 'UsersController@HappyHours')->name('HappyHours')->middleware('auth');;
Route::get('/FAQ/{id}', 'UsersController@FAQ')->name('FAQ')->middleware('auth');;
	Route::post('/changeemplacement','UsersController@changeemplacement')->name('changeemplacement')->middleware('auth');;
	Route::post('/changeCategories', 'UsersController@changeCategories')->name('changeCategories')->middleware('auth');;
	//Route::get('/view/{id}', 'UsersController@viewlisting')->name('viewlisting');
	Route::post('/users/updating','UsersController@updating')->name('users.updating')->middleware('auth');
	Route::get('/users/updating','UsersController@updating')->name('users.updating')->middleware('auth');
	Route::post('/users/ajoutimage','UsersController@ajoutimage')->name('users.ajoutimage')->middleware('auth');
	Route::post('/users/ajoutvideo','UsersController@ajoutvideo')->name('users.ajoutvideo')->middleware('auth');
	Route::post('/users/ajoutimages','UsersController@ajoutimages')->name('users.ajoutimages')->middleware('auth');
	Route::post('/users/ajoutcouv','UsersController@ajoutcouv')->name('users.ajoutcouv')->middleware('auth');
	Route::get('/users/removeimage/{id}/{user}', 'UsersController@removeimage')->middleware('auth');
	Route::get('/users/removevideo/{id}', 'UsersController@removevideo')->middleware('auth');
	Route::get('/users/remove/{id}', 'UsersController@remove')->middleware('auth');
	Route::get('/users/destroy/{id}', 'UsersController@destroy')->middleware('auth');
	Route::post('/produit/modif','ServicesController@modifP')->name('produit.modif')->middleware('auth'); 
    Route::post('/produit/store','ServicesController@storeP')->name('produit.store')->middleware('auth');

    Route::get('/services/remove_product/{k}','ServicesController@ProductRemove')->middleware('auth');

	Route::get('/users/productSection','UsersController@SectionProd')->name('users.ProductSection')->middleware('auth');

	Route::get('/users/parametring','UsersController@parametring')->name('users.parametring')->middleware('auth');
	Route::get('/parametres','UsersController@parametres')->name('parametres')->middleware('auth');
	Route::post('/users/ajoutlogo','UsersController@ajoutlogo')->name('users.ajoutlogo')->middleware('auth');
	Route::post('/users/ajoutvideoslider','UsersController@ajoutvideoslider')->name('users.ajoutvideoslider')->middleware('auth');
	Route::post('/users/sendsms','UsersController@sendsms')->name('users.sendsms')->middleware('auth');
	Route::post('/services/saving','ServicesController@store')->name('services.saving')->middleware('auth');
	Route::post('/services/add','ServicesController@add')->name('services.add')->middleware('auth');
	Route::post('/services/store','ServicesController@store')->name('services.store')->middleware('auth');
	Route::get('/services/add','ServicesController@add')->name('services.add')->middleware('auth');
	Route::post('/services/updating','ServicesController@updating')->name('services.updating')->middleware('auth');
	Route::post('/services/modif','ServicesController@modif')->name('services.modif')->middleware('auth'); 
	Route::get('/services/reduction','ServicesController@reductionUpdate')->name('services.reduction')->middleware('auth');
	Route::post('/services/AssociateProd','ServicesController@insertServiceProd')->name('services.AssociateProd')->middleware('auth');

		Route::post('/services/CodePromo','ServicesController@codepromo')->name('services.CodePromo')->middleware('auth');
	Route::post('/services/reduction_CodePromo','ServicesController@CodePromoUpdate')->name('services.reduction_CodePromo')->middleware('auth');
	Route::get('/services/remove_CodePromo/{k}','ServicesController@CodePromoRemove')->middleware('auth');
	Route::post('/services/CodePromoCheck','ServicesController@CodePromoCheck')->name('services.CodePromoCheck')->middleware('auth');
	Route::post('/services/HappyHours','ServicesController@HappyHoursAdd')->name('services.HappyHours')->middleware('auth');
	Route::get('/services/remove_happyhour/{k}','ServicesController@HappyHoursRemove')->middleware('auth');
 
	 
//add associated product
	Route::post('/services/addProdtoService','ServicesController@insertServiceProd')->name('produit.Associate')->middleware('auth');
//remove associated product
	Route::post('/services/removeProduit', 'ServicesController@removeServiceProd')->name('service.removeProd')->middleware('auth');
	
	Route::get('/services/remove/{id}/{user}', 'ServicesController@remove')->middleware('auth');
	Route::post('/enregistrer_regle_services_supp/', 'ServicesController@enregistrer_regle_services_supp')->name('regle_service_suppls')->middleware('auth');
	Route::get('/supprimer_serv_suppl/{id}', 'ServicesController@supprimer_serv_suppl')->name('supprimer_serv_suppl')->middleware('auth');
	

Route::post('/periodes_indisp/store','CalendrierController@store')->name('periodes_indisp.store')->middleware('auth');
Route::get('/periodes_indisp/remove/{id}/{user}', 'CalendrierController@remove')->name('remove_indisp')->middleware('auth');
Route::get('/ouv_fer/{id}', 'CalendrierController@ouverture_fermeture_horaire')->name('ouv_ferm_hor')->middleware('auth');
Route::get('/dragDropCalendar','CalendrierController@dragDropCalendar')->name('dragDropCalendar');



	Route::post('/faqs/saving','FaqsController@store')->name('faqs.saving')->middleware('auth');
	Route::post('/faqs/add','FaqsController@add')->name('faqs.add')->middleware('auth');
	Route::get('/faqs/add','FaqsController@add')->name('faqs.add')->middleware('auth');
	Route::post('/faqs/updating','FaqsController@updating')->name('faqs.updating')->middleware('auth'); 
	Route::get('/faqs/remove/{id}/{user}','FaqsController@remove')->middleware('auth');

	Route::get('/pagefaqs/remove_question_response/{id}', 'FaqsController@remove_question_response')->middleware('auth');
	Route::post('/pagefaqs/store_question_reponse','FaqsController@store_question_reponse')->name('pagefaqs.store_question_reponse')->middleware('auth');
	Route::post('/pagefaqs/update_question_reponse','FaqsController@update_question_reponse')->name('pagefaqs.update_question_reponse')->middleware('auth');


	Route::post('/temoinages/store_temoinage','TemoinagesController@store_temoinage')->name('temoinages.store_temoinage')->middleware('auth');
	Route::get('/temoinages/remove_temoinage/{id}', 'TemoinagesController@remove_temoinage')->middleware('auth');
	Route::post('/temoinages/update_temoinage','TemoinagesController@update_temoinage')->name('temoinages.update_temoinage')->middleware('auth');
	
	Route::post('/temoinagesprest/store_temoinage','TemoinagesPrestController@store_temoinage')->name('temoinagesprest.store_temoinage')->middleware('auth');
	Route::get('/temoinagesprest/remove_temoinage/{id}', 'TemoinagesPrestController@remove_temoinage')->middleware('auth');
	Route::post('/temoinagesprest/update_temoinage','TemoinagesPrestController@update_temoinage')->name('temoinagesprest.update_temoinage')->middleware('auth');
	

	Route::get('/reviews', array('as' => 'reviews','uses' => 'ReviewsController@index'))->middleware('auth');
	Route::get('/reviewsPro', array('as' => 'reviewsPro','uses' => 'ReviewsController@bindex'))->middleware('auth');
	Route::post('/reviews/add','ReviewsController@add')->name('reviews.add')->middleware('auth');
	Route::post('/reviews/remove/{id}','ReviewsController@remove')->name('reviews.remove')->middleware('auth');
	Route::post('/reviews/addfavoris','ReviewsController@addfavoris')->name('reviews.addfavoris')->middleware('auth');
	Route::post('/reviews/removefavoris','ReviewsController@removefavoris')->name('reviews.removefavoris')->middleware('auth');
	Route::post('/reviews/removefavoris','ReviewsController@removefavoris')->name('reviews.removefavoris')->middleware('auth');
	Route::get('/favoris','UsersController@favoris')->name('favoris')->middleware('auth');
	Route::get('/favorisPro','UsersController@favorisPro')->name('favorisPro')->middleware('auth');


	Route::post('/reservations/add','ReservationsController@add')->name('reservations.add')->middleware('auth');
		Route::post('/reservations/add2','ReservationsController@addServiceRecurrent')->name('reservations.add2')->middleware('auth');

	Route::get('/reservations','ReservationsController@index')->name('reservations')->middleware('auth');
	Route::get('/ReservezUnRdv/{id}','ReservationsController@ReservezUnRdv')->name('ReservezUnRdv')->middleware('auth');

	Route::get('/reservations/remove/{id}','ReservationsController@remove')->middleware('auth');
	Route::get('/reservations/valider/{id}','ReservationsController@valider')->name('validation')->middleware('auth');
	Route::get('/reservations/annuler/{id}','ReservationsController@annuler')->name('annul')->middleware('auth');
	Route::post('/reservations/sendmessage','ReservationsController@sendmessage')->name('reservations.sendmessage')->middleware('auth');
	Route::post('/reservations/contactmessage','ReservationsController@contactmessage')->name('reservations.contactmessage')->middleware('auth');


Route::get('/parametre/abonnements','parametreController@abonnements')->name('parametre.abonnements')->middleware('auth');
Route::get('/parametre/ModifierAbonnements/{k}','parametreController@ModifAbonnements')->name('parametre.ModifierAbonnements')->middleware('auth');
Route::get('/parametre/Apropos','parametreController@Apropos')->name('parametre.Apropos')->middleware('auth');
Route::get('/parametre/Fonctionnalites','parametreController@Fonctionnalites')->name('parametre.Fonctionnalites')->middleware('auth');
Route::get('/parametre/LogoBanniere','parametreController@LogoBanniere')->name('parametre.LogoBanniere')->middleware('auth');
Route::get('/parametre/QuestionsReponses','parametreController@QuestionsReponses')->name('parametre.QuestionsReponses')->middleware('auth');

Route::get('/parametre/Temoinages','parametreController@Temoinages')->name('parametre.Temoinages')->middleware('auth');

Route::get('/parametre/TemoinagesClient','parametreController@TemoinagesClient')->name('parametre.TemoinagesClient')->middleware('auth');
Route::get('/parametre/TemoinagesPrestataire','parametreController@TemoinagesPrestataire')->name('parametre.TemoinagesPrestataire')->middleware('auth');


	Route::get('/categories', array('as' => 'categories','uses' => 'CategoriesController@index'))->middleware('auth');
	Route::get('/categoriesPro', array('as' => 'categoriesPro','uses' => 'CategoriesController@bindex'))->middleware('auth');
	Route::get('/AddCategory', array('as' => 'AddCategory','uses' => 'CategoriesController@AddCategory'))->middleware('auth');
	Route::post('/categories/insert','CategoriesController@insert')->name('categories.insert')->middleware('auth');
	Route::post('/categories/add','CategoriesController@add')->name('categories.add')->middleware('auth');
	Route::get('/categories/add','CategoriesController@add')->name('categories.add')->middleware('auth');
	Route::post('/categories/updating','CategoriesController@updating')->name('categories.updating')->middleware('auth'); 
	Route::get('/categories/remove/{id}', 'CategoriesController@remove')->middleware('auth');
	Route::post('/categories/removecatuser', 'CategoriesController@removecatuser')->name('categories.removecatuser')->middleware('auth'); 
	
	Route::post('/categories/Edit','CategoriesController@Edit')->name('categories.Edit')->middleware('auth');
	//
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
	Route::get('/MesAbonnements','AbonnementsController@bindex')->name('MesAbonnements')->middleware('auth');
	Route::get('/abonnements/remove/{id}', 'AbonnementsController@remove')->middleware('auth');
	

	Route::get('/carteFidelite','carteFideliteController@index')->name('carteFidelite')->middleware('auth');
	Route::get('/MesCarteFidelite','carteFideliteController@bindex')->name('MesCarteFidelite')->middleware('auth');

	Route::get('/alertes','AlertesController@index')->name('alertes')->middleware('auth');
	Route::get('/alertes/remove/{id}', 'AlertesController@remove')->middleware('auth');


	Route::get('/payments','PaymentController@index')->name('payments');
	Route::get('/Paiements','PaymentController@bindex')->name('Paiements')->middleware('auth');
	Route::get('/payments/remove/{id}', 'PaymentController@remove');

	Route::get('/googleagenda/{id}','CalendrierController@view')->name('googleagenda')->middleware('auth');
    

//Route::get('/payertranche/{reservation}/{email}/{montant}/{key}', 'MyPaypalController@payertranche')->name('payertranche');
//Route::get('/payertranche/{id}', 'MyPaypalController@payertranchesuccess')->name('payertranchesuccess');

});

Route::post('/savejsonfile','CalendrierController@savejsonfile')->name('savejsonfile')->middleware('auth');
Route::post('/search_prestataires','RechercheController@search_prestataires')->name('search.prestataires');
Route::get('/{slug}/{id}', 'UsersController@viewlisting')->name('viewlisting');
 

Route::group(['middleware'=>['guest']], function(){
//Your routes
Route::get('/payertranche', 'MyPaypalController@payertranche')->name('payertranche');


});