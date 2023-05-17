<?php
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
	// @TODO = filter field groups to include those with location matching post_type. ie exclude just block types
	$fields = [];
	foreach ( $field_groups as $field_group ) {
		if ( acf_process_field_group( $field_group )) {
			$raw_fields=acf_get_fields( $field_group['ID'] );
			bw_trace2( $raw_fields, 'raw_fields', false );
			foreach ( $raw_fields as $raw_field ) {
				$field_select_label  =[];
				$field_select_label[]=$raw_field['label'];
				$field_select_label[]='-';
				$field_select_label[]=$field_group['title'];
				if ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) {
					$field_select_label[]='-';
					$field_select_label[]=$raw_field['name'] . '/' . $raw_field['key'];
				}

				//$field_select_label[] = $raw_field['key'];

				$fields[ $raw_field['name'] ]=implode( ' ', $field_select_label );
			}
		}
	}
	return $fields;

}

/**
 * Checks if the Field Group is relevant.
 *
 * We'll process this field group if any location param is 'post_type'
 * It doesn't matter what that operator or value fields are set to,
 * since we don't care about the actual value.
 *
 * - See how this is done for post meta.
 * - Note: post_meta already knows the post_type.
 *
 *  [location] => Array

            [0] => Array

                [0] => Array

                    [param] => (string) "post_type"
                    [operator] => (string) "=="
                    [value] => (string) "oik_testimonials"


            [1] => Array

                [0] => Array

                    [param] => (string) "post_type"
                    [operator] => (string) "=="
                    [value] => (string) "page"

 */

function acf_process_field_group( $field_group ) {

	$process = false;
	$rules = $field_group['location'];
	foreach ( $rules as $ruleset ) {
		foreach ( $ruleset as $rule ) {
			if ( 'post_type' === $rule['param'] ) {
				$process=true;
			}
		}
	}
	return $process;
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


function acf_build_acf_field_name_field() {
	$acf_field_name = 	array(
		'key' => 'field_645f589a88304',
		'label' => 'ACF Field name',
		'name' => 'acf-field-name',
		'aria-label' => '',
		'type' => 'text',

		'instructions' => 'Select the field name of the ACF field to display',
		'required' => 1,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'default_value' => '',
		'maxlength' => '',
		'placeholder' => 'ACF_field_name',
		'prepend' => '',
		'append' => '',
	);

	/**
	 * Convert to a select field type
	 */
	$acf_field_name[ 'type' ]  = 'select';
	$acf_field_name['choices'] = acf_get_possible_field_names( '', 0 );

	return $acf_field_name;

}

function acf_build_acf_cycler_field() {
	$acf_cycler_field = array(
	'key' => 'field_645e28e9f47da',
	'label' => 'Cycle Transition Effect',
	'name' => 'fx',
	'aria-label' => '',
	'type' => 'select',
	'instructions' => '',
	'required' => 0,
	'conditional_logic' => 0,
	'wrapper' => array(
		'width' => '',
		'class' => '',
		'id' => '',
	),
	'choices' => array(
		'fade' => 'fade',
		'blindX' => 'blindX',
		'blindY' => 'blindY',
		'blindZ' => 'blindZ',
		'cover' => 'cover',
		'curtainX' => 'curtainX',
		'curtainY' => 'curtainY',
		'fadeZoom' => 'fadeZoom',
		'growX' => 'growX',
		'growY' => 'growY',
		'none' => 'none',
		'scrollUp' => 'scrollUp',
		'scrollDown' => 'scrollDown',
		'scrollLeft' => 'scrollLeft',
		'scrollRight' => 'scrollRight',
		'scrollHorz' => 'scrollHorz',
		'scrollVert' => 'scrollVert',
		'shuffle' => 'shuffle',
		'slideX' => 'slideX',
		'slideY' => 'slideY',
		'toss' => 'toss',
		'turnUp' => 'turnUp',
		'turnDown' => 'turnDown',
		'turnLeft' => 'turnLeft',
		'turnRight' => 'turnRight',
		'uncover' => 'uncover',
		'wipe' => 'wipe',
		'zoom' => 'zoom',
	),
	'default_value' => 'fade',
	'return_format' => 'value',
	'multiple' => 0,
	'allow_null' => 0,
	'ui' => 0,
	'ajax' => 0,
	'placeholder' => '',
);
	return $acf_cycler_field;
}

