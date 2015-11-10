<?php
/**
 * Template Name: Home Page
 */

get_header(); ?>


<div id="top-content-area" class="container_12 clearfix">
	<?php if ( ! dynamic_sidebar( 'First Content Area' ) ) : ?>
    <!--Widgetized 'First Content Area' for the home page-->
  <?php endif ?>
</div>
<div id="middle-content-area" class="container_12 clearfix">
	<div class="grid_3">
  	<?php if ( ! dynamic_sidebar( 'Second Content Area' ) ) : ?>
      <!--Widgetized 'Second Content Area' for the home page-->
    <?php endif ?>
  </div>
  <div class="grid_3">
  	<?php if ( ! dynamic_sidebar( 'Third Content Area' ) ) : ?>
      <!--Widgetized 'Third Content Area' for the home page-->
    <?php endif ?>
  </div>
  <div class="grid_6">
  	<?php if ( ! dynamic_sidebar( 'Fourth Content Area' ) ) : ?>
      <!--Widgetized 'Fourth Content Area' for the home page-->
    <?php endif ?>
  </div>
</div>

<?php get_footer(); ?>