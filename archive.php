<?php
$args = array(
    'suppress_filters'=> false
);
$the_query = new WP_Query($args);
?>

<?php get_header(); ?>

<div class="container">

<main class="content">
	<div class="main-column">
        <h1 class="content-title"><?php the_archive_title('','');?></h1>
		<ul class="entry-list">
<?php if (have_posts()): while (have_posts()): the_post(); ?>
			<?php get_template_part('components/entry-list__item'); ?>
<?php endwhile; endif; ?>
		</ul>
		<div class="pager">
			<?php the_posts_pagination( array(
				'mid_size' => 1,
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