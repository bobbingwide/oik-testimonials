=== oik testimonials ===
Contributors: bobbingwide
Donate link: https://www.oik-plugins.com/oik/oik-donate/
Tags: testimonial, cycle.all, bw_testimonials, shortcodes, smart, lazy
Requires at least: 6.4
Tested up to: 6.7.1
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==
better by far testimonials plugin.

As with other testimonials plugins this plugin delivers a Custom Post Type (oik_testimonials) 
and a shortcode to display the testimonials [bw_testimonials].

Features: 
* [bw_testimonials] shortcode to display cycling testimonials
* uses oik base plugin for base functionality
* use for any post type - not just testimonials
* Uses oik-fields to define the Author Name field and Testimonial type taxonomy

acf-field block with ACF Pro

If you want to alter the output from the oik-testimonials/acf-field block
then you can hook into the `render_block_oik-testimonials/acf-field` filter.


== Installation ==
1. Upload the contents of the oik-testimonials plugin to the `/wp-content/plugins/oik-testimonials' directory
1. Activate the oik-testimonials plugin through the 'Plugins' menu in WordPress


== Screenshots ==
1. oik-testimonials in action

== Upgrade Notice ==
= 1.0.0 = 
Tested with WordPress 6.7.1 and PHP 8.4. Now supports Advanced Custom Fields PRO, when oik-fields is not activated.

== Changelog ==
= 1.0.0 = 
* Changed: Revert to default format attribute, which assumes block=true #5
* Changed: Avoid PHP Deprecated: Using ${var} in strings is deprecated, use {$var} instead #9
* Changed: Added acf-field-block, moved to field-block-for-acf-pro, then disabled it again #7 #8
* Changed: Implement acf_process_field_group to return true when the location rules include `post_type` #5
* Changed: acf-cycler block: Set example with mode edit #5
* Changed: Add example #6
* Changed: Prototype logic to only register the Testimonials field group programmatically when not already configured #7
* Changed Correct setting of the class attribute #6
* Changed: Correct block name in comment #5
* Changed: Add Author Name block to display _oik_testimonials_name #6
* Changed: Rename acf-testimonials to acf-cycler. Implement fx attribute. Add front-end style CSS #5
* Added: Add oik-testimonials/acf-testimonials block to cycle inner blocks #5
* Changed: Enable bw_testimonials shortcode when oik-fields isn't active #1
* Changed: Set class based on shortcode. Add format=LE_M param for consistency with dynamic content block #5
* Added: Add logic to use ACF instead of oik-fields to edit and display oik_testimonials #5
* Added: Add json export for ACF: Testimonials and Testimonial type #5
* Tested: With WordPress 6.7.1 and WordPress Multisite
* Tested: With Gutenberg 19.7.0
* Tested: With Advanced Custom Fields PRO v6.3.11
* Tested: With PHP 8.3 & PHP 8.4


== Further reading ==
If you want to read more about the oik plugins then please visit the
[oik plugin](https://www.oik-plugins.com/oik) 
**"the oik plugin - for often included key-information"**

Note: Better by Far is the title of an album by Caravan, the legendary Canterbury band.