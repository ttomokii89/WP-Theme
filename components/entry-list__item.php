<?php
//カテゴリ取得
require '_getCategory.php';
?>

<li class="entry-list__item">
    <div class="entry-list__thumb">
    <?php if (has_post_thumbnail()): ?>
        <img class="lazyload" src="<?php the_post_thumbnail_url('full'); ?>" alt="thumbnail" width="285" height="160" loading="lazy">
    <?php else: ?>
        <img class="lazyload" src="<?php echo get_template_directory_uri(); ?>/asset/img/noimg.svg" alt="no image" width="285" height="160" loading="lazy">
    <?php endif; ?>
    </div>
    <section class="entry-list__info">
        <h2 class="entry-list__title"><?php the_title(); ?></h2>
<?php if($setting['desc'] && !wp_is_mobile()): ?>
        <p class="entry-list__excerpt"><?php echo get_the_excerpt(); ?></p>
<?php endif; ?>
<?php if($setting['cat'] || $setting['date']): ?>
        <div class="entry-list__meta">
        <?php if($setting['cat']): ?>
            <div class="entry-list__category">
                <span class="entry-list__category-item"><?php echo $cat2->cat_name; ?></span>
            </div>
        <?php endif; ?>
        <?php if($setting['date']): ?>
            <time class="entry-list__time" datetime="<?php echo get_the_date('Y-m-d'); ?>">
                <?php echo get_the_date(); ?>
            </time>
        <?php endif; ?>
        </div>
<?php endif; ?>
    </section>
    <a class="entry-list__link" href="<?php the_permalink(); ?>" aria-label="Read about this post"></a>
</li>