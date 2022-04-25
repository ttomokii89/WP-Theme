<?php if(is_front_page()): ?>
    <meta property="og:title" content="<?php bloginfo( 'name' ); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo get_home_url(); ?>">
    <meta property="og:image" content="<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/jksample.jpg">
    <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
    <meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
    <meta name="twitter:card" content="summary">
<?php elseif(is_single()): ?>
    <meta property="og:title" content="<?php the_title(); ?> | <?php bloginfo('name'); ?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?php echo get_the_permalink(); ?>">
    <meta property="og:image" content="<?php echo get_the_post_thumbnail_url(); ?>">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    <meta property="og:description" content="<?php echo get_the_excerpt(); ?>">
    <meta name="twitter:card" content="summary_large_image">
<?php elseif(is_page() && !is_page('blog')): ?>
    <meta property="og:title" content="<?php the_title(); ?> | <?php bloginfo('name'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo get_the_permalink(); ?>">
    <meta property="og:image" content="<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/jksample.jpg">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    <meta property="og:description" content="The introduction about <?php the_title(); ?> / <?php the_title(); ?>について紹介します。">
    <meta name="twitter:card" content="summary">
<?php endif; ?>