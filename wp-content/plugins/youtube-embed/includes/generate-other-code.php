<?php
/**
* Generate Download Code
*
* Create code to allow a YouTube video to be downloaded
*
* @package	YouTube-Embed
* @since	2.0
*
* @uses		ye_extract_id				Extract an ID from a string
* @uses		ye_validate_id				Confirm the type of video
* @uses		ye_error					Display an error
*
* @param    string	$id					YouTube video ID
* @return	string						Download HTML
*/

function ye_generate_download_code( $id ) {

	return 'http://keepvid.com/?url=https://www.youtube.com/watch?v=' . $id;

}

/**
* Generate video short URL
*
* Create a short URL to a YouTube video
*
* @package	YouTube-Embed
* @since	2.0
*
* @uses		ye_extract_id				Extract an ID from a string
* @uses		ye_validate_id				Confirm the type of video
* @uses		ye_error					Display an error
*
* @param    string	$id					YouTube video ID
* @return	string	$youtube_code		Code
*/

function ye_generate_shorturl_code( $id ) {

	// Check that an ID has been specified
	if ( $id == '' ) {
		return ye_error( __( 'No video ID has been supplied', 'youtube-embed' ) );
	} else {

		// Extract the ID if a full URL has been specified
		$id = ye_extract_id( $id );

		// Check what type of video it is and whether it's valid
		$embed_type = ye_validate_id( $id );
		if ( $embed_type != 'v' ) {
			if ( strlen( $embed_type ) > 1 ) {
				return ye_error( $embed_type );
			} else {
				return ye_error( sprintf( __( 'The YouTube ID of %s is invalid.', 'youtube-embed' ), $id ) );
			}
		}

		return 'https://youtu.be/' . $id;
	}
}

/**
* Generate Thumbnail Code
*
* Generate XHTML compatible YouTube video thumbnail
*
* @package	YouTube-Embed
* @since	2.0
*
* @uses		ye_extract_id				Extract an ID from a string
* @uses		ye_validate_id				Confirm the type of video
* @uses		ye_error					Display an error
*
* @param    string	$id					YouTube video ID
* @param 	string	$style				Link STYLE
* @param 	string	$class				Link CLASS
* @param 	string	$rel				Link REL
* @param 	string	$target				Link target
* @param 	string	$width				Width
* @param 	string	$height				Height
* @param 	string	$alt				ALT text
* @param	string	$version			Thumbnail version
* @param	string	$nolink				True or False, whether no link should be added
* @return	string	$youtube_code		Code
*/

function ye_generate_thumbnail_code( $id, $style, $class, $rel, $target, $width, $height, $alt, $version, $nolink = false ) {

	// Extract the ID if a full URL has been specified
	$id = ye_extract_id( $id );

	// Check what type of video it is and whether it's valid
	$embed_type = ye_validate_id( $id );

	if ( $embed_type != 'v' ) {
		if ( strlen( $embed_type ) > 1 ) {
			return ye_error( $embed_type );
		} else {
			return ye_error( sprintf( __( 'The YouTube ID of %s is invalid.', 'youtube-embed' ), $id ) );
		}
	}

	$version = strtolower( $version );
	if ( ( $version != 'default' ) && ( $version != 'hq' ) && ( $version != 'start' ) && ( $version != 'middle' ) && ( $version != 'end' ) ) { $version = 'default'; }
	if ( $version == 'hq' ) { $version = 'hqdefault'; }
	if ( $version == 'start' ) { $version = 1; }
	if ( $version == 'middle' ) { $version = 2; }
	if ( $version == 'end' ) { $version = 3; }

	// Now create the required code
	if ( $alt == '' ) { $alt = sprintf( __( 'YouTube Video %s' ), $id ); }
	if ( !$nolink ) {
		$youtube_code = '<a href="https://www.youtube.com/watch?v=' . $id . '"';
		if ( $style != '' ) { $youtube_code .= ' style="' . $style . '"'; }
		if ( $class != '' ) { $youtube_code .= ' class="' . $class . '"'; }
		if ( $rel != '' ) { $youtube_code .= ' rel="' . $rel . '"'; }
		if ( $target != '' ) { $youtube_code .= ' target="' . $target . '"'; }
		$youtube_code .= '>';
	}
	$youtube_code .= '<img src="https://img.youtube.com/vi/' . $id . '/' . $version . '.jpg"';
	if ( $width != '' ) { $youtube_code .= ' width="' . $width . '"'; }
	if ( $height != '' ) { $youtube_code .= ' height="' . $height . '"'; }
	$youtube_code .= ' alt="' . $alt . '"/>';
	if ( !$nolink ) { $youtube_code .= '</a>'; }

	return $youtube_code;
}
?>