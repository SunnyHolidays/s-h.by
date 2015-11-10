<div class="search">
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" class="search-box" name="s" id="s" placeholder="Поиск по сайту">
    <input style="display:none" type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'twentyeleven' ); ?>" />
</form>
</div>