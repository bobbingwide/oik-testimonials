<?php // (C) Copyright Bobbing Wide 2013

/** 
 * Return the next unique ID for the testimonial selector
 */
function bw_testimonial_id() { 
  static $testimonial_id = 0;
  $testimonial_id++;
  return( "bw_testimonial-$testimonial_id" );
}

/**
 * Create the jQuery code to cycle the selection, including the starting div
 * 
 */
function bw_testimonials_jq( $atts ) {
  oik_require( "shortcodes/oik-jquery.php" );
  $debug = bw_array_get( $atts, "debug", false );
  $script = bw_array_get( $atts, "script", "cycle.all" );
  $method = bw_array_get( $atts, "method", "cycle" );
  bw_jquery_enqueue_script( $script, $debug );
  // bw_jquery_enqueue_style( $script );
  
  // bw_jquery( $selector, $method, $parms, $windowload );
  $selector = bw_testimonial_id();
  bw_jquery( "#$selector", $method );
  $class = bw_array_get( $atts, "class", "bw_testimonial" );
  sdiv( $class, $selector );
} 
 

/**
 * Implement [bw_testimonials] shortcode
 */
function bw_testimonials( $atts=null, $content=null, $tag=null ) {
  bw_testimonials_jq( $atts ); 
  $atts['numberposts'] = bw_array_get( $atts, "numberposts", 5 );
  $atts['post_type'] = bw_array_get( $atts, "post_type", "oik_testimonials" );
  $atts['orderby'] = bw_array_get( $atts, "orderby", "random" );
  $atts['post_parent'] = 0;
  oik_require( "shortcodes/oik-pages.php" );
  e( bw_pages( $atts ));
  ediv();
  return( bw_ret()); 
} 

/**
 * Help hook for [bw_testimonials] 
 */
function bw_testimonials__help( $shortcode="bw_testimonials" ) {
  return( "Display testimonials" );
}

function bw_testimonials__syntax( $shortcode="bw_testimonials" ) {
  $syntax = array( "numberposts" => bw_skv( 5, "<i>number</i>", "Number of posts to show" )
                 , "script" => bw_skv( "cycle.all", "<i>script</i>", "jQuery script" ) 
                 , "method" => bw_skv( "cycle", "<i>method</i>", "jQuery method " )
                 , "class" => bw_skv( $shortcode, "CSS classes", "CSS classes" )
                 );
  $syntax += _sc_posts(); 
  $syntax['post_type'] = bw_skv( "oik_testimonials", "<i>post_type</i>", "Post type to select" );
  $syntax['orderby'] = bw_skv( "random", "date|title|author", "Order by" );
  $syntax['order'] = bw_skv( "ASC", "DESC", "Order" );
  return( $syntax );
}                   


