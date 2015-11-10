<?php
/**
 * Template Name: Mail Success
 */

?>
<!DOCTYPE html>
<html>
<head>
    <title>SunnyHolidays</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="UTF-8" />
    
	<link rel="icon" href="<?php bloginfo( 'template_url' ); ?>/favicon_sunn.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/grid.css" />
	</head>
<body>
<div id="main">
	<div class="primary_content_wrap">
		<div class="container_12 clearfix">
			<div id="content" class="grid_12">
			<?php if (have_posts()) : while (have_posts()) : the_post();?>
				<?php the_content(); ?>
			 <?php endwhile; endif; ?>
			</div>
		</div>	
	</div>
</div>
</body>
</html>		