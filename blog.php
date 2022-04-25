<?php
/*
Template Name: blog
*/
?>

<?php
$paged = (int) get_query_var('paged');
$args = array(
	'posts_per_page' => 12,
	'paged' => $paged,
	'cat' => '-20, -1207',
    'suppress_filters'=> false
);
$the_query = new WP_Query($args);
$the_query->post_count = 12; 
?>

<?php get_header(); ?>

<div class="container">

<main class="content">
	<div class="main-column">
        <h1 class="content-title">Blog/ブログ記事</h1>
		<ul class="entry-list">
<?php if ($the_query->have_posts()): while ($the_query->have_posts()): $the_query->the_post(); ?>
			<?php get_template_part('components/entry-list__item'); ?>
<?php endwhile; endif; ?>
		</ul>
		<div class="pager">
			<?php
                $GLOBALS['wp_query']->max_num_pages = $the_query->max_num_pages;
                the_posts_pagination( array(
                    'mid_size' => '1',
                    'prev_text' => (''),
                    'next_text' => (''),
                    'screen_reader_text' => ('')
                ) );
            ?>
		</div>
	</div>
    <?php if(wp_is_mobile()) { get_sidebar(); } else { get_template_part('sidebar_pc'); } ?>
</main>
    
</div>

<?php get_footer(); ?>