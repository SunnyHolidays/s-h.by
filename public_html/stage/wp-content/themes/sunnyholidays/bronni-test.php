<?php
/**
 * Template Name: Bronni Test
 */
get_header(); ?>

<div id="content" class="grid_9 <?php echo of_get_option('blog_sidebar_pos') ?>">
  
  <!-- <h1>Search for: "<?php the_search_query(); ?>"</h1>  -->
  
  <?php $search_result = bronni_search();
  	if (count($search_result) > 0) {
  		foreach ($search_result as $sr) { ?>
  		
    <article id="post-<?php echo $sr['id']; ?>" >
      <header>
        <h2>
        	<a href="/offer-details/?type=<?php echo $sr['api_id']; ?>&offer_id=<?php echo $sr['id']; ?>" title="<?php echo $sr['name']; ?>" rel="bookmark">
        		<?php 
        			echo $sr['name'];
        			if ($sr['rating'] != '') echo '&nbsp;('. $sr['rating'] . ')';
        		?>
        	</a>
        </h2>
        <div class="post-meta">
			<div class="fleft">Tour operator: <?php echo $sr['tour_operator']; ?> | <time datetime="<?php echo $sr['start_date']; ?>"><?php echo $sr['start_date'] ?></time></div>
			<div class="fright"></div>
		</div>
      </header>
      <?php	/*echo '<figure class="featured-thumbnail"><span class="img-wrap"><a href="#">';
			echo '<img src="http://tourist/wp-content/uploads/2011/11/Coastal-South-Carolina-1-216x87.jpg" />';
			echo '</a></span></figure>'; */ ?>
      
      <div class="post-content">
          <div class="excerpt">
	          <b>Price:&nbsp;&nbsp;$<?php echo $sr['price']; ?></b><br/>
	          <b>Country:</b>&nbsp;&nbsp;<?php echo $sr['country']; ?>;
	          &nbsp;&nbsp;<b>City:</b>&nbsp;&nbsp;<?php echo $sr['city']; ?>;
	          &nbsp;&nbsp;<b>Duration:</b>&nbsp;&nbsp;<?php echo $sr['duration'].'d'; ?>;
          </div>
          <a href="/offer-details/?type=<?php echo $sr['api_id']; ?>&offer_id=<?php echo $sr['id']; ?>" class="button">Read more</a>
      </div>
    </article>

  <?php } } else { ?>
    <div class="no-results">
      <h2>No Results</h2>
      <p>Please feel free try again!</p>
      <?php get_search_form(); ?> <!-- outputs the default Wordpress search form-->
    </div><!--noResults-->
  <?php } ?>

</div><!-- #content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
