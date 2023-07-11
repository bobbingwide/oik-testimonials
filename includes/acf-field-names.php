<?php

/**
 * Defines the Cycler Transition Effect (fx) field.
 *
 * @return array
 */
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

/**
 * Implements `acf/prepare_field/name=acf-field-name` filter.
 *
 * Sets the choices for the select field.
 * This caters for post types which weren't registered when `acf/include_fields` was actioned.
 *
 * @param $field
 * @return mixed
 */
function acf_prepare_field_name_acf_field_name( $field ) {
	$field['choices'] = acf_get_possible_field_names( '', 0 );
	return $field;
}

