<header class="header">
	<div class="header__body">
		<<?php if (is_front_page()): ?>h1<?php else: ?>div<?php endif; ?> class="header__logo">
			<a href="/<?php if (is_page('en')): ?>en<?php endif; ?>"><img src="<?php bloginfo('template_url') ?>/asset/img/logo.svg?111" alt="Lostmortal"></a>
		</<?php if (is_front_page()): ?>h1<?php else: ?>div<?php endif; ?>>
        <div class="header__lang">
<?php if (is_page('en')): ?>
            <a href="/">JP</a>/EN
<?php else: ?>
            JP/<a href="/en">EN</a>
<?php endif; ?>
        </div>
		<button class="header__menu-btn" id="js-menu-btn">開閉</button>
	</div>
    <nav class="menu" id="js-menu">
        <ul class="menu__list">
            <li class="menu__list-item"><a href="/about/">About<?php if (is_page('en')): ?> (JP)<?php endif; ?></a></li>
            <li class="menu__list-item"><a href="/category/lostmortal">News</a></li>
            <li class="menu__list-item"><a href="/music/">Discography</a></li>
            <li class="menu__list-item"><a href="https://lostmortal.info/blog">Blog</a></li>
    <?php if (!is_page('en')): ?>
            <li class="menu__list-item"><a href="/contact/">Contact</a></li>
    <?php endif; ?>
    <?php if ($is_sp): ?>
            <li class="menu__list-item"><a href="/">JP</a> / <a href="/en">EN</a></li>
    <?php endif; ?>
        </ul>
    </nav>
</header>