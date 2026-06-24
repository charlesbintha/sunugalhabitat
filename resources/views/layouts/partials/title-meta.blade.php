@php
    $autoNoindex = request()->is([
        'apartment/*',
        'blogs/*',
        'demo/*',
        'single/*',
        'pages/about',
        'pages/gallery-v1',
        'pages/gallery-v2',
        'pages/testimonial',
    ]);
    $defaultTitle = 'Sunugal Habitat | Agence immobiliere a Dakar Point E';
    $defaultDescription = 'Sunugal Habitat, agence immobiliere a Dakar Point E. Gestion locative, syndic de copropriete, vente et achat avec un accompagnement local, reactif et transparent.';
    $defaultImage = asset('img/all-images/hero/hero-img6.png');
    $metaTitle = trim($__env->yieldContent('meta_title', $defaultTitle));
    $metaDescription = trim($__env->yieldContent('meta_description', $defaultDescription));
    $metaImage = trim($__env->yieldContent('meta_image', $defaultImage)) ?: $defaultImage;
    $metaCanonical = trim($__env->yieldContent('meta_canonical', url()->current()));
    $metaImageAlt = trim($__env->yieldContent('meta_image_alt', $metaTitle));
    $defaultRobots = $autoNoindex
        ? 'noindex,nofollow,noarchive'
        : 'index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1';
    $metaRobots = trim($__env->yieldContent('meta_robots', $defaultRobots));
@endphp

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $metaTitle }}</title>
<meta name="description" content="{{ $metaDescription }}">
<meta name="robots" content="{{ $metaRobots }}">
<meta name="author" content="Sunugal Habitat">
<meta name="theme-color" content="#0f2f57">
<link rel="canonical" href="{{ $metaCanonical }}">
<link rel="alternate" hreflang="fr-SN" href="{{ $metaCanonical }}">

<meta property="og:locale" content="fr_SN">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Sunugal Habitat">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:url" content="{{ $metaCanonical }}">
<meta property="og:image" content="{{ $metaImage }}">
<meta property="og:image:alt" content="{{ $metaImageAlt }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
<meta name="twitter:image" content="{{ $metaImage }}">
<meta name="twitter:image:alt" content="{{ $metaImageAlt }}">

<!--=====FAB ICON=======-->
<link rel="shortcut icon" href="/img/logo/sunugal-logo.png" type="image/png">
