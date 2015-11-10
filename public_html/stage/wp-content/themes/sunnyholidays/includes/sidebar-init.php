<?php
function elegance_widgets_init() {
	// Header Widget
	// Location: right after the navigation
	register_sidebar(array(
		'name'					=> 'Header',
		'id' 						=> 'header-sidebar',
		'description'   => __( 'Located at the top of pages.'),
		'before_widget' => '<div id="%1$s" class="widget-header">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	// Before Content Area
	// Location: at the top of the content
	register_sidebar(array(
		'name'					=> 'Before Content Area',
		'id' 						=> 'before-content-area',
		'description'   => __( 'Located at the top of the content.'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	// First Content Area
	// Location: at the top of the content
	register_sidebar(array(
		'name'					=> 'First Content Area',
		'id' 						=> 'first-content-area',
		'description'   => __( 'Located at the top of the content.'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	
	
	// Second Content Area
	// Location: at the top of the content
	register_sidebar(array(
		'name'					=> 'Second Content Area',
		'id' 						=> 'second-content-area',
		'description'   => __( 'Located at the top of the content.'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	// Third Content Area
	// Location: at the top of the content
	register_sidebar(array(
		'name'					=> 'Third Content Area',
		'id' 						=> 'third-content-area',
		'description'   => __( 'Located at the top of the content.'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	// Fourth Content Area
	// Location: at the top of the content
	register_sidebar(array(
		'name'					=> 'Fourth Content Area',
		'id' 						=> 'fourth-content-area',
		'description'   => __( 'Located at the top of the content.'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	
	
	// Sidebar Widget
	// Location: the sidebar
	register_sidebar(array(
		'name'					=> 'Sidebar',
		'id' 						=> 'main-sidebar',
		'description'   => __( 'Located at the right side of pages.'),
		'before_widget' => '<div id="%1$s" class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	// First Footer Area
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
		'name'					=> 'First Footer Area',
		'id' 						=> 'first-footer-area',
		'description'   => __( 'Located at the bottom of pages.'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	// Second Footer Area
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
		'name'					=> 'Second Footer Area',
		'id' 						=> 'second-footer-area',
		'description'   => __( 'Located at the bottom of pages.'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	// Third Footer Area
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
		'name'					=> 'Third Footer Area',
		'id' 						=> 'Third-footer-area',
		'description'   => __( 'Located at the bottom of pages.'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	
	

}
/** Register sidebars by running elegance_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'elegance_widgets_init' );
?>