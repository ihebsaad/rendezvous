@extends('layouts.votreespacelayout')
 
 @section('content')

 <?php 
   use \App\Http\Controllers\UsersController;

  ?>

  <!-- Dashboard -->
<div id="dashboard"> 
@include('layouts.back.bmenu')
<!-- Content
    ================================================== -->
<div class="dashboard-content">
<!-- Titlebar -->
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>Mon entreprise</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Mon entreprise</li>
                            <li>FAQ</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        @if ($live_message = Session::get('ttmessage'))
           <div class="notification success closeable">
                <p>{{ $live_message }}</p>
                <a class="close" href="#"></a>
            </div>
            <?php Session::forget('ttmessage');  ?>
        @endif
        <div class="row">
            <div class="col-lg-12">

                <div id="add-listing">

                    <!-- Section -->
                    <div class="add-listing-section ">
                        
                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3><i class="sl sl-icon-question"></i>FAQ</h3>
                            <!-- Switcher -->
                        </div>

                        <!-- Switcher ON-OFF Content -->

                            <div class="row">
                                <div class="col-md-12">
                                    <table id="pricing-list-container">
                                        <?php $faqs= \App\Faq::where('user',$user->id)->get(); ?>
                                         <?php foreach($faqs as $faq){ ?>
                                        <tr class="pricing-list-item pattern">
                                            <td>
                                                <div class="fm-move"><i class="sl sl-icon-cursor-move"></i></div>
                                                <div class="fm-input pricing-name"><input  type="text" value="<?php echo $faq->question;?>" /></div>
                                                <div class="fm-input pricing-ingredients"><input type="text" value="<?php echo $faq->reponse;?>" /></div>
                                                
                                                <div class="fm-close"><a class="" onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('FaqsController@remove', [ 'id'=>$faq->id,'user'=> $user->id  ])}}"><i class="fa fa-remove"></i></a></div>
                                            </td>
                                        </tr>
                                        <?php } ?>

                                    </table>
                                    <a href="#small-dialog" class="button popup-with-zoom-anim">Ajouter FAQ</a> 
                                </div>
                            </div>

                        
                        <!-- Switcher ON-OFF Content / End -->

                    </div>
                    <!-- Section / End -->


                </div>
            </div>
        </div>
<!-- Content end
    ================================================== -->
</div>
</div>


      <div id="small-dialog" class="small-dialog zoom-anim-dialog mfp-hide">
          <div class="small-dialog-header">
            <h3>Ajouter FAQ </h3>
          </div>
           <form  method="post"  action="{{ route('faqs.add') }}"  >
      {{ csrf_field() }}
            <div class="utf_signin_form style_one">
            <input name="user" value="{{$user->id}}" hidden>

              <div class="fm-input ">
                <input type="text" placeholder="Question" name="question" id="question">
              </div>
                 <div class="fm-input  ">
                   <textarea   placeholder="Réponse" name="reponse" id="reponse"></textarea>
                 </div>
     
                 <input type="submit" id="addfaq" style="text-align:center;color:white;" value="Ajouter"></input>    
            </div> 
            </form>       
         </div> 
@endsection('content')