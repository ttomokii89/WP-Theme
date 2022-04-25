<aside class="sub-column sidebar">
    <div class="sidebar__item">
<?php if(!is_single()): ?>
        <h3 class="sidebar__item-title">About</h3>
<?php endif; ?>
        <div class="profile">
<?php if(isset($_GET['amp'])): ?>
            <amp-img class="profile__icon" src="<?php echo get_template_directory_uri(); ?>/asset/img/profile.webp" alt="tomoki tanaka" width="80" height="80" layout="fixed">
                <amp-img class="profile__icon" src="<?php echo get_template_directory_uri(); ?>/asset/img/profile.jpg" alt="tomoki tanaka" width="80" height="80" layout="fixed"></amp-img>
            </amp-img>
<?php else: ?>
            <picture>
                <source class="profile__icon" type="image/webp" srcset="<?php echo get_template_directory_uri(); ?>/asset/img/profile.webp" loading="lazy">
                <img class="profile__icon" src="<?php echo get_template_directory_uri(); ?>/asset/img/profile.jpg" width="80" height="80" alt="Lostmortal@DTMブログ" loading="lazy">
            </picture>
<?php endif; ?>
            <p class="profile__name"><span>Lostmortal@DTMブログ</span><br>(<a href="https://twitter.com/lostmortalmusic" target="_blank" rel="noopener noreferrer">@lostmortalmusic</a>)</p>
        </div>
        <p>DTMer / ブロガー / バンドマン<br>「Lostmortal」としてアーティスト活動とDTMブログ執筆を行っています。</p>
        <p class="profile__link">
            <a href="/about">詳しいプロフィール</a>
            <a href="/music">リリース作品</a>
            <a href="https://big-up.style/artists/152902" target="_blank" rel="noopener">楽曲配信</a>
        </p>
    </div>
<?php
    //カテゴリ取得
    require 'components/_getCategory.php';
    
    $args1 = array(
        'display_count' => 7,
        'period'        => 7,
        'post_type'     => 'post'
    );
    if(is_category() || is_single()){
        if(in_category('1_dtm')){
            if(is_single()){
                $catview = $cat2;
            }else{
                $catview = get_queried_object();
            }
        }else{
            $catview = $cat;
        }
        $args2 = array(
            'category__in' => $catview->slug
        );
    }else{
        $args2 = array(
            'category__not_in' => 'lostmortal'
        );
    }
    $args = array_merge($args1, $args2);
    if (function_exists('sga_ranking_get_date')) {
        $ranking_data = sga_ranking_get_date($args);
    }
    if (!is_category('lostmortal') && !in_category('lostmortal') && !empty($ranking_data)):
?>
    <div class="sidebar__item">
        <h3 class="sidebar__item-title">Popular Posts</h3>
        <ol class="article-list">
    <?php foreach ( $ranking_data as $post_id ): ?>
            <li class="article-list__item">
                <a href="<?php echo esc_attr(get_permalink($post_id)); ?>">
                    <div class="article-list__thumb">
        <?php 
            if (has_post_thumbnail('mini')){
                $size = 'mini';
            } else {
                $size = 'thumbnail';
            }
            $popular_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id, $size));
            $popular_thumb_url = $popular_thumb[0];
            $popular_title = esc_html(get_the_title($post_id));
        ?>
            <?php if(isset($_GET['amp'])): ?>
                        <amp-img src="<?php echo $popular_thumb_url; ?>" alt="<?php echo $popular_title; ?>" width="107" height="60" layout="fixed"></amp-img>
            <?php else: ?>
                        <img src="<?php echo $popular_thumb_url; ?>" alt="<?php echo $popular_title; ?>" width="90" height="60" loading="lazy">
            <?php endif; ?>
                    </div>
                    <h4 class="article-list__title"><?php echo $popular_title; ?></h4>
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
    $catList = get_terms('category', 'orderby=slug&order=asc&pad_counts=true&exclude=20');
    foreach ($catList as $valueC):
        if ($valueC->parent){
            continue;
        }
        //$catChild = get_term_children($valueC->term_id, 'category');
        $catChild = get_terms('category', array('child_of' => $valueC->term_id, 'orderby' => 'count', 'order' => 'desc'));
?>
			<li class="category-list__item">
				<a class="category-list__link" href="<?php echo get_category_link($valueC->term_id); ?>">
                    <span class="category-list__name"><?php echo $valueC->name; ?></span>
                    <span class="category-list__count">(<?php echo $valueC->count; ?>)</span>
                </a>
    <?php
        if($catChild):
            foreach ($catChild as $valueCC):
                //$term = get_term_by('id', $valueCC, 'category');
    ?>
                <a class="category-list__child" href="<?php echo get_category_link($valueCC->term_id); ?>">
                    <span class="category-list__name"><?php echo $valueCC->name; ?></span>
                    <span class="category-list__count">(<?php echo $valueCC->count; ?>)</span>
                </a>
    <?php endforeach; endif; ?>
			</li>
<?php endforeach; ?>
		</ul>		
    </div>
<?php if(!isset($_GET['amp'])): ?>
    <div class="sidebar__item">
		<h3 class="sidebar__item-title">Search</h3>
		<?php get_search_form(); ?>
	</div>
<?php endif; ?>
    <div class="sidebar__item">
        <h3 class="sidebar__item-title">Media</h3>
        <h4 class="media-title">Music</h4>
        <div class="media-list">
            <a class="media-list__item" href="https://www.youtube.com/channel/UCs_Vj9mIZBkg1ViybF409-A" target="_blank" rel="noopener">
                <?php if(isset($_GET['amp'])): ?>
                <amp-img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-youtube.svg" alt="youtube" width="50" height="50" layout="fixed"></amp-img>
                <?php else: ?>
                <img class="media-list__icon lazyload" src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-youtube.svg" alt="youtube" width="50" height="50" loading="lazy">
                <?php endif; ?>
            </a>
            <a class="media-list__item" href="https://lostmortal.bandcamp.com/" target="_blank" rel="noopener">
                <?php if(isset($_GET['amp'])): ?>
                <amp-img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-bandcamp.svg" alt="bandcamp" width="50" height="50" layout="fixed"></amp-img>
                <?php else: ?>
                <img class="media-list__icon lazyload" src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-bandcamp.svg" alt="bandcamp" width="50" height="50" loading="lazy">
                <?php endif; ?>
            </a>
            <a class="media-list__item" href="https://music.apple.com/jp/artist/lostmortal/1436674625" target="_blank" rel="noopener">
                <?php if(isset($_GET['amp'])): ?>
                <amp-img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-applemusic.svg" alt="apple music" width="50" height="50" layout="fixed"></amp-img>
                <?php else: ?>
                <img class="media-list__icon lazyload" src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-applemusic.svg" alt="apple music" width="50" height="50" loading="lazy">
                <?php endif; ?>
            </a>
            <a class="media-list__item" href="https://open.spotify.com/artist/5KoGwGon17wH4PYJ0eKs2N?si=4eC92HBmR7mYmqHGjpOf4Q" target="_blank" rel="noopener">
                <?php if(isset($_GET['amp'])): ?>
                <amp-img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-spotify.svg" alt="spotify" width="50" height="50" layout="fixed"></amp-img>
                <?php else: ?>
                <img class="media-list__icon lazyload" src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-spotify.svg" alt="spotify" width="50" height="50" loading="lazy">
                <?php endif; ?>
            </a>
            <a class="media-list__item" href="https://www.amazon.co.jp/gp/dmusic/promotions/AmazonMusicUnlimited/?tag=ct9a1998-22" target="_blank" rel="noopener">
                <?php if(isset($_GET['amp'])): ?>
                <amp-img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-amazonmusic.jpg" width="50" height="50" layout="fixed"></amp-img>
                <?php else: ?>
                <img class="media-list__icon lazyload" src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-amazonmusic.jpg" alt="amazon music" width="50" height="50" loading="lazy">
                <?php endif; ?>
            </a>
            <a class="media-list__item" href="https://audius.co/lostmortal" target="_blank" rel="noopener">
                <?php if(isset($_GET['amp'])): ?>
                <amp-img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-audius.png" alt="audius" width="50" height="50" layout="fixed"></amp-img>
                <?php else: ?>
                <img class="media-list__icon lazyload" src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-audius.png" alt="audius" width="50" height="50" loading="lazy">
                <?php endif; ?>
            </a>
        </div>
    <?php /*
        <h4 class="media-title">Goods</h4>
        <div class="media-list">
            <a class="media-list__item" href="https://lostmortal.booth.pm/" target="_blank" rel="noopener">
                <?php if(isset($_GET['amp'])): ?>
                <amp-img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-booth.svg" alt="booth" width="142.5" height="50" layout="fixed"></amp-img>
                <?php else: ?>
                <img class="media-list__icon lazyload" src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-booth.svg" alt="booth" width="142.5" height="50" loading="lazy">
                <?php endif; ?>
            </a>
            <a class="media-list__item" href="https://www.zazzle.co.jp/store/lostmortal" target="_blank" rel="noopener">
                <?php if(isset($_GET['amp'])): ?>
                <amp-img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-zazzle.svg" alt="zazzle" width="50" height="50" layout="fixed"></amp-img>
                <?php else: ?>
                <img class="media-list__icon lazyload" src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-zazzle.svg" alt="zazzle" width="50" height="50" loading="lazy">
                <?php endif; ?>
            </a>
            <a class="media-list__item" href="https://suzuri.jp/lostmortal" target="_blank" rel="noopener">
                <?php if(isset($_GET['amp'])): ?>
                <amp-img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-suzuri.png" alt="suzuri" width="80" height="50" layout="fixed"></amp-img>
                <?php else: ?>
                <img class="media-list__icon lazyload" src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-suzuri.png" alt="suzuri" width="80" height="50" loading="lazy">
                <?php endif; ?>
            </a>
        </div>
    */?>
        <h4 class="media-title">Follow Me!</h4>
        <div class="media-list">
            <a class="media-list__item" href="https://twitter.com/lostmortalmusic" target="_blank" rel="noopener">
                <?php if(isset($_GET['amp'])): ?>
                <amp-img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-twitter.svg" alt="twitter" width="50" height="50" layout="fixed"></amp-img>
                <?php else: ?>
                <img class="media-list__icon lazyload" src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-twitter.svg" alt="twitter" width="50" height="50" loading="lazy">
                <?php endif; ?>
            </a>
            <a class="media-list__item" href="https://www.instagram.com/lostmortalmusic/" target="_blank" rel="noopener">
                <?php if(isset($_GET['amp'])): ?>
                <amp-img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-instagram.png" alt="instagram" width="50" height="50" layout="fixed"></amp-img>
                <?php else: ?>
                <img class="media-list__icon lazyload" src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-instagram.png" alt="instagram" width="50" height="50" loading="lazy">
                <?php endif; ?>
            </a>
            <a class="media-list__item" href="https://note.mu/jttshc" target="_blank" rel="noopener">
                <?php if(isset($_GET['amp'])): ?>
                <amp-img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-note.svg" alt="note" width="50" height="50" layout="fixed"></amp-img>
                <?php else: ?>
                <img class="media-list__icon lazyload" src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-note.svg" alt="note" width="50" height="50" loading="lazy">
                <?php endif; ?>
            </a>
            <a class="media-list__item" href="https://www.patreon.com/lostmortal" target="_blank" rel="noopener">
                <?php if(isset($_GET['amp'])): ?>
                <amp-img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-patreon.svg" alt="patreon" width="50" height="50" layout="fixed"></amp-img>
                <?php else: ?>
                <img class="media-list__icon lazyload" src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-patreon.svg" alt="patreon" width="50" height="50" loading="lazy">
                <?php endif; ?>
            </a>
            <a class="media-list__item" href="https://feedly.com/i/subscription/feed%2Fhttps%3A%2F%2Flostmortal.info%2F<?php if(get_locale()!='ja'): ?>en%2F<?php endif ;?>feed" target="_blank" rel="noopener">
                <?php if(isset($_GET['amp'])): ?>
                <amp-img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-feedly_2.png" alt="feedly" width="117" height="50" layout="fixed"></amp-img>
                <?php else: ?>
                <img class="media-list__icon lazyload" src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-feedly_2.png" alt="feedly" width="117" height="50" loading="lazy">
                <?php endif; ?>
            </a>
        </div>
    </div>
</aside>