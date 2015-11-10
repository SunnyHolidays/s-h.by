<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<section id="primary">
			<div id="content" class="main">

			 <?php 
			 	$search_result = tsearch();
			 	foreach ($search_result as $sr) {
			?>		
			 	<div style="border: 1px solid grey; margin-bottom: 5px;">
			 		<table>
			 			<tr>
			 				<td colspan="2"><b><?php echo $sr['name']; ?></b></td>
			 			</tr>
			 			<tr>
			 				<td>Country:</td><td><?php echo $sr['country']; ?></td>
			 			</tr>
			 			<tr>
			 				<td>Region:</td><td><?php echo $sr['region']; ?></td>
			 			</tr>
			 			<tr>
			 				<td>City:</td><td><?php echo $sr['city']; ?></td>
			 			</tr>
			 			<tr>
			 				<td>Room:</td><td><?php echo $sr['roomDesc']; ?></td>
			 			</tr>
			 		</table>
				</div>
			<?php } ?>
			 
			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>