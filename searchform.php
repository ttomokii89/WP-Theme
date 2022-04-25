<form class="search" method="get" action="<?php echo home_url('/'); ?>" >
    <input class="search__input s" name="s" type="text" value="" placeholder="<?php if(get_locale() == 'ja'): ?>検索ワードを入力<?php else: ?>Enter Keywords<?php endif; ?>" aria-label="Searchwords">
	<input class="search__submit" type="submit" value="" aria-label="Search">
</form>