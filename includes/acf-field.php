<?php

/**
 * Generic display of an ACF field.
 *
 * @param $field_name
 * @param $post_id
 *
 * @return void*
 */

function acf_display_field( $field_name, $post_id ) {

	//$field_name=get_field( 'field-name' );
	$field     =get_field( $field_name, $post_id );
	//echo $field;
	$field_info= get_field_object( $field_name, $post_id );
	bw_trace2( $field_info, 'field_info');
	if ( $field_info ) {
		switch ( $field_info['type'] ) {
			case 'text':
				echo esc_html( $field );
				break;
			case 'image':
				acf_display_field_image( $field, $field_info );
				break;
			default:
				echo esc_html( $field );
		}
	}
}

function acf_display_field_image( $field, $field_info ) {
	echo "<img src=\"$field\"/>";
	//bw_format_attachment();_image
}
