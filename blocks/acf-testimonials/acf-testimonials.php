<?php

/**
 * @copyright (C) Copyright Bobbing Wide 2023
 * @package oik-testimonials
 * @depends oik
 *
 */

/**
 * The following functions re-implement the jQuery cycler code that's used in the [bw_testimonials] shortcode.
 * The difference is that the jQuery selector is for the acf-innerblocks-container within the div with class acf-testimonials
 * and ID returned from acf_testimonial_id().
 *
 * Since the code depends on oik's functions it's only invoked when oik has been loaded.
 *
 * A simpler solution wouldn't require jQuery and could probably be achieved
 * by defining the scripts to be enqueued in block.json.
 *
 * @TODO These functions are defined before the main code. They could be required from a separate file,
 * using oik_require().
 */
/**
 * Return the next unique ID for the testimonial selector
 */
if (!function_exists( 'acf_testimonial_id')) {
function acf_testimonial_id() {
	static $testimonial_id=0;
	$testimonial_id ++;
	return ( "bw_testimonial-$testimonial_id" );
}

/**
 * Create the jQuery code to cycle the selection, including the starting div
 * This code uses jQuery cycle.all
 */
	function acf_testimonials_jq( $atts, $tag ) {
		oik_require( "shortcodes/oik-jquery.php" );
		$debug =bw_array_get( $atts, "debug", false );
		$script=bw_array_get( $atts, "script", "cycle.all" );
		$method=bw_array_get( $atts, "method", "cycle" );
		bw_jquery_enqueue_script( $script, $debug );
		$selector=acf_testimonial_id();
		$parms   =_acf_testimonials_cycle_parms();
		bw_jquery( "#$selector .acf-innerblocks-container", $method, $parms );
		$class=bw_array_get( $atts, "class", $tag );
		sdiv( $class, $selector );
	}

/**
 * Attempt to make the cycler responsive!
 *
 * The parameters here were set after reading other peoples questions and answers.
 * @link http://forum.jquery.com/topic/integrate-cycle-plugin-in-a-responsive-layout-using-media-queries
 *
 * Then I tried to reduce the logic to the minimum that would work for blocks containing text and images.
 * The trick was in setting the width and max-width in both the parms and the CSS
 *
 * The width: "100%" parameter ensures that the image can scale down when the main div gets too narrow for it
 * Extract from @link http://jquery.malsup.com/cycle/options.html
 *  width - container width (if the 'fit' option is true, the slides will be set to this width as well)
 *  fit - to force slides to fit container
 *
 * CSS used in oik.css
 * .bw_testimonial { width: 100% !important; }
 * .bw_testimonial img { max-width: 100% !important; }
 *
 */
function _acf_testimonials_cycle_parms() {
	$cycle_parms = array( "width" => "100%"
	, "fit" => 1
	);
	$parms = bw_jkv( $cycle_parms );
	return( $parms );
}

}

/**
 * oik-testimonials block template.
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

//echo "acf-testimonials block";

//$classes = ['block-about'];
//if( !empty( $block['className'] ) )
//	$classes = array_merge( $classes, explode( ' ', $block['className'] ) );

//$anchor = '';
//if( !empty( $block['anchor'] ) )
//	$anchor = ' id="' . sanitize_title( $block['anchor'] ) . '"';

if ( did_action( 'oik_loaded') ) {
	acf_testimonials_jq( [], 'acf-testimonials');
	echo bw_ret();
} else {
	echo '<div class="acf-testimonials cycler">';
}
echo '<InnerBlocks />';
echo '</div>';