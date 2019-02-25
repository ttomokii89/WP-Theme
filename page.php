@layout('layout.layout')

@section('title')
{{ the_title(); }} | {{ bloginfo( 'name' ); }}
@endsection

@section('description')
{{ the_title(); }}について紹介します。
@endsection

@section('ogp')
<meta property="og:title" content="<?php the_title(); ?> | <?php bloginfo( 'name' ); ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo get_the_permalink(); ?>">
<meta property="og:image" content="<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/jksample.jpg">
<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
<meta property="og:description" content="<?php the_title(); ?>について紹介します。">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="<?php the_title(); ?> | <?php bloginfo( 'name' ); ?>">
<meta name="twitter:description" content="<?php echo get_the_excerpt(); ?>">
<meta name="twitter:image" content="<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/jksample.jpg">
<meta itemprop="image" content="<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/jksample.jpg">
@endsection

@section('content')

<main class="content">
	<div class="main-column">
		<article class="entry">
<?php if (have_posts()): while (have_posts()): the_post(); ?>
  			<header class="entry__header">
                <div class="entry__info">
				    <h1 class="entry__title"><?php the_title(); ?></h1>
                </div>
			</header>
			<section class="entry__body">
				<?php the_content(); ?>
			</section>
			<aside class="entry__sub">
				<h2 class="entry__subhead">Sponsored Link</h2>
				<ul class="entry__sponsored">
					<li class="entry__sponsored-item">
						<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- 300x250_2 -->
						<ins class="adsbygoogle"
							 style="display:inline-block;width:300px;height:250px"
							 data-ad-client="ca-pub-1872274200889143"
							 data-ad-slot="8324207115"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
					</li>
		@if(!$is_sp)
					<li class="entry__sponsored-item">
						<!-- admax -->
						<script src="//adm.shinobi.jp/s/404d0b7476b185ff200f6713753b50e8"></script>
						<!-- admax -->
					</li>
		@endif
				</ul>
			</aside>
<?php endwhile; endif; ?>
		</article>
	</div>
    <?php if(!$is_sp) { get_sidebar(); } else { get_template_part('sidebar_sp'); } ?>
</main>

@endsection