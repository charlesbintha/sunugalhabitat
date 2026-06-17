@extends('layouts.landing')

@section('content')
  <div class="inner-main-hero-area">
    <div class="img1">
      <img src="/img/all-images/hero/hero-img1.png" alt="" />
    </div>
    <div class="img2">
      <img src="/img/all-images/hero/hero-img2.png" alt="" />
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="inner-heading header-heading">
            <h2>Nos produits</h2>
            <div class="space24"></div>
            <p>
              <a href="{{ url('/') }}">Accueil <i class="fa-solid fa-angle-right"></i></a>
              <a href="{{ route('products.index') }}">Nos produits</a>
            </p>
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
                <h3>Sunugal Habitat</h3>
                <div class="space10"></div>
                <p>Selection de biens et opportunites</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="apartment-inner2-section-area sp7 bg2 sunugal-products-section">
    <div class="container">
      <div class="row gy-4">
        @foreach ($products as $product)
          <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-duration="{{ 800 + ($loop->index * 100) }}">
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
                <p>{{ $product['location'] }} | {{ $product['type'] }}</p>
              </div>
              <div class="arrow">
                <a href="{{ route('products.show', $product['slug']) }}">Voir</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
