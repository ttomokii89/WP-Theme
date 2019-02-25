<!doctype html>
@section('lang')
ja
@endsection
<html lang="@yield('lang')">

@if (is_single())
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
@else
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
@endif
    
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T2K5XPG');</script>

<?php //Google自動広告 ?>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-1872274200889143",
        enable_page_level_ads: true
    });
</script>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="description" content="@yield('description')">
@yield('addmeta')

<title>@yield('title')</title>
    
<link rel="icon" type="image/png" href="{{ bloginfo('template_url'); }}/asset/img/favicon.png">
    
<?php
if (is_front_page()) {
    $css = 'index';
} elseif (is_single() || is_page()) {
    $css = 'entry';
    if (is_page('en')) {
        $css = 'en';
    } elseif (is_page('blog')) {
        $css = 'archive';
    }
} elseif (is_archive() || is_search()) {
    $css = 'archive';
} else {
    $css = 'common';
}
?>
<link rel="stylesheet" type="text/css" href="{{ bloginfo('template_url'); }}/asset/css/{{ $css }}.css">

@yield('ogp')

<?php
if (is_front_page()) {
	$canonical_url  = get_bloginfo('url');
} elseif (is_category()) {
	$canonical_url=get_category_link(get_query_var('cat'));
} elseif (is_page() || is_single()) {
	$canonical_url = get_permalink();
    if ( $paged >= 2 || $page >= 2) {
	   $canonical_url = $canonical_url.'page/'.max( $paged, $page ).'/';
    }
} elseif (is_404()) {
	$canonical_url =  get_bloginfo('url')."/404";
} else {
	$canonical_url  = get_bloginfo('url');
}
?>
<link rel="canonical" href="{{ $canonical_url }}">
    
@yield('addhead')

{{ wp_head(); }}
</head>

<body>

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T2K5XPG"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

@if ($is_ie)
    <div class="alert">
        <div class="alert__body">
            <div class="caution">
                <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve" width="50" height="50">
                    <g>
                        <path class="st0" d="M256.007,357.113c-16.784,0-30.411,13.613-30.411,30.397c0,16.791,13.627,30.405,30.411,30.405
                            s30.397-13.614,30.397-30.405C286.405,370.726,272.792,357.113,256.007,357.113z" style="fill: rgb(255, 0, 0);"></path>
                        <path class="st0" d="M505.097,407.119L300.769,53.209c-9.203-15.944-26.356-25.847-44.777-25.847
                            c-18.407,0-35.544,9.904-44.747,25.847L6.902,407.104c-9.203,15.943-9.203,35.751,0,51.694c9.204,15.943,26.356,25.84,44.763,25.84
                            h408.67c18.406,0,35.559-9.897,44.762-25.84C514.301,442.855,514.301,423.047,505.097,407.119z M464.465,432.405
                            c-2.95,5.103-8.444,8.266-14.35,8.266H61.878c-5.892,0-11.394-3.163-14.329-8.281c-2.964-5.11-2.979-11.445-0.014-16.548
                            l194.122-336.24c2.943-5.103,8.436-8.274,14.35-8.274c5.9,0,11.386,3.171,14.336,8.282l194.122,336.226
                            C467.415,420.945,467.415,427.295,464.465,432.405z" style="fill: rgb(255, 0, 0);"></path>
                        <path class="st0" d="M256.007,152.719c-16.784,0-30.411,13.613-30.411,30.405l11.68,137.487c0,10.346,8.378,18.724,18.731,18.724
                            c10.338,0,18.731-8.378,18.731-18.724l11.666-137.487C286.405,166.331,272.792,152.719,256.007,152.719z" style="fill: rgb(255, 0, 0);"></path>
                    </g>
                </svg>
            </div>
            当サイトはInternet Explorerには対応していません。
            <div class="accent">※Internet Explorerは前時代の脆弱なブラウザです。当サイトの閲覧に限らず移行を推奨します。</div>
            <a href="https://www.google.com/intl/ja_ALL/chrome/" target="_blank">Google Chrome</a>など最新のブラウザで閲覧頂くようお願い致します。
        </div>
    </div>
@endif
	@include('header')
	<div class="container">
		@yield('content')
	</div>
	@include('footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/4.1.5/lazysizes.min.js" async></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ bloginfo('template_url'); }}/asset/js/common.min.js"></script>
<?php if( !$is_sp && ( is_front_page() || is_page('en') ) ): ?>
<script src="{{ bloginfo('template_url'); }}/asset/js/slider.min.js"></script> 
<?php endif; ?>

{{ wp_footer(); }}
</body>
</html>
