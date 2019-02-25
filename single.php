@layout('layout.layout')

@section('title')
{{ the_title(); }} | {{ bloginfo('name'); }}
@endsection

@section('description')
{{ get_the_excerpt(); }}
@endsection

@section('ogp')
<meta property="og:title" content="<?php the_title(); ?> | <?php bloginfo( 'name' ); ?>">
<meta property="og:type" content="article">
<meta property="og:url" content="<?php echo get_the_permalink(); ?>">
<meta property="og:image" content="<?php echo get_the_post_thumbnail_url(); ?>">
<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
<meta property="og:description" content="<?php echo get_the_excerpt(); ?>">
<meta property="article:published_time" content="<?php the_time('Y-m-d'); ?>">
<meta property="article:modified_time" content="<?php the_modified_date('Y/m/d'); ?>">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="<?php the_title(); ?> | <?php bloginfo( 'name' ); ?>">
<meta name="twitter:description" content="<?php echo get_the_excerpt(); ?>">
<meta name="twitter:image" content="<?php echo get_the_post_thumbnail_url(); ?>">
<meta itemprop="image" content="<?php echo get_the_post_thumbnail_url(); ?>">
@endsection

@section('content')

<main class="content">
	<div class="main-column">
		<article class="entry">
<?php if (have_posts()): while(have_posts()): the_post(); ?>
    <?php if (!$is_sp): ?>
            <div class="sticky">
                <div class="sticky__body">
                    <h5 class="sticky__title">Share</h5>
                    <div class="sticky__share">
                        <a class="sticky__share-item" href="//twitter.com/share?url=<?php the_permalink(); ?>&text=<?php echo get_the_title(); ?>&via=JTTSofficial&tw_p=tweetbutton&related=JTTSofficial" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-twitter.svg" alt="twitter">
                        </a>
                        <a class="sticky__share-item" href="//www.facebook.com/share.php?u=<?php the_permalink(); ?>&t=<?php echo get_the_title(); ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-facebook.svg" alt="facebook">
                        </a>
                        <a class="sticky__share-item" href="//b.hatena.ne.jp/entry/<?php the_permalink(); ?>" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-hatena.svg" alt="はてブ">
                        </a>
                    </div>
                </div>
            </div>
    <?php endif; ?>
  			<header class="entry__header">
                <section class="entry__info">
                    <h1 class="entry__title"><?php the_title(); ?></h1>
                    <p class="entry__excerpt"><?php echo get_the_excerpt(); ?></p>
                    <div class="entry__meta">
	<?php if (get_the_modified_time('Y/m/d') != get_the_time('Y/m/d')): ?>
    				    <time class="entry__updated" datetime="<?php the_modified_date('Y/m/d'); ?>"><?php the_modified_date('Y/m/d'); ?></time>
	<?php else: ?>
					   <time class="entry__time" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y/m/d'); ?></time>
	<?php endif; ?>
					   <span class="entry__category"><?php the_category(','); ?></span>
				    </div>
                </section>
	<?php if (has_post_thumbnail()): ?>			
				<div class="entry__thumb">
                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
				</div>
	<?php endif; ?>
			</header>
    <?php if(!$is_sp): ?>
			<div class="entry__ad">
        <?php if(in_category('lostmortal')): ?>
                <!-- MAF Rakuten Widget FROM HERE -->
                <script type="text/javascript">MafRakutenWidgetParam=function() { return{ size:'600x200',design:'slide',recommend:'on',auto_mode:'on',a_id:'1116369', border:'off'};};</script><script type="text/javascript" src="//image.moshimo.com/static/publish/af/rakuten/widget.js"></script>
                <!-- MAF Rakuten Widget TO HERE -->
        <?php elseif ( is_single( 1740 ) ): //wpX推し記事用 ?>
                <a href="https://px.a8.net/svt/ejp?a8mat=358QMP+A6R1F6+CO4+103AOX" target="_blank" rel="nofollow"><img border="0" width="728" height="90" alt="" src="https://www23.a8.net/svt/bgt?aid=190204369616&wid=001&eno=01&mid=s00000001642006062000&mc=1"></a>
        <?php else: ?>
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<ins class="adsbygoogle"
					 style="display:block; text-align:center;"
					 data-ad-layout="in-article"
					 data-ad-format="fluid"
					 data-ad-client="ca-pub-1872274200889143"
					 data-ad-slot="1752302625"></ins>
				<script>
					 (adsbygoogle = window.adsbygoogle || []).push({});
				</script>
        <?php endif; ?>
            </div>
    <?php endif; ?>
			<section class="entry__body">
				<?php the_content(); ?>
			</section>
    <?php if(!$is_sp): ?>
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
					<li class="entry__sponsored-item">
						<!-- admax -->
						<script src="//adm.shinobi.jp/s/404d0b7476b185ff200f6713753b50e8"></script>
						<!-- admax -->
					</li>
				</ul>
			</aside>
    <?php endif; ?>
			<aside class="entry__sub">
				<h2 class="entry__subhead">Share This Post</h2>
				<div class="entry__share">
					<a class="entry__share-btn entry__share-btn--twitter" href="//twitter.com/share?url=<?php the_permalink();?>&text=<?php echo get_the_title(); ?>&via=JTTSofficial&tw_p=tweetbutton&related=JTTSofficial" target="_blank">
						Twitter
					</a>
					<a class="entry__share-btn entry__share-btn--facebook" href="//www.facebook.com/share.php?u=<?php the_permalink(); ?>&t=<?php echo get_the_title(); ?>" target="_blank">
						Facebook
					</a>
					<!--<a class="entry__share-btn entry__share-btn--google" href="//plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank">
						Google+
					</a>-->
                    <a class="entry__share-btn entry__share-btn--hatena" href="//b.hatena.ne.jp/entry/<?php the_permalink(); ?>" target="_blank">
						はてブ
					</a>
				</div>
			</aside>
	<?php 
		if (has_category()) {
			$cats = get_the_category();
			$catkwds = array();
			foreach($cats as $cat) {
				$catkwds[] = $cat->term_id;
			}
		}
		$related = get_posts( array(
			'post_type' => 'post',
			'posts_per_page' => '6',
			'post__not_in' => array( $post->ID ),
			'category__in' => $catkwds,
			'orderby' => 'rand'
		) ); 
		if ($related): 
	?>
			<aside class="entry__sub">
				<h4 class="entry__subhead">Related Posts</h4>
				<ul class="entry__related related">
		<?php 
			foreach($related as $post):
				setup_postdata($post); 
		?>
					<li class="related__item">
						<a href="<?php the_permalink(); ?>">
 			<?php 
				if (has_post_thumbnail()) {
					$related_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail');
                } elseif(preg_match( '/wp-image-(\d+)/s', $post->post_content, $thumbid )) {
                    $related_thumb = wp_get_attachment_image_src( $thumbid[1], 'medium' );
                }
			?>
            <?php if (has_post_thumbnail()): ?>
                            <img class="related__thumb lazyload" data-src="<?php echo $related_thumb[0]; ?>" alt="">
			<?php else: ?>
                            <img class="related__thumb lazyload" data-src="<?php echo get_template_directory_uri(); ?>/asset/img/noimg.svg" alt="">
			<?php endif; ?>
							<h5 class="related__title">
								<?php the_title(); ?>
							</h5>
						</a>
					</li>
		<?php endforeach; ?>
				</ul>
			</aside>
	<?php endif; ?>
<?php endwhile; endif; ?>
		</article>
	</div>
    <?php if(!$is_sp) { get_sidebar(); } else { get_template_part('sidebar_sp'); } ?>
</main>

@endsection