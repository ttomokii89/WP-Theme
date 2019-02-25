@layout('layout.layout')

@section('title')
{{ bloginfo( 'name' ); }}
@endsection

@section('description')
{{ bloginfo( 'description' ); }}
@endsection

@section('ogp')
<meta property="og:title" content="<?php bloginfo( 'name' ); ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo get_home_url(); ?>">
<meta property="og:image" content="<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/jksample.jpg">
<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
<meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="<?php the_title(); ?>">
<meta name="twitter:description" content="<?php bloginfo( 'description' ); ?>">
<meta name="twitter:image" content="<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/jksample.jpg">
<meta itemprop="image" content="<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/jksample.jpg">
@endsection

@section('content')
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "WebSite",
  "name": "Lostmortal Web",
  "url": "https://lostmortal.info",
  "sameAs": [
    "https://twitter.com/JTTSofficial",
  ]
}
</script>
<div class="fv" id="js-slider">
	<div class="fv__slide">
		<picture>
			<source class="fv__bg" media="(max-width: 640px)" srcset="<?php bloginfo('template_url'); ?>/asset/img/fv_bg_sp.jpg">
			<source class="fv__bg" media="(min-width: 641px)" srcset="<?php bloginfo('template_url'); ?>/asset/img/fv_bg.jpg">
			<img class="fv__bg" src="<?php bloginfo('template_url') ?>/asset/img/fv_bg.jpg" alt="">
		</picture>
		<div class="fv__content">
			<a href="" target="_blank">
                <picture>
                    <source media="(max-width: 640px)" srcset="<?php bloginfo('template_url'); ?>/asset/img/at_sp.png">
                    <source media="(min-width: 641px)" srcset="<?php bloginfo('template_url'); ?>/asset/img/at_pc.png?1">
				    <img src="<?php bloginfo('template_url'); ?>/asset/img/at_sp.png" alt="journey to the stars">
                </picture>
			</a>
		</div>
	</div>
</div>
<main class="content content--index">
	<div class="main-column main-column--index">
		<ul class="entry-list" id="js-hover-group">
<?php if (have_posts()): while (have_posts()): the_post(); ?>
			<li class="entry-list__item">
                <section class="entry-list__info">
                    <h2 class="entry-list__title"><?php the_title(); ?></h2>
                    <p class="entry-list__excerpt"><?php echo mb_substr(get_the_excerpt(), 0, 64); ?></p>
                    <div class="entry-list__meta">
                        <time class="entry-list__time" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>">
                            <?php echo get_the_date(); ?>
                        </time>
                        <div class="entry-list__category">
                        <?php
                            $cats = get_the_category();
                            foreach($cats as $cat):
                        ?>
                            <span class="entry-list__category-item"><?php echo $cat->cat_name; ?></span>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </section>
                <div class="entry-list__thumb">
	<?php if (has_post_thumbnail()): ?>
					<?php the_post_thumbnail('thumbnail'); ?>
	<?php else: ?>
					<img src="<?php echo get_template_directory_uri(); ?>/asset/img/noimg.png" alt="">
	<? endif; ?>
				</div>
				<a class="entry-list__link" href="<?php the_permalink(); ?>"></a>
			</li>
<?php endwhile; endif; ?>
		</ul>
		<div class="pager">
			<?php the_posts_pagination( array(
				'mid_size' => '1',
				'prev_text' => (''),
				'next_text' => (''),
				'screen_reader_text' => ('')
			) ); ?>
		</div>
	</div>
	<?php if (!$is_sp) { get_sidebar(); } ?>
</main>

@endsection