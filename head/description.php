<?php
if(is_paged()){
    $paged = 'Page ' . get_query_var('paged') . ' | ';
}else{
    $paged = '';
}
if(is_front_page()): ?>

<meta name="description" content="<?php bloginfo( 'description' ); ?>">

<?php elseif(is_single()): ?>

<meta name="description" content="<?php echo get_the_excerpt(); ?>">

<?php elseif(is_page_template('blog.php')): ?>

<meta name="description" content="<?php echo $paged . 'Lostmortalのブログ記事一覧ページです。DTMや音楽活動に関する話題を発信しています。';?>">

<?php elseif(is_page()): ?>

<meta name="description" content="The introduction about <?php the_title(); ?> / <?php the_title(); ?>について紹介します。">

<?php elseif(is_category()): ?>

<meta name="description" content="<?php echo $paged; ?>The posts of category : <?php single_cat_title(); ?>">

<?php elseif(is_archive()): ?>

<meta name="description" content="<?php echo $paged; ?>The posts of <?php the_archive_title('',''); ?>">

<?php elseif(is_search()): ?>

<meta name="description" content="<?php echo $paged; ?>The search results of <?php echo get_search_query(); ?>">

<?php elseif(is_404()): ?>

<meta name="description" content="404 Page Not Found">

<?php endif; ?>

