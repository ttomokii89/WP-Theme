<?php if(wp_is_mobile()){
    get_template_part('components/header');
} ?>
<div class="fv">
    <picture>
        <source class="fv__bg" type="image/webp" srcset="<?php bloginfo('template_url'); ?>/asset/img/fv_bg<?php if(wp_is_mobile()): ?>_sp<?php endif; ?>.webp">
        <img class="fv__bg" src="<?php bloginfo('template_url') ?>/asset/img/fv_bg<?php if(wp_is_mobile()): ?>_sp<?php endif; ?>.jpg" alt="<?php bloginfo('name'); ?>">
    </picture>
    <?php if(!wp_is_mobile()): ?>
    <h1 class="fv__logo">
        <?php if(isset($_GET['amp'])): ?>
        <amp-img src="<?php bloginfo('template_url') ?>/asset/img/logo.svg" alt="Lostmortal" width="130" height="13" layout="fixed"></amp-img>
        <?php else: ?>
        <img src="<?php bloginfo('template_url') ?>/asset/img/logo.svg" alt="Lostmortal" loading="eager">
        <?php endif; ?>
    </h1>
    <?php endif; ?>
</div>
<?php if(!wp_is_mobile()): ?>
<header class="header header--index">
    <nav>
        <ul class="header__menu">
            <li class="header__menuItem"><a href="/about">About</a></li>
            <li class="header__menuItem"><a href="/category/lostmortal">Notification</a></li>
            <li class="header__menuItem"><a href="/blog">Blog</a></li>
            <li class="header__menuItem"><a href="/music">Discography</a></li>
            <li class="header__menuItem"><a href="mailto:hardcoreforever777@gmail.com">Contact</a></li>
        </ul>
    </nav>
</header>
<?php endif; ?>