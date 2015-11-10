<?php
// =============================== My Recent Posts (News widget) ======================================
class MY_PostWidget extends WP_Widget {
    /** constructor */
    function MY_PostWidget() {
        parent::WP_Widget(false, $name = 'My - Recent Posts');	
    }

  /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
				$category = apply_filters('widget_category', $instance['category']);
				$linktext = apply_filters('widget_linktext', $instance['linktext']);
				$linkurl = apply_filters('widget_linkurl', $instance['linkurl']);
				$count = apply_filters('widget_count', $instance['count']);
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
						
						<?php  $temp = $wp_query;
									 $wp_query= null;
									 $wp_query = new WP_Query();  ?>
						
								<ul class="latestpost">
								
								<?php $querycat = $category; ?>
								
								<?php $wp_query->query("showposts=". $count ."&category_name=". $querycat); ?>
								
								<?php if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post();?>
								<li>
								<h2><?php the_title(); ?></h2>
								<div class="excerpt"><?php $excerpt = get_the_excerpt(); echo my_string_limit_words($excerpt,38);?></div>
                <a href="<?php the_permalink() ?>" class="more"><?php _e('Read More', 'theme1404');?></a>
								</li>
								<?php endwhile; ?>
								</ul>
								<?php endif; ?>
								
								<?php $wp_query = null; $wp_query = $temp;?>
								
								
								<!-- Link under post cycle -->
								<?php if($linkurl !=""){?>
									<a href="<?php echo $linkurl; ?>" class="button"><?php echo $linktext; ?></a>
								<?php } ?>

								
              <?php echo $after_widget; ?>
			 
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
      $title = esc_attr($instance['title']);
			$category = esc_attr($instance['category']);
			$linktext = esc_attr($instance['linktext']);
			$linkurl = esc_attr($instance['linkurl']);
			$count = esc_attr($instance['count']);
        ?>
      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'themeXXXX'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

      <p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category Slug:', 'themeXXXX'); ?> <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo $category; ?>" /></label></p>
      
      <p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Posts per page:'); ?><input class="widefat" style="width:30px; display:block; text-align:center" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>
			
			 <p><label for="<?php echo $this->get_field_id('linktext'); ?>"><?php _e('Link Text:', 'themeXXXX'); ?> <input class="widefat" id="<?php echo $this->get_field_id('linktext'); ?>" name="<?php echo $this->get_field_name('linktext'); ?>" type="text" value="<?php echo $linktext; ?>" /></label></p>
			 
			 <p><label for="<?php echo $this->get_field_id('linkurl'); ?>"><?php _e('Link Url:', 'themeXXXX'); ?> <input class="widefat" id="<?php echo $this->get_field_id('linkurl'); ?>" name="<?php echo $this->get_field_name('linkurl'); ?>" type="text" value="<?php echo $linkurl; ?>" /></label></p>
        <?php 
    }

} // class  Widget
?>