<?php 
 $parametres=DB::table('parametres')->where('id', 1)->first();

 $apropos=$parametres->apropos_footer;?> 

 <!-- Footer
================================================== -->
<div id="footer">
    <!-- Main -->
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <img src="<?php //echo  URL::asset('storage/images/'.$plogo);?><?php echo  URL::asset('storage/images/logoprvb.png');?>" alt="">
                <br><br>
                <p style="    text-align: justify;"><?php echo $apropos;?></p>
            </div>
            <div class="col-md-1" ></div>
                       <div class="col-md-4 col-sm-6 " style="
    width: fit-content;
">
                <h4>Liens</h4>
                <ul class="footer-links">
                    <li><a href="{{route('home')}}">Accueil</a></li>
                    <li><a href="{{route('apropos')}}">A Propos</a></li>
                    <li><a href="{{route('ConditionsUtilisation')}}" style="    width: 216px;">Conditions d'utilisation</a></li>
                    <li><a href="{{route('contactv2')}}">Contact</a></li>
                </ul>
                
                <div class="clearfix"></div>
            </div>      

			<div class="col-md-3  col-sm-12" style="
    width: fit-content;">
                <h4>Compte</h4>
                <ul class="footer-links">
                    <!--<li><a href="{{-- route('pricing') --}}">Abonnements</a></li>  -->     
                    @guest 
             
                    <li><a style=" width: 275px; "class="aa" href="{{route('inscriptionclient')}}" >Vous êtes prestataire de service ?</a></li>
                    <li><a class="" href="{{route('inscription')}}" style="    width: 136px;">Je suis un client</a></li> 
                    @else
                    <li><a  href="{{route('logout')}}"  >Déconnexion</a></li> 
                    @endguest
                </ul>
            </div>
            <!--<div class="col-md-3  col-sm-12">
                <h4>Contact Us</h4>
                <div class="text-widget">
                    <span>12345 Little Lonsdale St, Melbourne</span> <br>
                    Phone: <span>(123) 123-456 </span><br>
                    E-Mail:<span> <a href="#">office@example.com</a> </span><br>
                </div>

                <ul class="social-icons margin-top-20">
                    <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
                    <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
                    <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
                    <li><a class="vimeo" href="#"><i class="icon-vimeo"></i></a></li>
                </ul>

            </div>-->

        </div>
        
        <!-- Copyright -->
        <div class="row">
            <div class="col-md-12">
                <div class="copyrights">Copyright © <?php echo date("Y"); ?> Tous droits réservés - par <a href="https://enterpriseesolutions.com/">Enterprise eSolutions</a></div>
            </div>
        </div>

    </div>

</div>
<!-- Footer / End -->
