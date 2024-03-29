<div id="bottomNav">
    {{ $mnuList = $mnuMyContact = $mnuOffer = $mnuUser = ""  }}

    {{ $islogined = ""  }}

    @if (request()->is('list*'))
    @php $mnuList = "active" @endphp
    @elseif (request()->is('contacts*'))
    @php $mnuMyContact = "active" @endphp
    @elseif (request()->is('offer*'))
    @php $mnuOffer = "active" @endphp
    @endif


    <a href="{{ route('list') }}" class="">
        <div class="menu-item {{  $mnuList }}" >
                <i class="glyphicon glyphicon glyphicon-search"></i><br>Search
        </div>
    </a>
    
    @guest
        <a href="#" data-toggle="modal" data-target="#loginModal">
            <div class="menu-item">
                    <i class="glyphicon glyphicon glyphicon-credit-card"></i><br>My Contacts
            </div>
        </a>
        <a href="#" data-toggle="modal" data-target="#loginModal">
            <div class="menu-item">
                    <i class="glyphicon glyphicon glyphicon-gift"></i><br> Offers
            </div>
        </a>
        <a href="#" data-toggle="modal" data-target="#loginModal">
            <div class="menu-item">
                    <i class="glyphicon glyphicon glyphicon-user"></i><br>LOGIN
            </div>
        </a>
    @else
        @php $islogined = "loggedIn" @endphp
        <a href="{{ route('contacts') }}">
            <div class="menu-item {{  $mnuMyContact }}">
                    <i class="glyphicon glyphicon glyphicon-credit-card"></i><br>My Contacts
            </div>
        </a>
        <a href="{{ route('contacts') }}">
            <div class="menu-item {{  $mnuOffer }}">
                    <i class="glyphicon glyphicon glyphicon-gift"></i><br> Offers
            </div>
        </a>
        <a href="#" data-toggle="slide-collapse" data-target="#bs-example-navbar-collapse-1">
            <div class="menu-item ">
                    <i class="glyphicon glyphicon-align-justify"></i><br> Menu
            </div>
        </a>
    @endguest
</div>

<div id="footer-bottom" class="{{ $islogined }}">
    <div class="container">
        <footer >
            <div class="row">
                <div class="col-lg-8 col-xs-8">

                    <div class="links">
                        <a href="{{ route('about-us') }}" class="link">About</a>
                        <a href="{{ route('features') }}" class="link">Features</a>
                        <a href="{{ route('privacy-terms') }}" class="link">Privacy &amp; Terms</a>
                        <a href="{{ route('contact-us') }}" class="link">Contact Us</a>
                        

                    </div>

                    <div class="copyright">
                        Copyright &copy; <?php echo date("Y"); ?>. <a href="http://cardbiz.in/" target="_blank">CardBiz.in</a>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="social-icon pull-right">
                      <a href="https://www.facebook.com/CardBiz-110220843802525" title="facebook" target="_BLANK">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                      </a>
                      
                      
                      <a href="https://www.instagram.com/cardbiz.in" title="Instagram" target="_BLANK">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                      </a>

                      <a href="https://www.linkedin.com/company/31333728/admin/" title="Linked In" target="_BLANK">
                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                      </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<?php
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    //echo $this->element('sql_dump');
}
?>