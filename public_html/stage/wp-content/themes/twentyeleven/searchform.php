<?php
/**
 * The template for displaying search forms in Twenty Eleven
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<!--
		<label for="s" class="assistive-text"><?php _e( 'Search', 'twentyeleven' ); ?></label>
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'twentyeleven' ); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'twentyeleven' ); ?>" />
		 -->
		 
		 <input type="text" class="field" name="par_adt" id="par_adt" placeholder="<?php esc_attr_e( 'number of adults', 'twentyeleven' ); ?>" value="<?php esc_attr_e(registry()->request()->getParam('par_adt', "")) ?>" />
		 <input type="text" class="field" name="trp_depDateStart" id="trp_depDateStart" placeholder="<?php esc_attr_e( 'start date', 'twentyeleven' ); ?>" value="<?php esc_attr_e(registry()->request()->getParam('trp_depDateStart', "")) ?>" />
		 <input type="text" class="field" name="trp_depDateEnd" id="trp_depDateEnd" placeholder="<?php esc_attr_e( 'end date', 'twentyeleven' ); ?>" value="<?php esc_attr_e(registry()->request()->getParam('trp_depDateEnd', "")) ?>" />
		 
		 <input type="hidden" name="s" id="s" value="1" />
		 <input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'twentyeleven' ); ?>" />
	</form>
