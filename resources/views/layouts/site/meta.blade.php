<meta name="robots" content="index, follow"> 
<meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1"> 
<meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1"> 

@if(!empty($cardMeta))

        <meta name="description" content="{{ $cardMeta['description'] }}"> 
        <meta name="keywords" content="{{ $cardMeta['keywords'] }}">
        <link rel="canonical" href="{{ url('card/' . $cardMeta['slug']) }}"> 

        <meta property="og:locale" content="en_US"> 
        <meta property="og:type" content="page"> 

        <meta property="og:title" content="{{ $cardMeta['business_name'] }} | CardBiz.in - B2C Marketplace"> 
        <meta property="og:description" content="{{ $cardMeta['description'] }}"> 
        <meta property="og:url" content="{{ url('card/' . $cardMeta['slug']) }}"> 
        <meta property="og:site_name" content="CardBiz.in"> 
        <meta property="article:publisher" content="https://www.facebook.com/cardbiz.in/"> 
        <meta property="og:image" content="{{ asset('/images/social-logo.png') }}"> 
        <meta property="og:image:width" content="370"> 
        <meta property="og:image:height" content="370"> 

        <meta name="twitter:card" content="summary_large_image"> 
        <meta name="twitter:creator" content="@CardbizIn"> 
        <meta name="twitter:site" content="@CardbizIn">
@else
        <meta name="description" content="The idea of cardbiz.in is to centralize business visiting cards under this platform. Any user or business person can use this platform for searching and organizing business visiting cards in this platform. "> 
        <meta name="keywords" content="Business Directory | Free Business Listing">
        <link rel="canonical" href="{{ url('/') }}"> 

        <meta property="og:locale" content="en_US"> 
        <meta property="og:type" content="page"> 

        <meta property="og:title" content="CardBiz.in - B2C Marketplace"> 
        <meta property="og:description" content="The idea of cardbiz.in is to centralize business visiting cards under this platform. Any user or business person can use this platform for searching and organizing business visiting cards in this platform. "> 
        <meta property="og:url" content="{{ url('/') }}"> 
        <meta property="og:site_name" content="CardBiz.in"> 
        <meta property="article:publisher" content="https://www.facebook.com/cardbiz.in/"> 
        <meta property="og:image" content="{{ asset('/images/social-logo.png') }}"> 
        <meta property="og:image:width" content="370"> 
        <meta property="og:image:height" content="370"> 

        <meta name="twitter:card" content="summary_large_image"> 
        <meta name="twitter:creator" content="@CardbizIn"> 
        <meta name="twitter:site" content="@CardbizIn">
@endif