<?php

/**
 * @copyright (C) Copyright Bobbing Wide 2023
 * @package oik-testiminials
 * @depends ACF PRO
 */

/**
 * Generic display of an ACF field.
 *
 * - This logic should attempt to cater for all different field types.
 * - Except those it doesn't know about.
 * - So it should provide some hooks to enable other routines to do this.
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
				acf_format_value( $field, $post_id, $field_info );
				acf_display_field_image( $field, $field_info );
				break;
			default:
				echo esc_html( $field );
		}
	} else {
		echo "<p>Field $field_name not found for $post_id.";
		//echo "Is the field even defined?";
		echo '<br />';
		acf_list_possible_field_names( $field_name, $post_id );
		echo '</p>';
	}
}

/**
 * Gets the possible field names.
 *
 * @TODO The logic should cater for:
 * - fields that are defined for use in multiple post types
 * - posts, taxonomies, users
 * - but not blocks
 * - what about nested field group structures?
 * - or fields which are local?
 * - or ACF options
 *
 * How do we match locations? How does ACF determine if a field group should be displayed?
 * @param $field_name
 * @param $post_id
 *
 * @return array
 */
function acf_get_possible_field_names( $field_name, $post_id ) {

	//$location_types = acf_get_location_types();
	//bw_trace2($location_types, 'location types', false );

	$field_groups = acf_get_field_groups();

	bw_trace2($field_groups, 'field groups', false );
	$fields = [];
	foreach ( $field_groups as $field_group ) {
		$raw_fields = acf_get_fields( $field_group['ID']);
		bw_trace2( $raw_fields, 'raw_fields', false );
		foreach ( $raw_fields as $raw_field ) {
			$field_select_label = [];
			$field_select_label[] = $raw_field['label'];
			$field_select_label[] = $raw_field['key'];
			$field_select_label[] = $field_group['title'];
			$fields[ $raw_field['name'] ] = implode( ' ', $field_select_label );
		}
	}
	return $fields;

}

/**
 * Lists the possible ACF field names.
 *
 * The logic should cater for:
 * - fields that are defined for use in multiple post types,
 * - posts, taxonomies, users
 * - but not blocks
 * - what about nested field group structures?
 * - or fields which are local?
 *
 * @param $field_name
 * @param $post_id
 *
 * @return void
 */
function acf_list_possible_field_names( $field_name, $post_id ) {
	$field_names = acf_get_possible_field_names( $field_name, $post_id );
	//print_r( $field_names );
	//echo implode( '<br /> ', array_keys( $field_names  ) );
	foreach ( $field_names as $name => $value ) {
		echo "<br />$name $value";
	}
}

/**
 * Displays an ACF image.
 *
 * return_format | processing
 * ------------- | ---------
 * array | use $field['id'] and fetch the attachment using wp_get_attachment_image()
 * id | fetch the attachment - as for array
 * url | use the URL ASIS. This is the most basic solution.
 *
 * @param $field
 * @param $field_info
 *
 * @return void
 */
function acf_display_field_image( $field, $field_info ) {
	bw_trace2();
	switch ( $field_info['return_format']) {
		case 'array':
			$image_size = $field_info['preview_size'] ?? 'full';
			$field_value = wp_get_attachment_image( $field['ID'], $image_size );
			echo $field_value;
			break;

		case 'id':
			$image_size = $field_info['preview_size'] ?? 'full';
			$field_value = wp_get_attachment_image( $field, $image_size );
			echo $field_value;
			break;

		case 'url':
		default:
			echo "<img src=\"$field\"/>";
	}
	//bw_format_attachment();_image
}
