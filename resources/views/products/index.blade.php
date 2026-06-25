@extends('layouts.landing')

@section('meta_title', 'Produits immobiliers a Dakar | Sunugal Habitat')
@section('meta_description', 'Decouvrez les produits immobiliers presentes par Sunugal Habitat a Dakar: appartements, villas et immeubles avec accompagnement local et transparent.')
@section('meta_canonical', route('products.index'))
@section('meta_image', asset('img/senegal/dakar-ocean-pool.jpg'))
@section('schema')
  @php
    $collectionSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'CollectionPage',
        'name' => 'Produits immobiliers Sunugal Habitat',
        'url' => route('products.index'),
        'description' => 'Selection de biens et opportunites a Dakar proposee par Sunugal Habitat.',
    ];
  @endphp
  <script type="application/ld+json">@json($collectionSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)</script>
@endsection

@section('content')
  <div class="inner-main-hero-area">
    <div class="img1">
      <img src="/img/senegal/dakar-ocean-pool.jpg" alt="Panorama immobilier a Dakar" />
    </div>
    <div class="img2">
      <img src="/img/senegal/dakar-place-independance.jpg" alt="Dakar centre-ville" />
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
                <img src="/img/logo/sunugal-logo.png" alt="Sunugal Habitat" />
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
