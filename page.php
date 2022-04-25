<?php get_header(); ?>

<div class="container">

<main class="content">
	<div class="main-column">
		<article class="entry">
<?php if (have_posts()): while (have_posts()): the_post(); ?>
  			<header class="entry__header">
                <div class="entry__info">
				    <h1 class="entry__title entry__title--page"><?php the_title(); ?></h1>
                </div>
			</header>
            <section class="entry__body">
				<?php the_content(); ?>
			</section>
<?php endwhile; endif; ?>
		</article>
	</div>
    <?php if(wp_is_mobile()) { get_sidebar(); } else { get_template_part('sidebar_pc'); } ?>
</main>
    
</div>

<?php get_footer(); ?>