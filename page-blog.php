@layout('layout.layout')

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
	'cat' => '-20'
);
$the_query = new WP_Query($args);
$the_query->post_count = 12; 
?>

@section('title')
<?php if (is_paged()): ?>
    <?php echo get_query_var('paged'); ?>ページ目｜
<?php endif; ?>
Blog | <?php bloginfo( 'name' ); ?>
@endsection

@section('description')
<?php if (is_paged()): ?>
    <?php echo get_query_var('paged'); ?>ページ目｜
<?php endif; ?>
Lostmortal Webのブログ・コラム記事一覧ページです。DTMや音楽活動に関しての記事執筆を不定期で行っています。
@endsection

@section('content')

<main class="content">
	<div class="main-column">
        <h1 class="content-title">Blog/Column</h1>
		<ul class="entry-list entry-list--index">

<?php if ($the_query->have_posts()): while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<li class="entry-list__item">
                <section class="entry-list__info">
                    <h2 class="entry-list__title"><?php the_title(); ?></h2>
                    <p class="entry-list__excerpt"><?php echo get_the_excerpt(); ?></p>
                    <div class="entry-list__meta">
                        <time class="entry-list__time" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>">
                            <?php echo get_the_date(); ?>
                        </time>
                        <div class="entry-list__category">
                        <?php
                            $cats = get_the_category();
                            foreach($cats as $cat):
                        ?>
                            <span class="entry-list__category-item"><?php echo $cat->cat_name; ?></span>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </section>
                <div class="entry-list__thumb">
	<?php if (has_post_thumbnail()): ?>
					<?php the_post_thumbnail('thumbnail'); ?>
	<?php else: ?>
					<img src="<?php echo get_template_directory_uri(); ?>/asset/img/noimg.svg" alt="">
	<? endif; ?>
				</div>
				<a class="entry-list__link" href="<?php the_permalink(); ?>"></a>
			</li>
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
    <?php if(!$is_sp) { get_sidebar(); } else { get_template_part('sidebar_sp'); } ?>
</main>

@endsection