@extends('layouts.landing')

@section('body_attribute', 'sunugal-home-body')
@section('meta_title', 'Sunugal Habitat | Agence immobiliere a Dakar Point E')
@section('meta_description', 'Sunugal Habitat, agence immobiliere a Dakar Point E. Gestion locative, syndic de copropriete, vente et achat avec une equipe de proximite, reactive et transparente.')
@section('meta_canonical', route('home'))
@section('meta_image', asset('img/all-images/hero/hero-img6.png'))
@section('schema')
  @php
    $organizationSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'RealEstateAgent',
        'name' => 'Sunugal Habitat',
        'url' => route('home'),
        'image' => asset('img/logo/sunugal-logo.jpeg'),
        'logo' => asset('img/logo/sunugal-logo.jpeg'),
        'telephone' => '+221781644156',
        'email' => 'contact@sunugalhabitat.sn',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'Point E en face UCAD',
            'addressLocality' => 'Dakar',
            'addressCountry' => 'SN',
        ],
        'areaServed' => 'Dakar',
        'description' => 'Agence immobiliere a Dakar Point E specialisee en gestion locative, syndic de copropriete, vente et achat.',
        'sameAs' => [
            'https://wa.me/221781644156',
        ],
    ];

    $websiteSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => 'Sunugal Habitat',
        'url' => route('home'),
        'inLanguage' => 'fr-SN',
    ];

    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'name' => 'Services immobiliers Sunugal Habitat',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Gestion locative',
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Syndic de copropriete',
            ],
            [
                '@type' => 'ListItem',
                'position' => 3,
                'name' => 'Vente et achat',
            ],
            [
                '@type' => 'ListItem',
                'position' => 4,
                'name' => 'Suivi local',
            ],
        ],
    ];
  @endphp
  <script type="application/ld+json">@json($organizationSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)</script>
  <script type="application/ld+json">@json($websiteSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)</script>
  <script type="application/ld+json">@json($serviceSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)</script>
@endsection

@section('content')
  <!-- ===== HERO AREA STARTS ======= -->
  <div class="header-carousel-area3 owl-carousel">
    <div class="main-hero-area">
      <div class="img1">
        <img src="/img/all-images/hero/hero-img6.png" alt="" />
      </div>
      <div class="bg-elements">
        <img src="/img/elements/elements7.png" alt="" class="elements2" />
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-5 col-md-9">
            <div class="header-content-area header-heading">
              <div class="elements">
                <img src="/img/elements/elements3.png" alt="" />
              </div>
              <div class="header-heading2">
                <h5><i class="fa-solid fa-location-dot"></i>Dakar Point E</h5>
                <div class="space20"></div>
                <h2>Sunugal Habitat, votre gestion locative de proximite</h2>
                <div class="space20"></div>
                <p>
                  Nous trouvons le locataire, nous encaissons, puis nous vous versons vos loyers.
                  Vous gardez le controle, nous gerons le quotidien.
                </p>
                <div class="space32"></div>
                <div class="btn-area1">
                  <a href="{{ url('/pages/contact') }}" class="header-btn3">Nous contacter</a>
                  <a href="https://wa.me/221781644156" target="_blank" rel="noopener noreferrer">
                    <span class="play-btn"><i class="fa-brands fa-whatsapp"></i></span>
                    <span class="text">WhatsApp</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-2"></div>
          <div class="col-lg-4">
            <div class="auhtor-box">
              <div class="others-box">
                <div class="img3">
                  <img src="/img/logo/sunugal-logo-cropped.jpeg" alt="Sunugal Habitat" />
                </div>
                <div class="text">
                  <h3>Rassidou Sow</h3>
                  <div class="space10"></div>
                  <p>Agent Immobilier Agree</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="main-hero-area">
      <div class="img1">
        <img src="/img/all-images/hero/hero-img5.png" alt="" />
      </div>
      <div class="bg-elements">
        <img src="/img/elements/elements7.png" alt="" class="elements2" />
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-5 col-md-9">
            <div class="header-content-area header-heading">
              <div class="elements">
                <img src="/img/elements/elements3.png" alt="" />
              </div>
              <div class="header-heading2">
                <h5><i class="fa-solid fa-location-dot"></i>En face UCAD</h5>
                <div class="space20"></div>
                <h2>Un syndic de copropriete clair, reactif et present</h2>
                <div class="space20"></div>
                <p>
                  Charges, travaux, suivi de l'immeuble et coordination du quotidien:
                  nous organisons la copropriete avec des comptes-rendus simples et utiles.
                </p>
                <div class="space32"></div>
                <div class="btn-area1">
                  <a href="{{ url('/#services') }}" class="header-btn3">Voir nos services</a>
                  <a href="{{ url('/pages/contact') }}">
                    <span class="play-btn"><i class="fa-solid fa-phone"></i></span>
                    <span class="text">Contact</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-2"></div>
          <div class="col-lg-4">
            <div class="auhtor-box">
              <div class="others-box">
                <div class="img3">
                  <img src="/img/all-images/others/others-img1.png" alt="" />
                </div>
                <div class="text">
                  <h3>Point E, Dakar</h3>
                  <div class="space10"></div>
                  <p>Compte-rendu mensuel + photos</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="main-hero-area">
      <div class="img1">
        <img src="/img/all-images/hero/hero-img1.png" alt="" />
      </div>
      <div class="bg-elements">
        <img src="/img/elements/elements7.png" alt="" class="elements2" />
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-5 col-md-9">
            <div class="header-content-area header-heading">
              <div class="elements">
                <img src="/img/elements/elements3.png" alt="" />
              </div>
              <div class="header-heading2">
                <h5><i class="fa-solid fa-location-dot"></i>Sunugal Habitat</h5>
                <div class="space20"></div>
                <h2>Vente & achat avec estimation juste et securite juridique</h2>
                <div class="space20"></div>
                <p>
                  Nous pilotons les visites qualifiees, la negociation et la securisation des dossiers
                  pour que chaque transaction avance sans surprise.
                </p>
                <div class="space32"></div>
                <div class="btn-area1">
                  <a href="{{ url('/#why-us') }}" class="header-btn3">Pourquoi nous choisir ?</a>
                  <a href="mailto:contact@sunugalhabitat.sn">
                    <span class="play-btn"><i class="fa-solid fa-envelope"></i></span>
                    <span class="text">Email</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-2"></div>
          <div class="col-lg-4">
            <div class="auhtor-box">
              <div class="others-box">
                <div class="img3">
                  <img src="/img/all-images/others/others-img3.png" alt="" />
                </div>
                <div class="text">
                  <h3>Mandat clair</h3>
                  <div class="space10"></div>
                  <p>Commission juste, pas de surprise</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ===== HERO AREA ENDS ======= -->

  <!-- ===== ABOUT AREA STARTS ======= -->
  <div class="property3-section-area sp6" id="about">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="property-images-area">
            <div class="img1 reveal image-anime">
              <img src="/img/all-images/property/property-img4.png" alt="" />
            </div>
            <div class="img2 reveal image-anime">
              <img src="/img/all-images/property/property-img5.png" alt="" />
            </div>
            <div class="elements reveal image-anime">
              <img src="/img/elements/elements9.png" alt="" />
            </div>
          </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-5">
          <div class="property-content heading3">
            <h5 data-aos="fade-left" data-aos-duration="800">Qui sommes-nous ?</h5>
            <div class="space20"></div>
            <h2 class="text-anime-style-3">Votre partenaire immobilier de proximite au Point E</h2>
            <div class="space16"></div>
            <p data-aos="fade-left" data-aos-duration="900">
              Sunugal Habitat est enraciné a Dakar et gere votre bien comme si c'etait le notre.
              Nous intervenons avec une approche simple: presence locale, execution rapide et communication claire.
            </p>
            <div class="space16"></div>
            <p data-aos="fade-left" data-aos-duration="1000">
              Que ce soit pour un appartement, un immeuble ou une transaction, nous restons votre interlocuteur
              unique pour faire avancer les choses proprement et sans stress.
            </p>
            <div class="space32"></div>
            <div class="btn-area1" data-aos="fade-left" data-aos-duration="1200">
              <a href="{{ url('/pages/contact') }}" class="header-btn4">Parler de mon bien</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ===== ABOUT AREA ENDS ======= -->

  <!-- ===== SERVICE AREA STARTS ======= -->
  <div class="service3-section-area sp1" id="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 m-auto">
          <div class="heading3 text-center space-margin60">
            <h5 data-aos="fade-left" data-aos-duration="800">Nos services</h5>
            <div class="space20"></div>
            <h2 class="text-anime-style-3">Quatre leviers, un seul partenaire de confiance</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6" data-aos="zoom-in-up" data-aos-duration="800">
          <div class="amenities-boxarea">
            <div class="img1">
              <img src="/img/all-images/service/service-img4.png" alt="" />
            </div>
            <div class="space32"></div>
            <div class="content-area">
              <a href="{{ url('/pages/contact') }}">Gestion locative</a>
              <div class="space18"></div>
              <p>On trouve le locataire, on encaisse et on vous verse. Zero stress.</p>
              <h3>01</h3>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6" data-aos="zoom-in-up" data-aos-duration="1000">
          <div class="space40 d-lg-block d-none"></div>
          <div class="amenities-boxarea">
            <div class="img1">
              <img src="/img/all-images/service/service-img5.png" alt="" />
            </div>
            <div class="space32"></div>
            <div class="content-area">
              <a href="{{ url('/pages/contact') }}">Syndic de copropriete</a>
              <div class="space18"></div>
              <p>Nous gerons votre immeuble, les charges et le suivi des travaux.</p>
              <h3>02</h3>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6" data-aos="zoom-in-up" data-aos-duration="1100">
          <div class="amenities-boxarea">
            <div class="img1">
              <img src="/img/all-images/service/service-img7.png" alt="" />
            </div>
            <div class="space32"></div>
            <div class="content-area">
              <a href="{{ url('/pages/contact') }}">Vente & achat</a>
              <div class="space18"></div>
              <p>Estimation juste, visites qualifiees et securite juridique.</p>
              <h3>03</h3>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6" data-aos="zoom-in-up" data-aos-duration="1200">
          <div class="space40 d-lg-block d-none"></div>
          <div class="amenities-boxarea">
            <div class="img1">
              <img src="/img/all-images/service/service-img8.png" alt="" />
            </div>
            <div class="space32"></div>
            <div class="content-area">
              <a href="{{ url('/pages/contact') }}">Suivi local</a>
              <div class="space18"></div>
              <p>Compte-rendu mensuel, photos et interlocuteur present a Point E.</p>
              <h3>04</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ===== SERVICE AREA ENDS ======= -->

  <!-- ===== PRODUCTS AREA STARTS ======= -->
  <div class="apartment-inner2-section-area sp7 bg2 sunugal-products-section" id="products">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 m-auto">
          <div class="heading3 text-center space-margin60">
            <h5 data-aos="fade-left" data-aos-duration="800">Nos produits</h5>
            <div class="space20"></div>
            <h2 class="text-anime-style-3">Une selection de biens a explorer</h2>
          </div>
        </div>
      </div>
      <div class="row gy-4">
        @foreach ($products as $product)
          <div class="col-lg-3 col-md-6" data-aos="zoom-in-up" data-aos-duration="{{ 800 + ($loop->index * 100) }}">
            <div class="apartment-boxarea product-card">
              <div class="img1">
                <img src="{{ $product['card_image'] }}" alt="{{ $product['title'] }}" />
              </div>
              <div class="content-area">
                <a href="{{ route('products.show', $product['slug']) }}">{{ $product['title'] }}</a>
                <div class="space16"></div>
                <ul>
                  <li>
                    <a href="#"><img src="/img/icons/bed-icon1.svg" alt="" />{{ $product['beds'] }}</a> <span>|</span>
                  </li>
                  <li>
                    <a href="#"><img src="/img/icons/bat-icon1.svg" alt="" />{{ $product['baths'] }}</a> <span>|</span>
                  </li>
                  <li>
                    <a href="#"><img src="/img/icons/squre-icon1.svg" alt="" />{{ $product['surface'] }}</a>
                  </li>
                </ul>
                <div class="space16"></div>
                <p>{{ $product['location'] }}</p>
              </div>
              <div class="arrow">
                <a href="{{ route('products.show', $product['slug']) }}">Voir</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="space40"></div>
      <div class="row">
        <div class="col-lg-12 text-center">
          <a href="{{ route('products.index') }}" class="header-btn4">Voir tous les produits</a>
        </div>
      </div>
    </div>
  </div>
  <!-- ===== PRODUCTS AREA ENDS ======= -->

  <!-- ===== TRUST AREA STARTS ======= -->
  <div class="about3-section-area sp6">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 m-auto">
          <div class="about-header text-center heading3 space-margin60">
            <h5 data-aos="fade-left" data-aos-duration="800">Enracines dans la confiance</h5>
            <div class="space20"></div>
            <h2 class="text-anime-style-3">Une presence locale au service de votre patrimoine</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="about-slider-area owl-carousel">
            <div class="img1 reveal image-anime">
              <img src="/img/all-images/about/about-img3.png" alt="" />
            </div>
            <div class="img1 reveal image-anime">
              <img src="/img/all-images/about/about-img3.png" alt="" />
            </div>
            <div class="img1 reveal image-anime">
              <img src="/img/all-images/about/about-img3.png" alt="" />
            </div>
          </div>
          <div class="space30"></div>
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="experience-box">
                <h2>Point E</h2>
                <div class="space12"></div>
                <p>Une equipe ancree a Dakar</p>
                <div class="space20"></div>
                <img src="/img/all-images/about/about-img6.png" alt="" />
                <div class="space18"></div>
                <p>Suivi local et reactivite terrain</p>
              </div>
              <div class="space30 d-md-none d-block"></div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="about-video-area">
                <div class="img1 image-anime reveal">
                  <a href="https://wa.me/221781644156" target="_blank" rel="noopener noreferrer"><img src="/img/all-images/about/about-img5.png" alt="" /></a>
                </div>
                <div class="play-btn">
                  <a href="https://wa.me/221781644156" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="space30 d-lg-none d-block"></div>
          <div class="about-widget-images">
            <div class="img1 reveal image-anime">
              <img src="/img/all-images/about/about-img4.png" alt="" />
            </div>
            <div class="content-area">
              <div class="text">
                <a href="{{ url('/pages/contact') }}">Sunugal Habitat</a>
                <div class="space20"></div>
                <ul>
                  <li>
                    <a href="#"><img src="/img/icons/bed-icon1.svg" alt="" /> Point E</a> <span>|</span>
                  </li>
                  <li>
                    <a href="#"><img src="/img/icons/bat-icon1.svg" alt="" /> Reactif</a> <span>|</span>
                  </li>
                  <li>
                    <a href="#"><img src="/img/icons/squre-icon1.svg" alt="" /> Transparent</a>
                  </li>
                </ul>
              </div>
              <div class="arrow">
                <a href="{{ url('/pages/contact') }}"><i class="fa-solid fa-arrow-right"></i></a>
              </div>
            </div>
            <div class="elements3">
              <img src="/img/elements/elements3.png" alt="" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ===== TRUST AREA ENDS ======= -->

  <!-- ===== LOCAL AREA STARTS ======= -->
  <div class="gallery3-section-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 m-auto">
          <div class="gallery-header heading2 text-center">
            <h5 data-aos="fade-left" data-aos-duration="800">Dakar Point E</h5>
            <div class="space20"></div>
            <h2 class="text-anime-style-3">Une agence proche de vos biens et de vos decisions</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="rotate-img-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 m-auto">
          <div class="rotate-img">
            <img src="/img/all-images/gallery/gallery-img14.png" alt="" />
            <img src="/img/elements/elements3.png" alt="" class="elements3" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="space100 d-lg-block d-none"></div>
  <div class="space50 d-lg-none d-block"></div>
  <!-- ===== LOCAL AREA ENDS ======= -->

  <!-- ===== WHY US AREA STARTS ======= -->
  <div class="testimonial3-section-area sp6" id="why-us">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="testimonia-header heading3">
            <h5 data-aos="fade-left" data-aos-duration="800">Pourquoi nous choisir ?</h5>
            <div class="space20"></div>
            <h2 class="text-anime-style-3">Reactivite, transparence et confiance</h2>
            <div class="space16"></div>
            <p data-aos="fade-left" data-aos-duration="1000">
              Nous sommes a Point E, pas a distance. Vous recevez un suivi clair, un mandat lisible
              et une relation de travail construite sur des engagements simples.
            </p>
            <div class="space32"></div>
            <div class="btn-area1" data-aos="fade-left" data-aos-duration="1200">
              <a href="{{ url('/pages/contact') }}" class="header-btn4">Nous joindre</a>
            </div>
          </div>
          <div class="space86"></div>
          <div class="testimonial-video-area" data-aos="zoom-in-up" data-aos-duration="1000">
            <div class="img1">
              <img src="/img/all-images/testimonial/testimonial-img3.png" alt="" />
            </div>
            <div class="icons">
              <a href="https://wa.me/221781644156" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-6">
          <div class="testimonial-arrow-area" data-aos="zoom-in-up" data-aos-duration="1000">
            <div class="testimonial3-vertical-slider">
              <div class="testimonial-vertical">
                <div class="verical-boxarea">
                  <div class="images-area">
                    <div class="img1">
                      <img src="/img/all-images/testimonial/testimonial-img4.png" alt="" />
                    </div>
                    <div class="text">
                      <a href="#">Reactivite</a>
                      <p>Point E, Dakar</p>
                    </div>
                  </div>
                  <div class="quito">
                    <img src="/img/icons/quoto-icon2.svg" alt="" />
                  </div>
                </div>
                <div class="space24"></div>
                <span>Une equipe locale, joignable et presente.</span>
                <div class="space16"></div>
                <p>Nous suivons les situations rapidement parce que nous sommes sur place, au plus proche de vos biens et de vos locataires.</p>
                <div class="space24"></div>
                <ul>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                </ul>
              </div>

              <div class="testimonial-vertical">
                <div class="verical-boxarea">
                  <div class="images-area">
                    <div class="img1">
                      <img src="/img/all-images/testimonial/testimonial-img5.png" alt="" />
                    </div>
                    <div class="text">
                      <a href="#">Transparence</a>
                      <p>Suivi mensuel</p>
                    </div>
                  </div>
                  <div class="quito">
                    <img src="/img/icons/quoto-icon2.svg" alt="" />
                  </div>
                </div>
                <div class="space24"></div>
                <span>Compte-rendu clair et photos de suivi.</span>
                <div class="space16"></div>
                <p>Vous savez ce qui a ete fait, ce qui reste a faire et comment avance la gestion de votre bien, sans zone d'ombre.</p>
                <div class="space24"></div>
                <ul>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                </ul>
              </div>

              <div class="testimonial-vertical">
                <div class="verical-boxarea">
                  <div class="images-area">
                    <div class="img1">
                      <img src="/img/all-images/testimonial/testimonial-img4.png" alt="" />
                    </div>
                    <div class="text">
                      <a href="#">Confiance</a>
                      <p>Mandat clair</p>
                    </div>
                  </div>
                  <div class="quito">
                    <img src="/img/icons/quoto-icon2.svg" alt="" />
                  </div>
                </div>
                <div class="space24"></div>
                <span>Commission juste, cadre propre, pas de surprise.</span>
                <div class="space16"></div>
                <p>Nous clarifions les engagements, la remuneration et les etapes de mission des le debut pour securiser la relation.</p>
                <div class="space24"></div>
                <ul>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                  <li><i class="fa-solid fa-star"></i></li>
                </ul>
              </div>
            </div>
            <div class="testimonial-arrows">
              <div class="testimonial-prev-arrow">
                <button><i class="fa-solid fa-angle-up"></i></button>
              </div>
              <div class="testimonial-next-arrow">
                <button><i class="fa-solid fa-angle-down"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ===== WHY US AREA ENDS ======= -->

  <!-- ===== CTA AREA STARTS ======= -->
  <div class="others3-section-area sp5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-5">
          <div class="images-area">
            <div class="img1 image-anime reveal">
              <img src="/img/all-images/others/others-img11.png" alt="" />
            </div>
            <div class="img2 image-anime reveal">
              <img src="/img/all-images/others/others-img12.png" alt="" />
            </div>
            <div class="elements">
              <img src="/img/elements/elements8.png" alt="" />
            </div>
          </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-5">
          <div class="others-header heading3">
            <h5 data-aos="fade-left" data-aos-duration="800">Contact</h5>
            <div class="space20"></div>
            <h2 class="text-anime-style-3">Parlons de votre bien des aujourd'hui</h2>
            <div class="space16"></div>
            <p data-aos="fade-left" data-aos-duration="1000">
              Une question, un projet de gestion, de syndic ou de transaction ?
              Contactez-nous et nous vous repondrons rapidement depuis notre bureau de Point E.
            </p>
            <div class="space24"></div>
            <div class="btn-area1" data-aos="fade-left" data-aos-duration="1200">
              <a href="{{ url('/pages/contact') }}" class="header-btn3">Nous contacter</a>
              <a href="https://wa.me/221781644156" target="_blank" rel="noopener noreferrer">
                <span class="play-btn"><i class="fa-brands fa-whatsapp"></i></span>
                <span class="text">78 164 41 56</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ===== CTA AREA ENDS ======= -->

  <!-- ===== BLOG AREA STARTS ======= -->
  <div class="blog3-section-area sp7">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 m-auto">
          <div class="blog-header text-center heading3 space-margin60">
            <h5 data-aos="fade-left" data-aos-duration="800">Nos engagements</h5>
            <div class="space20"></div>
            <h2 class="text-anime-style-3">Ce que vous pouvez attendre de nous</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-duration="800">
          <div class="blog-boxarea">
            <div class="img1 image-anime">
              <img src="/img/all-images/blog/blog-img1.png" alt="" />
            </div>
            <div class="content-area">
              <ul>
                <li><a href="#"><img src="/img/icons/user.svg" alt="" /> Sunugal Habitat</a> <span>|</span></li>
                <li><a href="#"><img src="/img/icons/calender.svg" alt="" /> Point E</a></li>
              </ul>
              <div class="space20"></div>
              <a href="{{ url('/pages/contact') }}">Un mandat clair et une commission juste, sans surprise.</a>
              <div class="space24"></div>
              <a href="{{ url('/pages/contact') }}" class="readmore">En savoir plus <i class="fa-solid fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-duration="1000">
          <div class="blog-boxarea">
            <div class="img1 image-anime">
              <img src="/img/all-images/blog/blog-img2.png" alt="" />
            </div>
            <div class="content-area">
              <ul>
                <li><a href="#"><img src="/img/icons/user.svg" alt="" /> Suivi local</a> <span>|</span></li>
                <li><a href="#"><img src="/img/icons/calender.svg" alt="" /> Reactivite</a></li>
              </ul>
              <div class="space20"></div>
              <a href="{{ url('/pages/contact') }}">Un compte-rendu mensuel accompagne de photos et d'informations utiles.</a>
              <div class="space24"></div>
              <a href="{{ url('/pages/contact') }}" class="readmore">En savoir plus <i class="fa-solid fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-duration="1200">
          <div class="blog-boxarea">
            <div class="img1 image-anime">
              <img src="/img/all-images/blog/blog-img3.png" alt="" />
            </div>
            <div class="content-area">
              <ul>
                <li><a href="#"><img src="/img/icons/user.svg" alt="" /> Vente & achat</a> <span>|</span></li>
                <li><a href="#"><img src="/img/icons/calender.svg" alt="" /> Securise</a></li>
              </ul>
              <div class="space20"></div>
              <a href="{{ url('/pages/contact') }}">Des visites qualifiees et un accompagnement juridique plus securisant.</a>
              <div class="space24"></div>
              <a href="{{ url('/pages/contact') }}" class="readmore">En savoir plus <i class="fa-solid fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ===== BLOG AREA ENDS ======= -->
@endsection
