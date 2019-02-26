@layout('layout.layout')

@section('title')
<?php if (is_paged()): ?>
    <?php echo get_query_var('paged'); ?>ページ目｜
<?php endif; ?>
<?php bloginfo( 'name' ); ?>
@endsection

@section('description')
<?php if (is_paged()): ?>
    <?php echo get_query_var('paged'); ?>ページ目｜
<?php endif; ?>
<?php bloginfo( 'description' ); ?>
@endsection

@section('ogp')
<meta property="og:title" content="<?php bloginfo( 'name' ); ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo get_home_url(); ?>">
<meta property="og:image" content="<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/jksample.jpg">
<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
<meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="<?php bloginfo( 'name' ); ?>">
<meta name="twitter:description" content="<?php bloginfo( 'description' ); ?>">
<meta name="twitter:image" content="<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/jksample.jpg">
<meta itemprop="image" content="<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/jksample.jpg">
@endsection

@section('addhead')
<link rel="alternate" hreflang="ja" href="<?php echo get_home_url(); ?>">
<link rel="alternate" hreflang="en" href="<?php echo get_home_url(); ?>/en">
@endsection

@section('content')

<?php if (!$is_sp) { get_template_part('components/fv'); } ?>
<main class="content content--index">
	<div class="main-column">

<?php
    if ($is_sp) {$news_no = 2;} else {$news_no = 3;}
    $news_arg = array(
        'posts_per_page' => $news_no,
        'category_name' => 'lostmortal'
    );
    $news_posts = get_posts( $news_arg );
    if( $news_posts ):
?>
        <h1 class="content-title">Information</h1>
		<ul class="entry-list entry-list--news">
<?php
    foreach ( $news_posts as $post ) :
        setup_postdata( $post ); 
?>
			<li class="entry-list__item">
                <div class="entry-list__thumb">
	<?php if (has_post_thumbnail()): ?>
					<?php the_post_thumbnail('thumbnail'); ?>
	<?php else: ?>
                    <img data-src="<?php echo get_template_directory_uri(); ?>/asset/img/noimg.svg" alt="" class="lazyload">
	<? endif; ?>
				</div>
                <section class="entry-list__info">
                    <h2 class="entry-list__title"><?php the_title(); ?></h2>
                    <div class="entry-list__meta">
                        <time class="entry-list__time" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>">
                            <?php echo get_the_date(); ?>
                        </time>
                    </div>
                </section>
				<a class="entry-list__link" href="<?php the_permalink(); ?>"></a>
			</li>
<?php endforeach; endif; ?>
		</ul>
        <a class="readmore" href="/category/lostmortal">Read More</a>
<?php if(!$is_sp): ?>
        <div class="entry-list entry-list--index">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-format="fluid"
                 data-ad-layout-key="-fm-5o+kp+8r-1uw"
                 data-ad-client="ca-pub-1872274200889143"
                 data-ad-slot="2834828978"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
<?php endif; ?>
<?php
    $blog_arg = array(
        'posts_per_page' => 12,
        'cat' => '-20'
    );
    $blog_posts = get_posts( $blog_arg );
    if( $blog_posts ):
?>
        <h1 class="content-title">Blog/Column</h1>
		<ul class="entry-list">
<?php
    foreach ( $blog_posts as $post ) :
        setup_postdata( $post ); 
?>
			<li class="entry-list__item">
                <div class="entry-list__thumb">
	<?php if (has_post_thumbnail()): ?>
					<?php the_post_thumbnail('thumbnail'); ?>
	<?php else: ?>
                    <img data-src="<?php echo get_template_directory_uri(); ?>/asset/img/noimg.svg" alt="" class="lazyload">
	<? endif; ?>
				</div>
                <section class="entry-list__info">
                    <h2 class="entry-list__title"><?php the_title(); ?></h2>
    <?php if(!$is_sp): ?>
                    <p class="entry-list__excerpt"><?php echo get_the_excerpt(); ?></p>
    <?php endif; ?>
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
				<a class="entry-list__link" href="<?php the_permalink(); ?>"></a>
			</li>
<?php endforeach; endif; ?>
		</ul>
        <a class="readmore" href="/blog/page/2">Read More</a>

<?php if (!$is_sp): ?>
        <div class="sticky sticky--index">
            <div class="sticky__body">
                <h5 class="sticky__title">Media</h5>
                <div class="sticky__share">
                    <a class="sticky__share-item" href="//lostmortal.bandcamp.com/" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-bandcamp.svg" alt="bandcamp">
                    </a>
                    <a class="sticky__share-item" href="//www.youtube.com/channel/UCs_Vj9mIZBkg1ViybF409-A" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-youtube.svg" alt="youtube">
                    </a>
                    <a class="sticky__share-item" href="//soundcloud.com/hardcoreforever777-1" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-soundcloud.svg" alt="soundcloud">
                    </a>
                    <a class="sticky__share-item" href="//twitter.com/JTTSofficial" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-twitter.svg?1" alt="twitter">
                    </a>
                </div>
            </div>
        </div>
<?php endif; ?>
	</div>
    <?php if(!$is_sp) { get_sidebar(); } else { get_template_part('sidebar_sp'); } ?>
</main>

@endsection