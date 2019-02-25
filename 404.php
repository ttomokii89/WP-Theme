@layout('layout.layout')

@section('title')
404 Page Not Found | {{ bloginfo( 'name' ); }}
@endsection

@section('description')
404 Page Not Found ページが見つかりません
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

@section('content')

<main class="content content--404">
    <div class="notfound">
        404 Page Not Found / ページが見つかりません<br><br>
        <a href="/">Back To Top</a>
    </div>
</main>

@endsection