<?php

add_action( 'wp_enqueue_scripts', 'algibro_shop_enqueue_styles' );
function algibro_shop_enqueue_styles() {
	wp_enqueue_style( 'algibro_shop-font', algibro_shop_fonts_url(), array(), null );
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


	$post_image_placeholder = $wp_customize->get_setting( 'azera_shop_post_image_placeholder' );
	if( empty($post_image_placeholder) ){
		$wp_customize->add_setting( 'azera_shop_post_image_placeholder', array(
			'default' => azera_shop_get_file('/images/no-thumbnail.jpg'),
			'sanitize_callback' => 'esc_url'
		));

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'azera_shop_post_image_placeholder', array(
			'label'    => esc_html__( 'Post image placeholder', 'azera-shop' ),
			'section'  => 'azera_shop_general_section',
			'priority'    => 8
		)));
	}

}
add_action( 'customize_register', 'algibro_shop_customize_register' , 99 );


function algibro_shop_fonts_url(){
	$fonts_url = '';
	$font_families = array();

	/* Translators: If there are characters in your language that are not
	* supported by Source Sans Pro, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'algibro-shop' );

	if ( 'off' !== $source_sans_pro ) {

		$font_families[] = 'Source Sans Pro:300,400,600,700';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}
