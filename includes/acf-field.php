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
 * - @TODO So it should provide some hooks to enable other routines to do this.
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

			case 'email':
				acf_display_field_email( $field, $field_info );
				break;
			case 'url':
				acf_display_field_url( $field, $field_info );
				break;
			case 'file':
				acf_display_field_file( $field, $field_info );
				break;
			default:
				echo esc_html( $field );
		}
	} else {
		// get_field_object() returns false if the field isn't defined or set.
		echo "<p>Field '$field_name' not found for $post_id.";
		//echo "Is the field even defined?";

		echo '<br />';
		echo 'Perhaps you need to Publish/Update the post';
		//echo "Field: " . $field;
		echo '</p>';
		//acf_list_possible_field_names( $field_name, $post_id );

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
 * @link https://www.advancedcustomfields.com/resources/image/

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

/**
 * Displays an email field.
 *
 * Uses antispambot() to obfuscate the email address.
 * But note that most browser's inspector's will display the easy to read version.
 *
 * @link https://www.advancedcustomfields.com/resources/email/
 *
 * @param $field
 * @param $field_info
 *
 * @return void
 */
function acf_display_field_email( $field, $field_info) {
	//$email = $field
	echo '<a href="';
	echo esc_url( 'mailto:' . antispambot( $field ) );
	echo '">';
	echo esc_html( antispambot( $field ) );
	echo '</a>';
}

/**
 * Displays an URL field
 *
 * @link https://www.advancedcustomfields.com/resources/url/
 * @param $field
 * @param $field_info
 *
 * @return void
 */
function acf_display_field_url( $field, $field_info ) {
	echo '<a href="';
	echo esc_attr( $field );
	echo '">';
	echo esc_attr( $field );
	echo '</a>';
}

/**
 * Displays an ACF file.
 *
 * return_format | processing
 * ------------- | ---------
 * array | Display a link to the file
 * id | use the attachment URL
 * url | use the URL ASIS.
 *
 * @link https://www.advancedcustomfields.com/resources/file

 * @param $field
 * @param $field_info
 *
 * @return void
 */
function acf_display_field_file( $field, $field_info ) {
	bw_trace2();
	switch ( $field_info['return_format']) {
		case 'array':
			echo '<a href="';
			echo $field['url'];
			echo '">';
			// Display the file name or title?
			echo $field['title'];
			echo '</a>';
			break;

		case 'id':
			$url = wp_get_attachment_url( $field );
			$url = esc_html( $url );
			echo "<a href=\"$url\">Download File</a>";
			break;

		case 'url':
		default:
			echo "<a href=\"$field\">Download File</a>";
	}
}
