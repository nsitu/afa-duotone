<?php
/**
 * Plugin Name: AFA Duotone Filter
 * Description: Injects an SVG filter and .afa-duotone helper CSS class so any element can be duotoned orange–maroon.
 * Version:     1.0.0
 * Author:      Harold Sikkema
 * License:     GPL-3.0+
 */

defined( 'ABSPATH' ) || exit; // Don’t run in a direct call.

/**
 * Output the SVG filter & CSS once 
 */
function afa_duotone_print_markup() {
	// Avoid adding it twice
	if (  did_action( 'afa_duotone_printed' ) ) {
		return;
	}

	// Mark as printed to prevent duplicates if another hook fires later.
	do_action( 'afa_duotone_printed' );

	?>
	<!-- AFA Duotone filter (orange / maroon) -->
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0"
	     width="0" height="0" focusable="false" role="none"
	     style="visibility:hidden;position:absolute;left:-9999px;overflow:hidden;">
	  <defs>
	    <filter id="afa-duotone">
	      <feColorMatrix color-interpolation-filters="sRGB" type="matrix"
	        values=".299 .587 .114 0 0
	                .299 .587 .114 0 0
	                .299 .587 .114 0 0
	                .299 .587 .114 0 0"></feColorMatrix>
	      <feComponentTransfer color-interpolation-filters="sRGB">
	        <feFuncR type="table" tableValues="0.5568 0.9490"/>
	        <feFuncG type="table" tableValues="0.1137 0.5451"/>
	        <feFuncB type="table" tableValues="0.3451 0.1255"/>
	        <feFuncA type="table" tableValues="1 1"/>
	      </feComponentTransfer>
	      <feComposite in2="SourceGraphic" operator="in"/>
	    </filter>
	  </defs>
	</svg>
	<style>
	  .afa-duotone{ filter:url(#afa-duotone); }
	</style>
	<?php
}
// add the code to the start of the body
add_action( 'wp_body_open', 'afa_duotone_print_markup', 0 );

