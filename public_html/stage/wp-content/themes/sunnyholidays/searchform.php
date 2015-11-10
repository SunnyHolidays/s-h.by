<script>
$(function() {
	$( ".jqdate" ).datepicker({ dateFormat: "yy-mm-dd" });
});
</script>    
<form method="get" id="searchform" action="<?php bloginfo('home'); ?>">

<!-- <input type="text" class="searching" value="<?php the_search_query(); ?>" name="s" id="s" /><input class="submit" type="submit" value="Search" /> -->

		 <?php $regions = get_regions(); ?>
		 <select name="destination" id="destination" class="searching" style="width: 208px;">
		 	<option value="">Select Region</option>
		 	<?php foreach ($regions as $region) {?>
		 		<option value="<?php echo $region['id']; ?>" <?php if (registry()->request()->getParam('destination', "") == $region['id']) echo 'selected'; ?>><?php echo $region['region']; ?></option>
		 	<?php } ?>
		 </select>
		 <input type="text" class="searching" name="adt" id="adt" placeholder="<?php esc_attr_e( 'Number of Adults' ); ?>" value="<?php esc_attr_e(registry()->request()->getParam('adt', "")) ?>" />
		 <input type="text" class="searching jqdate" name="date_start" id="date_start" placeholder="<?php esc_attr_e( 'Start Date' ); ?>" value="<?php esc_attr_e(registry()->request()->getParam('date_start', "")) ?>" />
		 <input type="text" class="searching jqdate" name="date_end" id="date_end" placeholder="<?php esc_attr_e( 'End Date' ); ?>" value="<?php esc_attr_e(registry()->request()->getParam('date_end', "")) ?>" />
		 
		 <input type="hidden" name="s" id="s" value="1" />
		 <input class="submit" type="submit" value="Search" />
</form>
