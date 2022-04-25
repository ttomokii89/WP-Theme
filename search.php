<?php
$args = array(
    'suppress_filters'=> false
);
global $wp_query;
$total_results = $wp_query->found_posts;
$search_query = get_search_query($args);
?>

<?php get_header(); ?>

<div class="container">

<main class="content">
	<div class="main-column">
        <h1 class="content-title">Search : <?php echo $search_query; ?></h1>
		<ul class="entry-list">
<?php if($total_results >0): if(have_posts()): while(have_posts()): the_post(); ?>
			<?php get_template_part('components/entry-list__item'); ?>
<?php endwhile; endif; else: ?>
            <li>No result.</li>
<?php endif; ?>
		</ul>
		<div class="pager">
			<?php the_posts_pagination( array(
				'mid_size' => 2,
				'prev_text' => (''),
				'next_text' => (''),
				'screen_reader_text' => ('')
			) ); ?>
		</div>
	</div>
    <?php if(wp_is_mobile()) { get_sidebar(); } else { get_template_part('sidebar_pc'); } ?>
</main>
    
</div>

<?php get_footer(); ?>