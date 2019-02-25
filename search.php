@layout('layout.layout')

@section('title')
<?php if (is_paged()): ?>
    <?php echo get_query_var('paged'); ?>ページ目｜
<?php endif; ?>
<?php echo get_search_query(); ?>の検索結果 | <?php bloginfo( 'name' ); ?>
@endsection

@section('description')
<?php if (is_paged()): ?>
    <?php echo get_query_var('paged'); ?>ページ目｜
<?php endif; ?>
<?php echo get_search_query(); ?>の検索結果です。
@endsection

@section('addmeta')
<meta name="robots" content="noindex">
@endsection

@section('content')

<?php
    global $wp_query;
    $total_results = $wp_query->found_posts;
    $search_query = get_search_query();
?>

<main class="content">
	<div class="main-column">
		<h1 class="content-title"><?php echo $search_query; ?>の検索結果</h1>
		<ul class="entry-list" id="js-hover-group">
<?php if($total_results >0): if(have_posts()): while(have_posts()): the_post(); ?>
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
	<?php if (has_post_thumbnail()) : ?>
					<?php the_post_thumbnail('medium'); ?>
	<?php else: ?>
					<img class="related__thumb lazyload" data-src="<?php echo get_template_directory_uri(); ?>/asset/img/noimg.svg" alt="">
	<? endif; ?>
				</div>
				<a class="entry-list__link" href="<?php the_permalink(); ?>"></a>
			</li>
<?php endwhile; endif; else: ?>
            <li><?php echo $search_query; ?> に一致する情報は見つかりませんでした。</li>
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
    <?php if(!$is_sp) { get_sidebar(); } else { get_template_part('sidebar_sp'); } ?>
</main>

@endsection