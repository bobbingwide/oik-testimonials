<?php
/*
Plugin Name: oik-testimonials 
Plugin URI: http://www.oik-plugins.com/oik-plugins/oik-testimonials.php
Description: "better by far" oik testimonials 
Depends: oik base plugin, oik fields
Version: 0.1
Author: bobbingwide
Author URI: http://www.bobbingwide.com
License: GPL2

    Copyright 2012-2013 Bobbing Wide (email : herb@bobbingwide.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2,
    as published by the Free Software Foundation.

    You may NOT assume that you can use any other version of the GPL.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    The license for this software can likely be found here:
    http://www.gnu.org/licenses/gpl-2.0.html

*/

add_action( 'oik_fields_loaded', 'oik_testimonials_init' );

/**
 * Implement "oik_fields_loaded" action for oik-testimonials 
 */
function oik_testimonials_init( ) {
  oik_register_oik_testimonials();
  bw_add_shortcode( "bw_testimonials", "bw_testimonials", oik_path( "shortcodes/oik-testimonials.php", "oik-testimonials" ), false );
}

/** 
 * Register custom post type "oik_testimonials" 
 *
 * The description is the content field - the testimonial
 * The title should contain the testimonial author name
 * _oik_testimonial_name should also be the author's name
 * 
 */
function oik_register_oik_testimonials() {
  $post_type = 'oik_testimonials';
  $post_type_args = array();
  $post_type_args['label'] = 'Testimonials';
  $post_type_args['description'] = 'Testimonials';
  $post_type_args['taxonomies'] = array( 'post_tag', 'category' );
  bw_register_post_type( $post_type, $post_type_args );
  bw_register_field( "_oik_testimonials_name", "text", "Author name" ); 
  bw_register_field_for_object_type( "_oik_testimonials_name", $post_type );
  
  //$taxonomy = 'post_tag'; 
  //bw_register_taxonomy( $taxonomy, $post_type, "Testimonial type" );
  //register_taxonomy_for_object_type( $taxonomy, $post_type );

  add_filter( "manage_edit-${post_type}_columns", "oik_testimonials_columns", 10, 2 );
  add_action( "manage_${post_type}_posts_custom_column", "bw_custom_column_admin", 10, 2 );
}

/**
 * Implement "manage_edit-oik_testimonials_column" for oik-testimonials
 */
function oik_testimonials_columns( $columns, $arg2 ) {
  $columns["_oik_testimonials_name"] = __("Author Name"); 
  bw_trace2();
  return( $columns ); 
} 

/**
 * Theme the _oik_testimonials_name field 
 */
function _bw_theme_field_default__oik_testimonials_name( $key, $value ) {
  e( $value[0] );
}

add_action( "admin_notices", "oik_testimonials_activation" );
/**
 * Implememt "admin_notices" action for oik_testimonials
 */ 
function oik_testimonials_activation() {
  static $plugin_basename = null;
  if ( !$plugin_basename ) {
    $plugin_basename = plugin_basename(__FILE__);
    add_action( "after_plugin_row_" . $plugin_basename, __FUNCTION__ );   
    require_once( "admin/oik-activation.php" );
  }  
  $depends = "oik:2.0-alpha,oik-fields";
  oik_plugin_lazy_activation( __FILE__, $depends, "oik_plugin_plugin_inactive" );
}





  

 
