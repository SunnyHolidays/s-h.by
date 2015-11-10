  	</div><!--.container-->
  </div><!--.primary_content_wrap-->
	<footer id="footer">
		<div id="widget-footer" >
    	<div class="container_12 clearfix">
      	<div class="grid_3">
        	<?php if ( ! dynamic_sidebar( 'First Footer Area' ) ) : ?>
            <!--Widgetized Footer-->
          <?php endif ?>
        </div>
        <div class="grid_6">
        	<?php if ( ! dynamic_sidebar( 'Second Footer Area' ) ) : ?>
            <!--Widgetized Footer-->
          <?php endif ?>
        </div>
        <div class="grid_3">
        	<?php if ( ! dynamic_sidebar( 'Third Footer Area' ) ) : ?>
            <!--Widgetized Footer-->
          <?php endif ?>
        </div>
      </div>
		</div><!--.container-->
    <div id="copyright">
    	<div class="container_12 clearfix">
      	<?php $myfooter_text = of_get_option('footer_text'); ?>
				<?php if($myfooter_text){?>
          <?php echo of_get_option('footer_text'); ?>
        <?php } else { ?>
          <?php bloginfo('name'); ?> &copy; <?php echo date("Y"); ?> <a href="<?php bloginfo('url'); ?>/privacy-policy/" title="Privacy Policy">Privacy Policy</a>
        <?php } ?>

        <?php // if( is_front_page() ) { ?>
        <!-- More <a rel="nofollow" href="http://www.templatemonster.com/category/travel-agency-wordpress-themes/" target="_blank">Travel Agency WordPress Themes at TemplateMonster.com</a> -->
        <?php //} ?>
        
        <?php if ( of_get_option('footer_menu') == 'true') { ?>  
          <nav class="footer">
						<?php wp_nav_menu( array(
              'container'       => 'ul', 
              'menu_class'      => 'footer-nav', 
              'depth'           => 0,
              'theme_location' => 'footer_menu' 
              )); 
            ?>
          </nav>
        <?php } ?>
      </div>
    </div>
	</footer>
</div><!--#main-->
<?php wp_footer(); ?> <!-- this is used by many Wordpress features and for plugins to work proporly -->
<?php if(of_get_option('ga_code')) { ?>
	<script type="text/javascript">
		<?php echo stripslashes(of_get_option('ga_code')); ?>
	</script>
  <!-- Show Google Analytics -->	
<?php } ?>
</body>
</html>