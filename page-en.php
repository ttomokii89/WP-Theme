@layout('layout.layout')

<?php
/*
Template Name: en
*/
?>

@section('lang')
en
@endsection

@section('title')
{{ bloginfo( 'name' ); }} | English
@endsection

@section('description')
Lostmortal is solo project of heavy and emotional music like post hardcore / post metal. My original music is free to use (credit is needed).
@endsection

@section('addmeta')
@endsection

@section('ogp')
<meta property="og:title" content="<?php bloginfo('name'); ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo get_the_permalink(); ?>">
<meta property="og:image" content="<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/jksample.jpg">
<meta property="og:site_name" content="<?php bloginfo('name'); ?>">
<meta property="og:description" content="@yield('description')">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="<?php bloginfo('name'); ?>">
<meta name="twitter:description" content="@yield('description')">
<meta name="twitter:image" content="<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/jksample.jpg">
<meta itemprop="image" content="<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/jksample.jpg">
@endsection

@section('addhead')
<link rel="alternate" hreflang="ja" href="<?php echo get_home_url(); ?>">
<link rel="alternate" hreflang="en" href="<?php echo get_home_url(); ?>/en">
@endsection

@section('content')

@include('components.fv')
<main class="brand">
	<section class="brand__item">
        <div class="brand__ad">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-1872274200889143"
                 data-ad-slot="9987394831"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        <h2 class="brand__title">About Lostmortal</h2>
        <div class="brand__body">
            <div class="flex">
                <div class="flex__text">
                    <p>Lostmortal is solo project of heavy and emotional music by Tomoki Tanaka from Japan.<br>
                        It started as 'Journey To The Stars' in 2013 and it was renamed in 2018.</p>
                    <p>My original music is free to use (credit is needed).</p>
                </div>
                <div class="flex__photo">
                    <img src="<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/profile_2018-320x320.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="brand__item">
        <h2 class="brand__title">My Works</h2>
        <div class="brand__body">
            <p>You can check my works and twitter account from here.</p>
            <ul class="media">
                <li class="media__item">
                    <a href="//lostmortal.bandcamp.com/" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-bandcamp.svg" alt="bandcamp">
                    </a>
                </li>
                <li class="media__item">
                    <a href="//www.youtube.com/channel/UCs_Vj9mIZBkg1ViybF409-A" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-youtube.svg" alt="youtube">
                    </a>
                </li>
                <li class="media__item">
                    <a href="//soundcloud.com/hardcoreforever777-1" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-soundcloud.svg" alt="soundcloud">
                    </a>
                </li>
                <li class="media__item">
                    <a href="//twitter.com/JTTSofficial" target="_blank">
				        <img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-twitter.svg?1" alt="twitter">
                    </a>
                </li>
            </ul>
        </div>
    </section>
    <section class="brand__item">
        <h2 class="brand__title">Contact</h2>
        <div class="brand__body">
            <p>
                You can contact me from here.<br>
                <span class="ast">* but I'm not good at English. Please understand there is a possibility that the reply will be delayed.</span>
            </p>
            <p><?php echo do_shortcode('[contact-form-7 id="1319" title="contact-form-en"]'); ?></p>
        </div>
    </section>
</main>

@endsection