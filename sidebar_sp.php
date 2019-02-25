<aside class="sidebar sidebar--sp">
    <div class="sidebar__item">
        <h3 class="sidebar__item-title">About</h3>
        <p>Author : Tomoki Tanaka (<a href="//twitter.com/JTTSofficial" target="_blank">@JTTSofficial</a>)</p>
        <p>社会人バンドマン。当サイトでは、ソロプロジェクト「Lostmortal」としてWEBでの音楽活動と、音楽＝ライフスタイルを心情にブログ執筆を行っています。</p>
        <p><a href="/about">>詳しくはこちら</a></p>
    </div>
<?php
    $newposts = get_posts( array(
        'post_type' => 'post',
        'posts_per_page' => '5'
    ));
    if( is_single() && $newposts ):
?>
    <div class="sidebar__item">
        <h3 class="sidebar__item-title">New Posts</h3>
        <ul class="article-list">
    <?php 
        foreach($newposts as $post):
        setup_postdata($post); 
    ?>
            <li class="article-list__item">
                <a href="<?php the_permalink(); ?>">
                    <div class="article-list__thumb">
        <?php if (has_post_thumbnail()): ?>
                    <?php the_post_thumbnail('thumbnail'); ?>
        <?php else: ?>
                        <img data-src="<?php echo get_template_directory_uri(); ?>/asset/img/noimg.svg" alt="" class="lazyload">
        <? endif; ?>
                    </div>
                    <h4 class="article-list__title"><?php the_title(); ?></h4>
                </a>
            </li>
    <?php endforeach; ?>
        </ul>
    </div>
<?php wp_reset_postdata(); endif; ?>
<?php
    $args = array(
        'display_count' => 10,
        'period'        => 7,
        'post_type'     => 'post'
    );
    if (function_exists('sga_ranking_get_date')) {
        $ranking_data = sga_ranking_get_date($args);
    }
    if (!empty($ranking_data)):
?>
    <div class="sidebar__item">
        <h3 class="sidebar__item-title">Popular Posts</h3>
        <ol class="article-list">
    <?php foreach ( $ranking_data as $post_id ): ?>
            <li class="article-list__item">
                <a href="<?php echo esc_attr(get_permalink($post_id)); ?>">
                    <div class="article-list__thumb">
        <?php 
            if (has_post_thumbnail($post_id)):
                $popular_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id, 'thumbnail'));
                $popular_thumb_url = $popular_thumb[0];
        ?>
                        <img data-src="<?php echo $popular_thumb_url; ?>" alt="" class="lazyload">
        <?php else: ?>
                        <img data-src="<?php echo get_template_directory_uri(); ?>/asset/img/noimg.svg" alt="" class="lazyload">
        <?php endif; ?>
                    </div>
                    <h4 class="article-list__title"><?php echo esc_html(get_the_title($post_id)); ?></h4>
                </a>
            </li>
    <?php endforeach; ?>
        </ol>
    </div>
<?php endif; ?>

	<div class="sidebar__item">
		<h3 class="sidebar__item-title">Category</h3>
		<ul class="category-list">
<?php
    $cat_all = get_terms( "category", "fields=all&get=all" );
    foreach ($cat_all as $value):
?>
			<li class="category-list__item">
				<h4><a href="<?php echo get_category_link($value->term_id); ?>"><?php echo $value->name;?></a></h4>
			</li>
<?php endforeach; ?>
		</ul>
		
	</div>
	<div class="sidebar__item">
		<h3 class="sidebar__item-title">Archives</h3>
		<div class="archive-list">
			<select class="archive-list__select" name="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'>
				<option value=""><?php echo attribute_escape(__('Select Month')); ?></option>
				<?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?>
			</select>
		</div>
	</div>
	<div class="sidebar__item">
		<h3 class="sidebar__item-title">Search</h3>
		<?php get_search_form(); ?>
	</div>
    <div class="sidebar__item">
        <h3 class="sidebar__item-title">Media</h3>
        <div class="media-list">
            <a class="media-list__item" href="//lostmortal.bandcamp.com/" target="_blank">
                <img data-src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-bandcamp.svg" alt="bandcamp" class="lazyload">
            </a>
            <a class="media-list__item" href="//www.youtube.com/channel/UCs_Vj9mIZBkg1ViybF409-A" target="_blank">
                <img data-src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-youtube.svg" alt="youtube" class="lazyload">
            </a>
            <a class="media-list__item" href="//soundcloud.com/hardcoreforever777-1" target="_blank">
                <img data-src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-soundcloud.svg" alt="soundcloud" class="lazyload">
            </a>
            <a class="media-list__item" href="//twitter.com/JTTSofficial" target="_blank">
                <img data-src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-twitter.svg?1" alt="twitter" class="lazyload">
            </a>
        </div>
    </div>
</aside>