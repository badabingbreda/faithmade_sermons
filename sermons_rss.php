<?php

namespace faithmade;

// Add the Sermons Poadcast RSS
add_action( 'init', __NAMESPACE__ . '\podcast_rss' );

add_action( 'wp_ajax_podcast' , __NAMESPACE__ . '\ajax_podcast' );

/**
 * Add action for when saving the faithmade_sermon_audio_link field
 */
add_action( 'rwmb_after_save_post' , __NAMESPACE__ . '\save_podcast_audio' , 10, 1 );


function podcast_rss() {

	add_feed( 'faithmade-podcast', __NAMESPACE__ . '\sermons_podcast_rss' );

}

function sermons_podcast_rss() {

	// https://help.apple.com/itc/podcasts_connect/#/itcb54353390

	require_once( FM_SERMONS_PATH . 'sermons_rss_template.php' );

}

function ajax_podcast() {

	// https://help.apple.com/itc/podcasts_connect/#/itcb54353390

	require_once( FM_SERMONS_PATH . 'sermons_rss_template.php' );

	wp_die();

}


function save_podcast_audio( $post_id ) {

	if ( 'sermons' !== get_post_type( $post_id ) ) return;

	// update both the size and mimetype after save
	if ( $fileurl = rwmb_meta( 'faithmade_sermon_audio_link' , array(), $post_id ) ) {

		$audio_info = retrieve_file_info( $fileurl );

		update_post_meta( $post_id , 'faithmade_audio_filesize' , $audio_info[ 'size' ] );
		update_post_meta( $post_id , 'faithmade_audio_mimetype' , $audio_info[ 'content_type' ] );


	} else {

		update_post_meta( $post_id , 'faithmade_audio_filesize' , 'failed' );
		update_post_meta( $post_id , 'faithmade_audio_mimetype' , 'failed' );


	}

	return;
}


function get_mp3_length() {

	// http://getid3.sourceforge.net/

}

/**
 * Get the filesize of the mp3
 * determine of it is a file local to the website
 * or remote first. Used to get filesize
 *
 * @param  [type] $url [description]
 * @return [type]      [description]
 */
function retrieve_file_info( $url ) {

	// test if url is local to the website
	if ( strpos( $url , get_bloginfo('url') ) !== FALSE ) {

		$path = get_home_path();

		$abs_path = str_replace( get_bloginfo('url') , $path , $url );

		if ( file_exists( $abs_path ) ) {

			return array( 'size' => filesize( $abs_path ) , 'content_type' => mime_content_type( $abs_path ) );

		}

	// url is remote
	} else {

		return retrieve_remote_file_info( $url );

	}

}

/**
 * Retrieve a remote file's size using the header info
 * @param  [type] $url [description]
 * @return integer
 */
function retrieve_remote_file_info( $url ){

	// https://stackoverflow.com/questions/2602612/remote-file-size-without-downloading-file

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_NOBODY, TRUE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $data = curl_exec( $ch );
    $size = curl_getinfo( $ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD );
    $content_type = curl_getinfo( $ch, CURLINFO_CONTENT_TYPE );


    curl_close($ch);

    return array( 'size' => $size , 'content_type' => $content_type );
}

/**
 * Get the current URL taking into account HTTPS and Port
 * @link https://css-tricks.com/snippets/php/get-current-page-url/
 * @version Refactored by @AlexParraSilva
 */
function getCurrentUrl() {
	$url  = isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http';
	$url .= '://' . $_SERVER['SERVER_NAME'];
	$url .= in_array( $_SERVER['SERVER_PORT'], array('80', '443') ) ? '' : ':' . $_SERVER['SERVER_PORT'];
	$url .= $_SERVER['REQUEST_URI'];
	return $url;
}
