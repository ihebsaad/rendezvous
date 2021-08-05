  
 <?php     $user = auth()->user();

// $User =\App\User::find($user->id);
  $user_type =$user->user_type;
 ?>

 <!-- Responsive Navigation Trigger -->
  <a href="#" class="dashboard-responsive-nav-trigger"><i class="fa fa-reorder"></i> Menu</a>

  <div class="dashboard-nav">
    <div class="dashboard-nav-inner">

      <ul data-submenu-title="Essentiel">
        <li  class="<?php if ($view_name == 'monespace'){echo 'active';} ?> "><a href="{{ route('monespace') }}"><i class="sl sl-icon-home"></i> Mon espace</a></li>
        <li class="<?php if ($view_name == 'reservations-index'){echo 'active';} ?>  "><a href="{{ route('reservations') }}"><i class="fa fa-calendar-check-o"></i> Réservations</a></li>

    <?php if($user_type=='admin'){ ?> 

          <li class="<?php if ($view_name == 'users-index'){echo 'active';} ?> "><a href="{{ route('users') }}"><i class="sl sl-icon-people"></i> Clients </a></li>       
          <li class="<?php if ($view_name == 'users-prestatires'){echo 'active';} ?>  "><a href="{{ route('prestataires') }}"><i class="sl sl-icon-briefcase"></i> Prestataires </a></li> 
          <li class="<?php if ($view_name == 'categories-index'){echo 'active';} ?>  "><a href="{{ route('categories') }}"><i class="sl sl-icon-tag"></i> Catégories </a></li>       
          <li class="<?php if ($view_name == 'abonnements-index'){echo 'active';} ?>  "><a href="{{ route('abonnements')}}"><i class="sl sl-icon-folder-alt"></i> Abonnements </a></li>      
          <li><a href="dashboard-wallet.html"><i class="sl sl-icon-wallet"></i> Wallet</a></li>

          </ul>
          <ul data-submenu-title="Mon compte">
            <li class="<?php if ($view_name == 'parametres'){echo 'active';} ?>  "><a href="{{ route('parametres') }}"><i class="sl sl-icon-equalizer"></i> Paramètres </a>
                <ul>
                  <li><a href="dashboard-my-listings.html">Abonnements <span class="nav-tag green">6</span></a></li>
                  <li><a href="dashboard-my-listings.html">Logo et banniére <span class="nav-tag yellow">1</span></a></li>
                  <li><a href="dashboard-my-listings.html">Témoinages <span class="nav-tag red">2</span></a></li>
                  <li><a href="dashboard-my-listings.html">Boxes des fonctionnalités <span class="nav-tag red">2</span></a></li>
                  <li><a href="dashboard-my-listings.html">Contenus de à propos <span class="nav-tag red">2</span></a></li>
                  <li><a href="dashboard-my-listings.html">Questions / réponses <span class="nav-tag red">2</span></a></li>
                </ul> 
            </li>  
            <li><a  href="{{ route('profile' , ['id'=>$user->id] ) }}"><i class="sl sl-icon-user"></i> Mon profil</a></li>
            <li><a href="{{ route('logout') }}"><i class="sl sl-icon-power"></i> Déconnexion</a></li>
          </ul>

    <?php } ?> 

    <?php if( $user_type=='client'  ){ ?> 

      <li class="<?php if ($view_name == 'reviews-index'){echo 'active';} ?>  "><a href="{{ route('favoris')}}"><i class="sl sl-icon-heart"></i> Mes Favoris </a></li>
      <li class="<?php if ($view_name == 'carteFidelite-index'){echo 'active';} ?>  "><a href="{{ route('carteFidelite')}}"><i class="sl sl-icon-present"></i> Mes cartes de fidélité </a></li>
      <li class="<?php if ($view_name == 'payments-index'){echo 'active';} ?>  "><a href="{{ route('payments')}}"><i class="sl sl-icon-wallet"></i> Paiements </a></li> 
      </ul>
      <ul data-submenu-title="Mon compte">
        <li><a  href="{{ route('profile' , ['id'=>$user->id] ) }}"><i class="sl sl-icon-user"></i> Mon profil</a></li>
        <li><a href="{{ route('logout') }}"><i class="sl sl-icon-power"></i> Déconnexion</a></li>
      </ul>

    <?php } ?> 

    <?php if( $user_type=='prestataire'  ){ ?>    
  
      <li class="<?php if ($view_name == 'notes-index'){echo 'active';} ?>  "><a href="{{ route('reviews')}}"><i class="sl sl-icon-star"></i> Avis </a></li>       
      <li class="<?php if ($view_name == 'abonnements-index'){echo 'active';} ?>  "><a href="{{ route('abonnements')}}"><i class="sl sl-icon-folder-alt"></i> Abonnements </a></li> 
       <?php if(($user->type_abonn_essai && $user->type_abonn_essai=="type3" ) || ($user->type_abonn &&  $user->type_abonn=="type3" )) {  ?>
      <li class="<?php if ($view_name == 'googlecalendar-index'){echo 'active';} ?>  "><a href="{{ route('googleagenda',['id'=>$user->id]) }}"><i class="sl sl-icon-notebook"></i> Google Agenda </a></li> 
       <?php } ?>
      <?php if(($user->type_abonn_essai && ($user->type_abonn_essai=="type2" || $user->type_abonn_essai=="type3" ))|| ($user->type_abonn && ($user->type_abonn=="type2" || $user->type_abonn=="type3" ))) { ?>  
       <li class="<?php if ($view_name == 'statistiques'){echo 'active';} ?>  "><a href="{{ route('Statistiques') }}"><i class="sl sl-icon-chart"></i> Statistiques </a></li> 
           <?php } ?> 
      <li><a href="dashboard-wallet.html"><i class="sl sl-icon-wallet"></i> Portefeuille</a></li>

      </ul>
      <ul data-submenu-title="Mon compte">
        <li class="<?php if ($view_name == 'users-listing'){echo 'active';} ?>  "><a href="# {{-- route('listing', ['id'=>$user->id]) --}}"><i class="sl sl-icon-briefcase"></i> Mon Entreprise </a>
            <ul>
              <li><a href="dashboard-my-listings.html">Titre & Description</a></li>
              <li><a href="dashboard-my-listings.html">Emplacement</a></li>
              <li><a href="dashboard-my-listings.html">Infos de contact</a></li>
              <li><a href="dashboard-my-listings.html">Catégories</a></li>
              <li><a href="dashboard-my-listings.html">Images & vidéo</a></li>
              <li><a href="dashboard-my-listings.html">Horaire d'ouverture</a></li>
              <li><a href="dashboard-my-listings.html">Calendrier & Heures d'indisponibilité</a></li>
              <li><a href="dashboard-my-listings.html">Services</a></li>
              <li><a href="dashboard-my-listings.html">Services Supplémentaires</a></li>
              <li><a href="dashboard-my-listings.html">Produits</a></li>
              <li><a href="dashboard-my-listings.html">Codes promo</a></li>
              <li><a href="dashboard-my-listings.html">Carte de fidélité</a></li>
              <li><a href="dashboard-my-listings.html">Happy hours</a></li>
              <li><a href="dashboard-my-listings.html">FAQ</a></li>
            </ul> 
        </li> 
        <li><a  href="{{ route('profile' , ['id'=>$user->id] ) }}"><i class="sl sl-icon-user"></i> Mon profil</a></li>
        <li><a href="{{ route('logout') }}"><i class="sl sl-icon-power"></i> Déconnexion</a></li>
      </ul>
    <?php } ?>
      
    </div>
  </div>
  <!-- Navigation / End -->