<!--=====HEADER START=======-->
<header>
    <div class="header-area homepage3 header header-sticky d-none d-lg-block" id="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-elements">
                        <div class="site-logo">
                            <a href="{{ url('/') }}"><img src="/img/logo/sunugal-logo.png" alt="Sunugal Habitat"></a>
                        </div>
                        <div class="main-menu">
                            <ul>
                                <li><a href="{{ url('/') }}">Accueil</a></li>
                                <li><a href="{{ url('/#about') }}">Qui sommes-nous ?</a></li>
                                <li><a href="{{ url('/#services') }}">Nos services</a></li>
                                <li><a href="{{ route('products.index') }}">Nos produits</a></li>
                                <li><a href="{{ url('/pages/contact') }}">Contact</a></li>
                            </ul>
                        </div>
                        <div class="btn-area-author">
                            <ul>
                                <li><a href="https://wa.me/221761991908" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-whatsapp"></i></a></li>
                                <li><a href="tel:+221761991908"><i class="fa-solid fa-phone"></i></a></li>
                                <li><a href="mailto:info@sunugalhabitat.sn"><i class="fa-solid fa-envelope"></i></a></li>
                                <li><a href="{{ url('/pages/contact') }}" class="m-0"><i class="fa-solid fa-location-dot"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--=====HEADER END =======-->

<!--===== MOBILE HEADER STARTS =======-->
<div class="mobile-header mobile-haeder3 d-block d-lg-none">
    <div class="container-fluid">
        <div class="col-12">
            <div class="mobile-header-elements">
                <div class="mobile-logo">
                    <a href="{{ url('/') }}"><img src="/img/logo/sunugal-logo.png" alt="Sunugal Habitat"></a>
                </div>
                <div class="mobile-nav-icon dots-menu">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mobile-sidebar mobile-sidebar3">
    <div class="logosicon-area">
        <div class="logos">
            <img src="/img/logo/sunugal-logo.png" alt="Sunugal Habitat">
        </div>
        <div class="menu-close">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
    <div class="mobile-nav mobile-nav1">
        <ul class="mobile-nav-list nav-list1">
            <li><a href="{{ url('/') }}">Accueil</a></li>
            <li><a href="{{ url('/#about') }}">Qui sommes-nous ?</a></li>
            <li><a href="{{ url('/#services') }}">Nos services</a></li>
            <li><a href="{{ route('products.index') }}">Nos produits</a></li>
            <li><a href="{{ url('/pages/contact') }}">Contact</a></li>
        </ul>

        <div class="allmobilesection">
            <a href="https://wa.me/221761991908" target="_blank" rel="noopener noreferrer" class="header-btn3">WhatsApp <span><i class="fa-solid fa-arrow-right"></i></span></a>
            <div class="single-footer">
                <h3>Contact direct</h3>
                <div class="footer1-contact-info">
                    <div class="contact-info-single">
                        <div class="contact-info-icon">
                            <i class="fa-solid fa-phone-volume"></i>
                        </div>
                        <div class="contact-info-text">
                            <a href="tel:+221761991908">76 199 19 08</a>
                        </div>
                    </div>

                    <div class="contact-info-single">
                        <div class="contact-info-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="contact-info-text">
                            <a href="mailto:info@sunugalhabitat.sn">info@sunugalhabitat.sn</a>
                        </div>
                    </div>

                    <div class="single-footer">
                        <h3>Notre adresse</h3>

                        <div class="contact-info-single">
                            <div class="contact-info-icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="contact-info-text">
                                <a href="{{ url('/pages/contact') }}">Dakar Point E en face UCAD</a>
                            </div>
                        </div>
                    </div>

                    <div class="single-footer">
                        <h3>Liens utiles</h3>

                        <div class="social-links-mobile-menu">
                            <ul>
                                <li><a href="https://wa.me/221761991908" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-whatsapp"></i></a></li>
                                <li><a href="mailto:info@sunugalhabitat.sn"><i class="fa-solid fa-envelope"></i></a></li>
                                <li><a href="tel:+221761991908"><i class="fa-solid fa-phone"></i></a></li>
                                <li><a href="{{ url('/pages/contact') }}"><i class="fa-solid fa-location-dot"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--===== MOBILE HEADER ENDS =======-->
