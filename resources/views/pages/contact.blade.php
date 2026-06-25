@extends('layouts.landing')

@section('meta_title', 'Contact agence immobiliere Dakar Point E | Sunugal Habitat')
@section('meta_description', 'Contactez Sunugal Habitat a Dakar Point E pour la gestion locative, le syndic de copropriete, la vente ou l achat de biens immobiliers.')
@section('meta_canonical', url('/pages/contact'))
@section('meta_image', asset('img/senegal/dakar-place-independance.jpg'))
@section('schema')
  @php
    $contactSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'ContactPage',
        'name' => 'Contact Sunugal Habitat',
        'url' => url('/pages/contact'),
        'description' => 'Page de contact de Sunugal Habitat, agence immobiliere a Dakar Point E.',
    ];
  @endphp
  <script type="application/ld+json">@json($contactSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)</script>
@endsection

@section('content')
  <!-- ===== HERO AREA STARTS ======= -->
  <div class="inner-main-hero-area">
    <div class="img1">
      <img src="/img/senegal/dakar-place-independance.jpg" alt="Dakar et la Place de l Independance" />
    </div>
    <div class="img2">
      <img src="/img/senegal/dakar-renaissance.jpg" alt="Monument de la Renaissance africaine" />
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="inner-heading header-heading">
            <h2>Contact Sunugal Habitat</h2>
            <div class="space24"></div>
            <p>
              <a href="{{ url('/') }}">Accueil <i class="fa-solid fa-angle-right"></i></a>
              <a href="{{ url('/pages/contact') }}">Contact</a>
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
  <!-- ===== HERO AREA ENDS ======= -->

  <!-- ===== CONTACT AREA STARTS ======= -->
  <div class="contact-inner-area sp6">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="contact-inner-boxarea">
            <div class="row align-items-center">
              <div class="col-lg-8">
                <div class="contact-input-section">
                  <h3>Enracines dans la confiance</h3>
                  <div class="space16"></div>
                  <p>
                    Sunugal Habitat est votre partenaire immobilier de proximite au Point E.
                    Nous gerons votre bien comme si c'etait le notre, avec un mandat clair,
                    un suivi regulier et une vraie presence locale.
                  </p>
                  <div class="space32"></div>
                  <div class="contact-quick-links">
                    <a href="https://wa.me/221761991908" target="_blank" rel="noopener noreferrer" class="header-btn3">Ecrire sur WhatsApp</a>
                    <a href="mailto:info@sunugalhabitat.sn" class="header-btn4">Envoyer un email</a>
                  </div>
                  <div class="space32"></div>
                  <p class="brand-note">
                    Gestion locative, syndic de copropriete, vente et achat a Dakar.
                  </p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="contact-box">
                  <div class="icons">
                    <img src="/img/icons/contact-icon1.svg" alt="" />
                  </div>
                  <div class="content">
                    <p>WhatsApp</p>
                    <a href="tel:+221761991908">76 199 19 08</a>
                  </div>
                </div>
                <div class="space20"></div>
                <div class="contact-box">
                  <div class="icons">
                    <img src="/img/icons/contact-icon2.svg" alt="" />
                  </div>
                  <div class="content">
                    <p>Email</p>
                    <a href="mailto:info@sunugalhabitat.sn">info@sunugalhabitat.sn</a>
                  </div>
                </div>
                <div class="space20"></div>
                <div class="contact-box">
                  <div class="icons">
                    <img src="/img/icons/contact-icon3.svg" alt="" />
                  </div>
                  <div class="content">
                    <p>Adresse</p>
                    <a href="#">Dakar Point E en face UCAD</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="space80"></div>

      <div class="row">
        <div class="col-lg-4">
          <div class="contact-author-box">
            <div class="img1">
              <img src="/img/logo/sunugal-logo.png" alt="Sunugal Habitat" />
            </div>
            <div class="space24"></div>
            <p>
              Rassidou Sow vous repond pour la gestion locative, le syndic de copropriete,
              la vente et l'achat de biens a Dakar.
            </p>
            <div class="space32"></div>
            <div class="btn-area1">
              <a href="https://wa.me/221761991908" target="_blank" rel="noopener noreferrer"><img src="/img/icons/whatsapp.svg" alt="" /> Ecrire sur WhatsApp</a>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="maps-area">
            <img src="/img/senegal/dakar-savana.jpg" alt="Cadre de vie a Dakar" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ===== CONTACT AREA ENDS ======= -->
@endsection
