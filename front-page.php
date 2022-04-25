<?php get_header(); ?>

<div class="container">

<main class="content content--index">
<div class="main-column">
        
<?php //おすすめ
    $sticky_posts = get_option('sticky_posts');
    if( $sticky_posts ):
?>
    <section class="content-wrap">
        <h2 class="content-title">おすすめ記事</h2>
        <ul class="entry-list">
        <?php 
            foreach ( $sticky_posts as $post ):
                setup_postdata( $post );
                $setting = ['cat'=>false,'date'=>false,'desc'=>true]; //setting
                set_query_var('setting', $setting); //settingを渡す
                get_template_part('components/entry-list__item');
            endforeach; 
            wp_reset_postdata();
        ?>
        </ul>
    </section>
<?php endif; ?>

<?php //お知らせ
    $news_arg = array(
        'posts_per_page' => 2,
        'category_name' => 'lostmortal',
        'suppress_filters'=> false
    );
    $news_posts = get_posts( $news_arg );
    if( $news_posts ):
?>
    <section class="content-wrap">
        <h2 class="content-title">Notification/お知らせ</h2>
        <ul class="entry-list">
        <?php 
            foreach ( $news_posts as $post ):
                setup_postdata( $post );
                $setting = ['cat'=>false,'date'=>true,'desc'=>false]; //setting
                set_query_var('setting', $setting); //settingを渡す
                get_template_part('components/entry-list__item');
            endforeach;
            wp_reset_postdata();
        ?>
        </ul>
        <a class="readmore" href="/category/lostmortal">もっと見る</a>
    </section>
<?php endif; ?>

<?php //セール情報
    $sale_arg = array(
        'posts_per_page' => 2,
        'category_name' => 'sale',
        'suppress_filters'=> false
    );
    $sale_posts = get_posts( $sale_arg );
    if( $sale_posts ):
?>
<section class="content-wrap">
    <h2 class="content-title">Sale/セール情報</h2>
    <ul class="entry-list entry-list--index">
    <?php 
        foreach ( $sale_posts as $post ):
            setup_postdata( $post );
            $setting = ['cat'=>false,'date'=>true,'desc'=>false]; //setting
            set_query_var('setting', $setting); //settingを渡す
            get_template_part('components/entry-list__item');
        endforeach;
        wp_reset_postdata();
    ?>
    </ul>
    <a class="readmore" href="/category/sale">もっと見る</a>
</section>
<?php endif; ?>

<?php //ブログ
    $blog_arg = array(
        'posts_per_page' => 12,
        'cat' => '-20, -1207',
        'suppress_filters'=> false
    );
    $blog_posts = get_posts( $blog_arg );
    if( $blog_posts ):
?>
    <section class="content-wrap">
        <h2 class="content-title">Blog/ブログ記事</h2>
        <ul class="entry-list">
        <?php
            foreach ( $blog_posts as $post ):
                setup_postdata( $post );
                $setting = ['cat'=>true,'date'=>true,'desc'=>true]; //setting
                set_query_var('setting', $setting); //settingを渡す
                get_template_part('components/entry-list__item');
            endforeach;
            wp_reset_postdata();
        ?>
        </ul>
        <a class="readmore" href="/blog/page/2">もっと見る</a>
    <?php endif; ?>
    </section>
        
</div>

<?php if(wp_is_mobile()) { get_sidebar(); } else { get_template_part('sidebar_pc'); } ?>

</main>

</div>

<?php get_footer(); ?>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebSite",
    "url": "<?php echo get_home_url(); ?>",
    "name": "<?php bloginfo('name'); ?>",
    "description": "<?php bloginfo('description'); ?>",
    "publisher": {
        "@type": "Organization",
        "name": "Lostmortal",
        "logo": {
            "@type": "ImageObject",
            "url": "<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/jksample.jpg",
            "width": 1500,
            "height": 1500
        }
    },
    "image": {
        "@type": "ImageObject",
        "url": "<?php echo get_home_url(); ?>/wp-content/uploads/2018/08/jksample.jpg",
        "width": 1500,
        "height": 1500
    }
}
</script>