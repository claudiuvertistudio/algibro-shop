<?php

add_action( 'wp_enqueue_scripts', 'algibro_shop_enqueue_styles' );
function algibro_shop_enqueue_styles() {
	wp_enqueue_style( 'algibro_shop-font', '//fonts.googleapis.com/css?family=Cabin:400,600|Open+Sans:400,300,600');
	wp_enqueue_style( 'algibro_shop-style',  get_template_directory_uri() . '/style.css', array(),'1.0.0');
	wp_enqueue_script( 'algibro_shop-custom-js', get_stylesheet_directory_uri() . '/js/custom-script.js', array('jquery'), '1.0.0', true );

	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/css/bootstrap.min.css' );

}

function algibro_shop_widgets_init() {
	register_sidebar( 
		array(
			'name'          => esc_html__( 'Header Sidebar', 'algibro-shop' ),
			'id'            => 'header-sidebar',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget header-widget %2$s">',
			'after_widget'  => '</div></aside>',
			'before_title'  => '<h2 class="widget-title header-widget-title"><i class="glyphicon glyphicon-shopping-cart"></i><span>',
			'after_title'   => '</span></h2><div class="widget-header-content">',
		)
	);	
}
add_action( 'widgets_init', 'algibro_shop_widgets_init' );

function algibro_shop_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'azera_shop_header_title' )->default = esc_html__('Algibro Shop','algibro-shop');
}
add_action( 'customize_register', 'algibro_shop_customize_register' , 99 );