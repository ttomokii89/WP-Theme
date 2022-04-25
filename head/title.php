<?php if(is_front_page()): ?>

<?php bloginfo('name'); ?>

<?php elseif(is_single()): ?>

<?php the_title(); ?>

<?php elseif(is_page('blog')): ?>

<?php if (is_paged()): ?>Page <?php echo get_query_var('paged'); ?> | <?php endif; ?>Blog | <?php bloginfo('name'); ?>

<?php elseif(is_page()): ?>

<?php the_title(); ?> | <?php bloginfo('name'); ?>

<?php elseif(is_category()): ?>

<?php if (is_paged()): ?>Page <?php echo get_query_var('paged'); ?> | <?php endif; ?>The posts of <?php single_cat_title(); ?> | <?php bloginfo('name'); ?>

<?php elseif(is_archive()): ?>

<?php if (is_paged()): ?>Page <?php echo get_query_var('paged'); ?> | <?php endif; ?>The articles of <?php echo get_the_archive_title();?> | <?php bloginfo('name'); ?>

<?php elseif(is_search()): ?>

<?php if (is_paged()): ?>Page <?php echo get_query_var('paged'); ?> | <?php endif; ?>The search results of <?php echo get_search_query(); ?> | <?php bloginfo('name'); ?>

<?php else: ?>

<?php bloginfo('name'); ?>

<?php endif; ?>