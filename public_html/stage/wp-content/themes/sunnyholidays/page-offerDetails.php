<?php
/**
 * Template Name: Offer Details
 */

$data = get_offer_details(registry()->request()->getParam('type', ""), registry()->request()->getParam('offer_id', ""));

if ($data['is_post']) {
	header('Location: '.$data['content']->guid);
}

$preview_count = 3;

get_header(); ?>
<div id="content" class="grid_12">

	<?php foreach ($data["content"] as $hotel) { ?>	

		<h1><?php echo $hotel['title'] ?></h1>
		<h2>Tophotels rating: <?php echo $hotel['tophotels_rating'] ?></h2>
		<div id="gallery" style="width: 990px;">
			<ul class="portfolio">
				<?php $i = 0; foreach ($hotel['images'] as $image) { $i++; ?>
				<li class="<?php echo $addclass; ?>">	
					<span class="image-border">
						<a class="image-wrap" href="<?php echo $image; ?>" rel="prettyPhoto[gallery]" title="Hotel Photo">
							<img src="<?php echo $image; ?>" /><span class="zoom-icon"></span>
						</a>	
					</span>
				</li>	
				<?php
				if ($i >= $preview_count) break; 
				} ?>
			</ul>
			
			<?php $i = 0; foreach ($hotel['images'] as $image) { 
					$i++;
					if ($i > $preview_count) { ?>
						<a class="image-wrap" href="<?php echo $image; ?>" rel="prettyPhoto[gallery]"></a>	
					<?php } } ?>
			<div class="clear"></div>
		</div>
		<div id="page-content">
			<?php echo $hotel['content']; ?>
		</div>
	<?php } ?>
	
	<?php foreach ($data['airports'] as $k => $air) { ?>
		<p><b><?php echo $air; ?></b></p>
	<?php }?>

</div><!--#content-->
<?php get_footer(); ?>
