<?php


/**
 * acf-field block template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during backend preview render.
 * @param int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param array $context The context provided to the block by the post or its parent block.
 */
bw_trace2();
bw_backtrace();
bw_trace2( $block, "block", false);
bw_trace2( $content, "content", false );
bw_trace2( $context, "context", false );


if ( !function_exists( 'acf_display_field')) {
	oik_require( 'includes/acf-field.php', 'oik-testimonials' );
}


$classes = ['acf-field'];
if( !empty( $block['className'] ) ) {
	$classes = array_merge( $classes, explode( ' ', $block['className'] ) );
}
$classes = implode( ' ', $classes);
//$anchor = '';
//if( !empty( $block['anchor'] ) )
//	$anchor = ' id="' . sanitize_title( $block['anchor'] ) . '"';

echo "<div class=\"$classes\">";
$field_name = get_field( 'field-name');
acf_display_field( $field_name, $post_id );
echo '</div>';
