<?php
//カテゴリ取得
require 'components/_getCategory.php';

//動画情報取得
$youtube_id = get_post_meta($post->ID, 'youtube_id', true);
if($youtube_id){
    $api_url = 'https://www.googleapis.com/youtube/v3/videos?id='.$youtube_id.'&key=AIzaSyAuA8OQM3zdhdjmxBEd3jpwBZV0SgPsKLA&part=snippet,contentDetails,statistics,status';
    $api_json = file_get_contents($api_url);
    $api_data = json_decode($api_json, true);
    foreach((array)$api_data['items'] as $key => $dat){
        $video_title = $dat['snippet']['title'];
        $video_desc = $dat['snippet']['description'];
        $video_thumb = $dat['snippet']['thumbnails']['standard']['url'];
        $video_date = $dat['snippet']['publishedAt'];
        $video_duration = $dat['contentDetails']['duration'];
        $video_count = $dat['statistics']['viewCount'];
    }
}
//シェアボタンのURL調整
$table = array(
    '%'=>'％',
    '&'=>'＆',
    '#'=>'＃'
);
$search = array_keys($table);
$replace = array_values($table);
$title_param = str_replace($search, $replace, get_the_title());

//抜粋を記事に表示しない場合
$no_excerpt = get_post_meta($post->ID, 'no_excerpt', 'true');
?>

<?php get_header(); ?>
<div class="container">
<main class="content">
    <ul class="breadcrumb">
        <li class="breadcrumb__item"><a href="/">TOP</a></li>
        <li class="breadcrumb__item"><a href="<?php echo get_category_link( $cat->term_id ); ?>"><?php echo $cat->cat_name; ?></a></li>
    <?php if($cat!=$cat2): ?>
        <li class="breadcrumb__item"><a href="<?php echo get_category_link( $cat2->term_id ); ?>"><?php echo $cat2->cat_name; ?></a></li>
    <?php endif; ?>
        <li class="breadcrumb__item"><?php the_title(); ?></li>
    </ul>
	<div class="main-column">
        <article class="entry">
<?php if (have_posts()): while(have_posts()): the_post(); ?>
  			<header class="entry__header">
                <div class="entry__info">
                    <h1 class="entry__title"><?php the_title(); ?></h1>
                    <div class="entry__meta">
                    <?php if (!in_category('lostmortal') && ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) )): ?>
    				    <time class="entry__updated" datetime="<?php the_modified_date('Y-m-d'); ?>"><?php the_modified_date('Y-m-d'); ?></time>
                    <?php else: ?>
				        <time class="entry__time" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y-m-d'); ?></time>
                    <?php endif; ?>
				    </div>
                </div>
    <?php if (has_post_thumbnail()): ?>
				<div class="entry__thumb">
        <?php if(isset($_GET['amp'])): ?>
                    <amp-img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" width="680" height="383" layout="responsive"></amp-img>
        <?php else: ?>
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" width="680" height="383" loading="eager">
        <?php endif; ?>
				</div>
	<?php endif; ?>
			</header>
            <div class="entry__share entry__share--first">
                <a class="entry__share-btn entry__share-btn--twitter" href="https://twitter.com/share?url=<?php the_permalink();?>&text=<?php echo $title_param; ?>&via=lostmortalmusic&tw_p=tweetbutton&related=lostmortalmusic" target="_blank" rel="noopener">
                    Twitter
                </a>
                <a class="entry__share-btn entry__share-btn--facebook" href="https://www.facebook.com/share.php?u=<?php the_permalink(); ?>&t=<?php echo $title_param; ?>" target="_blank" rel="noopener">
                    Facebook
                </a>
                <a class="entry__share-btn entry__share-btn--hatena" href="https://b.hatena.ne.jp/entry/<?php the_permalink(); ?>" target="_blank" rel="noopener">
                    Hatena
                </a>
            </div>
            <section class="entry__body" id="js-entryBody">
            <?php /* if(!in_category(array('lostmortal','sale'))): ?>
                <p>こんにちは。Lostmortal@DTMブログ (<a href="https://twitter.com/lostmortalmusic" target="_blank" rel="noopener">@lostmortalmusic</a>) です。</p>
            <?php endif; */
                if(!$no_excerpt): ?>
                <p class="entry__description"><?php echo get_the_excerpt(); ?></p>
            <?php endif; ?>
				<?php the_content(); ?>
			</section>
            <aside class="entry__sub">
                <div class="entryAd">
                <?php if(isset($_GET['amp'])): //記事2 ?>
                    <amp-ad width="100vw" height="320"
                        type="adsense"
                        data-ad-client="ca-pub-1872274200889143"
                        data-ad-slot="4117754718"
                        data-auto-format="rspv"
                        data-full-width="">
                        <div overflow=""></div>
                    </amp-ad>
                <?php else: ?>
                    <ins class="adsbygoogle"
                        style="display:block"
                        data-ad-client="ca-pub-1872274200889143"
                        data-ad-slot="4117754718"
                        data-ad-format="auto"
                        data-full-width-responsive="true">
                    </ins>
                <?php endif; ?>
                </div>
            </aside>
            <aside class="entry__sub">
                <div class="entry__share">
                    <a class="entry__share-btn entry__share-btn--twitter" href="https://twitter.com/share?url=<?php the_permalink();?>&text=<?php echo $title_param; ?>&via=lostmortalmusic&tw_p=tweetbutton&related=lostmortalmusic" target="_blank" rel="noopener">
                        Twitter
                    </a>
                    <a class="entry__share-btn entry__share-btn--facebook" href="https://www.facebook.com/share.php?u=<?php the_permalink(); ?>&t=<?php echo $title_param; ?>" target="_blank" rel="noopener">
                        Facebook
                    </a>
                    <a class="entry__share-btn entry__share-btn--hatena" href="https://b.hatena.ne.jp/entry/<?php the_permalink(); ?>" target="_blank" rel="noopener">
                        Hatena
                    </a>
                </div>
            </aside>
        <?php if (has_tag()): ?>
            <aside class="entry__sub">
                <p class="entry__tags">Tags : <?php the_tags( '', ', ' ); ?></p>
            </aside>
        <?php endif; ?>
        <?php /* if (!in_category('sale')): ?>
            <aside class="entry__sub">
                <div class="entry__cheer">
                    <p class="entry__cheerHead">＼応援よろしくお願いします／</p>
                    <div class="entry__cheerList">
                        <a class="entry__cheerListItem" href="https://feedly.com/i/subscription/feed%2Fhttps%3A%2F%2Flostmortal.info%2Ffeed" target="_blank" rel="noopener">
                            <?php if(isset($_GET['amp'])): ?>
                            <amp-img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-feedly_2.png" alt="feedly" width="131" height="56" layout="fixed"></amp-img>
                            <?php else: ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-feedly_2.png" alt="feedly" width="131" height="56" loading="lazy">
                            <?php endif; ?>
                        </a>
                        <a class="entry__cheerListItem" href="https://twitter.com/lostmortalmusic" target="_blank" rel="noopener">
                            <?php if(isset($_GET['amp'])):  //twitter ?>
                            <amp-img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-twitter_2.svg" alt="twitter" width="180" height="25" layout="fixed"></amp-img>
                            <?php else: ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-twitter_2.svg" alt="twitter" width="180" height="25" loading="lazy">
                            <?php endif; ?>
                        </a>
                        <a class="entry__cheerListItem" href="https://www.youtube.com/channel/UCs_Vj9mIZBkg1ViybF409-A" target="_blank" rel="noopener">
                            <?php if(isset($_GET['amp'])):  //youtube ?>
                            <amp-img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-youtube_2.svg" alt="youtube" width="150" height="33" layout="fixed"></amp-img>
                            <?php else: ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/asset/img/icon-youtube_2.svg" alt="youtube" width="150" height="33" loading="lazy"></amp-img>
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="entry__cheerList">
                        <a class="entry__cheerListItem" href="//blog.with2.net/link/?2045400:1196" target="_blank" rel="noopener">
                            <?php if(isset($_GET['amp'])): ?>
                            <amp-img src="<?php echo get_template_directory_uri(); ?>/asset/img/blog_ranking.gif" alt="DTMランキング" width="110" height="31" layout="fixed"></amp-img>
                            <?php else: ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/asset/img/blog_ranking.gif" alt="DTMランキング" width="110" height="31" loading="lazy">
                            <?php endif; ?>
                        </a>
                        <a class="entry__cheerListItem" href="https://music.blogmura.com/dtm/ranking/in?p_cid=11066363" target="_blank" rel="noopener">
                            <?php if(isset($_GET['amp'])): ?>
                            <amp-img src="<?php echo get_template_directory_uri(); ?>/asset/img/blogmura.gif" width="88" height="31" alt="ブログランキング・にほんブログ村へ" layout="fixed"></amp-img>
                            <?php else: ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/asset/img/blogmura.gif" width="88" height="31" alt="ブログランキング・にほんブログ村へ" loading="lazy">
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            </aside>
        <?php endif; */ ?>
			<aside class="entry__sub">
                <h2 class="entry__subhead">関連記事</h2>
        <?php /* if(!in_category('lostmortal')): //関連記事 ?>
                <div class="google-related">
            <?php if(isset($_GET['amp'])): ?>
                    <amp-ad width="100vw" height="320"
                        type="adsense"
                        data-ad-client="ca-pub-1872274200889143"
                        data-ad-slot="7752126381"
                        data-auto-format="mcrspv"
                        data-full-width=""
                        data-matched-content-rows-num="6,3"
                        data-matched-content-columns-num="1,3"
                        data-matched-content-ui-type="image_sidebyside,image_stacked">
                        <div overflow=""></div>
                    </amp-ad>
            <?php else: ?>
                    <ins class="adsbygoogle"
                        style="display:block"
                        data-ad-format="autorelaxed"
                        data-ad-client="ca-pub-1872274200889143"
                        data-ad-slot="7752126381"
                        data-matched-content-rows-num="5,3"
                        data-matched-content-columns-num="1,3"
                        data-matched-content-ui-type="image_sidebyside,image_stacked">
                    </ins>
            <?php endif; ?>
                </div>
        <?php endif; */ ?>
            <?php
                /*
                if(in_category('lostmortal')){
                    $ppp = '6';
                }else{
                    $ppp = '3';
                }
                */
                $related = get_posts( array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,//$ppp,
                    'post__not_in' => array( $post->ID ),
                    'category__in' => $cat2->term_id,
                    'orderby' => 'rand',
                    'suppress_filters'=> false
                ) );
                //if(in_category('lostmortal')):
            ?>
				<ul class="entry__related related">
            <?php 
                foreach($related as $post):
                    setup_postdata($post); 
            ?>
					<li class="related__item">
						<a href="<?php the_permalink(); ?>">
                            <div class="related__thumb">
 			<?php 
				if (has_post_thumbnail()) {
					$related_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail');
            ?>
                <?php if(isset($_GET['amp'])): ?>
                                <amp-img src="<?php echo $related_thumb[0]; ?>" alt="<?php the_title(); ?>" width="133" height="73"></amp-img>
                <?php else: ?>
                                <img src="<?php echo $related_thumb[0]; ?>" alt="<?php the_title(); ?>" width="133" height="73" loading="lazy">
                <?php endif; ?>
			<?php }else{ ?>
                <?php if(isset($_GET['amp'])): ?>
                                <amp-img src="<?php echo get_template_directory_uri(); ?>/asset/img/noimg.svg" alt="no image" width="130" height="73"></amp-img>
                <?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/asset/img/noimg.svg" alt="no image" width="133" height="73" loading="lazy">
                <?php endif; ?>
			<?php }; ?>
                            </div>
							<div class="related__title">
								<?php the_title(); ?>
							</div>
						</a>
					</li>
        <?php endforeach; /* endif; */ wp_reset_query(); ?>
				</ul>
			</aside>
<?php endwhile; endif; ?>
		</article>
	</div>
    <?php if(wp_is_mobile()) { get_sidebar(); } else { get_template_part('sidebar_pc'); } ?>
</main>
    
</div>

<?php get_footer(); ?>

<script type="application/ld+json">
[
    {
        "@context": "https://schema.org",
        "@type": "<?php if(in_category(array('lostmortal','sale'))): ?>NewsArticle<?php else: ?>BlogPosting<?php endif; ?>",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "<?php echo get_the_permalink(); ?>"
        },
        "headline": "<?php the_title(); ?>",
        "description": "<?php echo get_the_excerpt(); ?>",
        "datePublished": "<?php the_time('Y-m-d'); ?>",
        "dateModified": "<?php the_modified_date(); ?>",
        "author": {
            "@type": "Person",
            "name": "Tomoki Tanaka"
        },
        "publisher": {
            "@type": "Organization",
            "name": "Lostmortal",
            "logo": {
                "@type": "ImageObject",
                "url": "<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/jksample.jpg",
                "width": 1500,
                "height": 1500
            }
        },
        "image": {
            "@type": "ImageObject",
            "url": "<?php echo get_the_post_thumbnail_url(); ?>",
            "width": 680,
            "height": 383
        }
    },
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "item": {
                    "@id": "https://lostmortal.info/",
                    "name": "Lostmortal"
                }
            },
            {
                "@type": "ListItem",
                "position": 2,
                "item": {
                    "@id": "<?php echo get_category_link( $cat->term_id ); ?>",
                    "name": "<?php echo $cat->cat_name; ?>"
                }
            }<?php if($cat2!=$category[0]): ?>,
            {
                "@type": "ListItem",
                "position": 3,
                "item": {
                    "@id": "<?php echo get_category_link( $cat2->term_id ); ?>",
                    "name": "<?php echo $cat2->cat_name; ?>"
                }
            }<?php endif; ?>
        ]
    }<?php if($youtube_id): ?>,
    {
        "@context": "https://schema.org",
        "@type": "VideoObject",
        "name": "<?php echo $video_title; ?>",
        "description": "<?php echo $video_desc; ?>",
        "thumbnailUrl": "<?php echo $video_thumb; ?>",
        "uploadDate": "<?php echo $video_date; ?>",
        "duration": "<?php echo $video_duration; ?>",
        "embedUrl": "https://youtu.be/<?php echo $youtube_id; ?>",
        "interactionStatistic": {
            "@type": "InteractionCounter",
            "interactionType": { 
                "@type": "http://schema.org/WatchAction"
            },
            "userInteractionCount": <?php echo $video_count; ?>
        }
    }<?php endif; ?>
]
</script>