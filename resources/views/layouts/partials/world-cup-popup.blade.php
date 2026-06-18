@php
    $worldCupEndsAt = '2026-07-20T03:00:00Z';
@endphp

<div
    class="sunugal-campaign-modal"
    id="sunugalCampaignModal"
    data-campaign-deadline="{{ $worldCupEndsAt }}"
    aria-hidden="true"
>
    <div class="sunugal-campaign-modal__backdrop" data-campaign-close></div>
    <div class="sunugal-campaign-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="sunugalCampaignTitle">
        <button
            type="button"
            class="sunugal-campaign-modal__close"
            aria-label="Fermer le message de soutien"
            data-campaign-close
        >
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="sunugal-campaign-modal__content">
            <div class="sunugal-campaign-modal__copy">
                <span class="sunugal-campaign-modal__eyebrow">Allez les Lions</span>
                <div class="sunugal-campaign-modal__brand">
                    <img src="{{ asset('img/logo/sunugal-logo-cropped.jpeg') }}" alt="Logo Sunugal Habitat">
                    <span>Sunugal Habitat</span>
                </div>

                <h2 id="sunugalCampaignTitle">Sunugal Habitat soutient les Lions pour la Coupe du Monde 2026</h2>

                <p>
                    Enracines dans la confiance, nous sommes derriere le Senegal pendant tout le tournoi.
                    Force, fierte et union nationale: toute l'equipe Sunugal Habitat est avec les Lions.
                </p>

                <div class="sunugal-campaign-modal__countdown" aria-label="Compte a rebours jusqu a la fin du tournoi">
                    <div class="sunugal-campaign-modal__countdown-item">
                        <strong data-countdown-days>00</strong>
                        <span>Jours</span>
                    </div>
                    <div class="sunugal-campaign-modal__countdown-item">
                        <strong data-countdown-hours>00</strong>
                        <span>Heures</span>
                    </div>
                    <div class="sunugal-campaign-modal__countdown-item">
                        <strong data-countdown-minutes>00</strong>
                        <span>Minutes</span>
                    </div>
                    <div class="sunugal-campaign-modal__countdown-item">
                        <strong data-countdown-seconds>00</strong>
                        <span>Secondes</span>
                    </div>
                </div>

                <div class="sunugal-campaign-modal__actions">
                    <button type="button" class="header-btn3" data-campaign-close>Continuer sur le site</button>
                    <a href="https://wa.me/221761991908" target="_blank" rel="noopener noreferrer" class="header-btn4">
                        Partager le soutien
                    </a>
                </div>
            </div>

            <div class="sunugal-campaign-modal__media">
                <img src="{{ asset('img/campaign/fsf.jpg') }}" alt="Les Lions du Senegal">
            </div>
        </div>
    </div>
</div>
