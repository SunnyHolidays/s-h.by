<div id="comments">
    <?php wp_list_comments( array( 'callback' => 'sunnyholidays2_comment', 'style' => 'ol' ) ); ?>
</div>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    <div id="pagination">
        <?php paginate_comments_links( array(
                'prev_text'    => '&lsaquo;',
                'next_text'    => '&rsaquo;',
            )); ?>
    </div>
<?php endif; // check for comment navigation ?>



<?php comment_form(); ?>