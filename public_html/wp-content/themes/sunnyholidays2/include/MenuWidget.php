<?php

/**
 * Created by PhpStorm.
 * User: v.romanovsky
 * Date: 28.11.13
 * Time: 16:46
 */
class MenuWidget extends WP_Widget
{
private $block='';
    /**
     * Register widget with WordPress.
     */
    function __construct()
    {
        parent::__construct(
            'page_title', // Base ID
            __('Виджет Подменю', 'text_domain'), // Name
            array('description' => __('Вывод меню 2 уровня', 'text_domain'),) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance )
    {
        $title = apply_filters( 'widget_title', $instance['title'] );
        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        $this->getBlock();
        echo $this->block;
        echo $args['after_widget'];
        unset($this->block);
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance)
    {

        $title = isset( $instance[ 'title' ] )  ? $instance[ 'title' ] : 'Подкатегории';

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

    <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance )
    {
        $instance = array();
        $instance['title'] = strip_tags( $new_instance['title'] );
        return $instance;
    }


    private function getBlock()
    {
        global $wp_query;
        $post_obj = $wp_query->get_queried_object();
        $Page_ID = $post_obj->ID;
        $mypages = get_pages(array('child_of' => $Page_ID, 'sort_order' => 'asc'));
        $this->block.= "<ul>";
        foreach ($mypages as $page) {
            $this->block.=" <li><a href='".get_page_link( $page->ID )."'>".$page->post_title."</a></li>";
        }
        $this->block.="</ul>";


    }
}