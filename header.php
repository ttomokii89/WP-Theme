<?php
//canonical
if(is_front_page()){
    $canonical_url  = home_url();
} elseif (is_page_template('blog.php')){
    $canonical_url  = home_url() . '/blog';
} elseif (is_single() || is_page() && !is_page_template('blog.php')) {
	$canonical_url = get_permalink();
} elseif (is_category()) {
    $canonical_url  = get_category_link(get_query_var('cat'));
}

//記事ページで取得するデータ
if (is_single()){
    $keywords = get_post_meta($post->ID, 'meta_keywords', true); //カスタムフィールド：meta keyword
    $custom_noindex = get_post_meta($post->ID, 'noindex', true); //カスタムフィールド：noindex
    if($custom_noindex === 'true'){
        $noindex = true;
    }
    $custom_expire = get_post_meta($post->ID, 'expire(Y-m-d)', true); //カスタムフィールド：有効期限
    if($custom_expire){
        $nowDate = date('Y-m-d');
        if (strtotime($nowDate) >= strtotime($custom_expire)){
            $noindex = true;
        }
    }
    /*
    if (in_category(array('lostmortal','sale'))){//タイムスタンプ取得 (https://url-c.com/tc/)
        date_default_timezone_set('Asia/Tokyo');
        if(in_category('lostmortal')){
            $time = 15552000; //180日
        }else if(in_category('sale')){
            $time = 5184000; //60日
        }
        if (date('U') - get_the_time('U') > $time){
            $noindex = true;
        }
    }
    */
}

//HTML圧縮
function compress_output($buffer) {
  $search = array(
    '/\>[^\S ]+/s',
    '/[^\S ]+\</s',
    '/(\s)+/s'
  );
  $replace = array(
    '>',
    '<',
    '\\1',
    ''
  );
  $buffer = preg_replace($search, $replace, $buffer);
  return $buffer;
}
ob_start("compress_output");
?>

<!doctype html>
<html lang="ja">
<head prefix="og: https://ogp.me/ns# fb: https://ogp.me/ns/fb# <?php if (is_single()): ?>article<?php else: ?>website<?php endif; ?>: https://ogp.me/ns/article#">
<meta charset="utf-8">

<?php if(!is_front_page()): //アドセンス ?>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1872274200889143"
     crossorigin="anonymous"></script>
<?php endif; ?>


<?php //GA ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-43110096-16"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-43110096-16');
</script>


<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
<?php get_template_part('head/description');?>

<?php if(is_single()): ?>
<meta name="referrer" content="no-referrer-when-downgrade"/>
    <?php if($keywords): ?>
<meta name="keywords" content="<?php echo $keywords; ?>">
    <?php endif; ?>
<meta http-equiv="x-dns-prefetch-control" content="on">
<link rel="dns-prefetch" href="//pagead2.googlesyndication.com">
<link rel="dns-prefetch" href="//googleads.g.doubleclick.net">
<link rel="dns-prefetch" href="//googleads4.g.doubleclick.net">
<link rel="dns-prefetch" href="//tpc.googlesyndication.com">
<link rel="dns-prefetch" href="//www.gstatic.com">
<meta property="og:title" content="<?php the_title(); ?>">
<meta property="og:type" content="article">
<meta property="og:url" content="<?php echo get_the_permalink(); ?>">
<meta property="og:image" content="<?php echo get_the_post_thumbnail_url(); ?>">
<meta property="og:site_name" content="<?php bloginfo('name'); ?>">
<meta property="og:description" content="<?php echo get_the_excerpt(); ?>">
<meta name="twitter:card" content="summary_large_image">	
<meta name="thumbnail" content="<?php echo get_the_post_thumbnail_url(); ?>">
<?php endif; ?>

<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?>">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="theme-color" content="#222">
    
<?php if($noindex === true): ?>
<meta name="robots" content="noindex">
<?php endif; ?>

<link rel="alternate" type="application/rss+xml" title="<?php echo bloginfo('name'); ?>&raquo;Feed" href="<?php bloginfo('rss2_url'); ?>">

<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/asset/img/apple_touch_icon.png" sizes="180x180">
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/asset/img/fav_48.png" sizes="48x48">

<?php if ($canonical_url): ?>
<link rel="canonical" href="<?php echo $canonical_url; ?>">
<?php endif; ?>

<?php wp_head(); ?>

</head>

<body>

<?php if (is_front_page()) { get_template_part('components/fv'); } else { get_template_part('components/header'); } ?>
