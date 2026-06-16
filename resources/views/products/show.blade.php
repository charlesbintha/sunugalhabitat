@extends('layouts.landing')

@section('content')
  <div class="inner-main-hero-area">
    <div class="img1">
      <img src="/img/all-images/hero/hero-img1.png" alt="" />
    </div>
    <div class="img2 d-lg-block d-none">
      <img src="/img/all-images/hero/hero-img2.png" alt="" />
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="inner-heading header-heading">
            <h2>{{ $product['title'] }}</h2>
            <div class="space24"></div>
            <p>
              <a href="{{ url('/') }}">Accueil <i class="fa-solid fa-angle-right"></i></a>
              <a href="{{ route('products.index') }}">Produits <i class="fa-solid fa-angle-right"></i></a>
              <a href="{{ route('products.show', $product['slug']) }}">{{ $product['title'] }}</a>
            </p>
          </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-4">
          <div class="auhtor-box d-lg-block d-none">
            <div class="others-box">
              <div class="img3">
                <img src="/img/logo/sunugal-logo-cropped.jpeg" alt="Sunugal Habitat" />
              </div>
              <div class="text">
                <h3>{{ $product['type'] }}</h3>
                <div class="space10"></div>
                <p>{{ $product['location'] }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="apartment-details-left sp6">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 m-auto">
          <div class="apartment-author-area pdright">
            <div class="img1">
              <img src="{{ $product['hero_image'] }}" alt="{{ $product['title'] }}" />
            </div>
            <div class="space40"></div>
            <h2>{{ $product['title'] }}</h2>
            <div class="space20"></div>
            <p>{{ $product['summary'] }}</p>
            <div class="space16"></div>
            <p>{{ $product['description_1'] }}</p>
            <div class="space16"></div>
            <p>{{ $product['description_2'] }}</p>
            <div class="space40"></div>
            <h3>{{ $product['amenities_title'] }}</h3>
            <div class="space20"></div>
            <p>{{ $product['amenities_text'] }}</p>
            <div class="space20"></div>
            <div class="row">
              @foreach ($product['amenities'] as $index => $amenity)
                <div class="col-lg-6 col-md-6">
                  <div class="list-area">
                    <div class="icons">
                      <img src="/img/icons/apartment-icon{{ ($index % 6) + 1 }}.svg" alt="" />
                    </div>
                    <div class="text">
                      <a href="#">{{ $amenity }}</a>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
            <div class="space40"></div>
            <h3>Galerie du produit</h3>
            <div class="space20"></div>
            <p>Photos de presentation du produit en attendant l'integration progressive des visuels definitifs.</p>
            <div class="space10"></div>
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <div class="images-area">
                  <div class="img2">
                    <img src="{{ $product['gallery_image_1'] }}" alt="{{ $product['title'] }}" />
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="images-area">
                  <div class="img1">
                    <img src="{{ $product['gallery_image_2'] }}" alt="{{ $product['title'] }}" />
                  </div>
                </div>
              </div>
            </div>
            <div class="space32"></div>
            <div class="apartment-contactbox">
              <h3>Parler de ce produit</h3>
              <div class="space16"></div>
              <div class="contact-quick-links">
                <a href="https://wa.me/221781644156" target="_blank" rel="noopener noreferrer" class="header-btn3">WhatsApp</a>
                <a href="mailto:contact@sunugalhabitat.sn?subject={{ rawurlencode('Information produit - '.$product['title']) }}" class="header-btn4">Email</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="apartment-inner2-section-area sp7 bg1">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 m-auto">
          <div class="heading3 space-margin60 text-center">
            <h5>Produits</h5>
            <div class="space20"></div>
            <h2>Autres biens a decouvrir</h2>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach (collect($products)->where('slug', '!=', $product['slug'])->take(3) as $relatedProduct)
          <div class="col-lg-4 col-md-6">
            <div class="apartment-boxarea">
              <div class="img1">
                <img src="{{ $relatedProduct['card_image'] }}" alt="{{ $relatedProduct['title'] }}" />
              </div>
              <div class="content-area">
                <a href="{{ route('products.show', $relatedProduct['slug']) }}">{{ $relatedProduct['title'] }}</a>
                <div class="space16"></div>
                <ul>
                  <li>
                    <a href="#"><img src="/img/icons/bed-icon1.svg" alt="" />{{ $relatedProduct['beds'] }}</a> <span>|</span>
                  </li>
                  <li>
                    <a href="#"><img src="/img/icons/bat-icon1.svg" alt="" />{{ $relatedProduct['baths'] }}</a> <span>|</span>
                  </li>
                  <li>
                    <a href="#"><img src="/img/icons/squre-icon1.svg" alt="" />{{ $relatedProduct['surface'] }}</a>
                  </li>
                </ul>
              </div>
              <div class="arrow">
                <a href="{{ route('products.show', $relatedProduct['slug']) }}">Voir</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
