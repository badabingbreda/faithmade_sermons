<?php

namespace faithmade;

$podcast_title        = \rwmb_meta(  'fm_podcast_title' ,         array( 'object_type' => 'setting', 'limit' => 1 ) , 'fm-sermons' );
$podcast_description  = \rwmb_meta(  'fm_podcast_description' ,   array( 'object_type' => 'setting', 'limit' => 1 ) , 'fm-sermons' );
$podcast_image        = \rwmb_meta(  'fm_podcast_artwork' ,       array( 'object_type' => 'setting', 'limit' => 1 ) , 'fm-sermons' );

/**
 * Template Name: Podcast RSS
 **/

// Query the Sermons CPT and fetch the latest 100 posts order by faithmade_date_preached postmeta (latest first)
$args = array(
				'post_type' 		=> 'sermons',
				'posts_per_page' 	=> 100,
				'orderby'			=> 'meta_value',
				'meta_key'			=> 'faithmade_date_preached',
				'order'				=> 'DESC',
			);

$loop = new \WP_Query( $args );

// Output the XML header
header('Content-Type: '.feed_content_type('rss-http').'; charset='.get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';
?>
<?php // Start the iTunes RSS Feed: https://www.apple.com/itunes/podcasts/specs.html ?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">

  <?php
	// The information for the podcast channel
	// Mostly using get_bloginfo() here, but these can be custom tailored, as needed
  ?>
	<channel>
		<title><?php echo $podcast_title; ?></title>
		<link><?php echo get_bloginfo('url'); ?></link>
		<language><?php echo get_bloginfo ( 'language' ); ?></language>
		<copyright><?php echo date('Y'); ?> <?php echo get_bloginfo('name'); ?></copyright>
		<itunes:author><?php echo get_bloginfo('name'); ?></itunes:author>
		<itunes:summary><?php echo get_bloginfo('description'); ?></itunes:summary>
		<description>
			<![CDATA[<?php echo $podcast_description; ?>]]>
		</description>
		<itunes:owner>
		  <itunes:name><?php echo get_bloginfo('name'); ?></itunes:name>
		  <itunes:email><?php echo get_bloginfo('admin_email'); ?></itunes:email>
		</itunes:owner>
		<itunes:image href="<?php echo $podcast_image[0]['full_url']; ?>" />
		<itunes:category text="Technology">
	  		<itunes:category text="Tech News" />
		</itunes:category>
		<itunes:explicit>false</itunes:explicit>
<?php

	// Start the loop for Faithmade posts
	while ( $loop->have_posts() ) : $loop->the_post();

		$post_id = get_the_ID();


?>
		<item>
			<title><?php the_title_rss(); ?></title>
			<itunes:author><?php echo get_bloginfo('name'); ?></itunes:author>
			<itunes:summary><?php echo get_the_excerpt(); ?></itunes:summary>
<?php

	  // Retrieve just the URL of the Featured Image: http://codex.wordpress.org/Function_Reference/wp_get_attachment_image_src
	  if ( has_post_thumbnail( $post_id ) ):

		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );

?>
			<itunes:image href="<?php echo $podcast_image[0]['full_url'] ?>" />
<?php

	endif;

	  // Get the file field URL, filesize and date format
		// $attachment_id = rwmb_meta( 'faithmade_sermon_audio_link' );
		// $fileurl = wp_get_attachment_url( $attachment_id );
		// $filesize = filesize( get_attached_file( $attachment_id ) );

		$fileurl = rwmb_meta( 'faithmade_sermon_audio_link' );
		$filesize = rwmb_meta( 'faithmade_audio_filesize' );
		$mimetype = rwmb_meta( 'faithmade_audio_mimetype' );
		$dateformatstring = _x( 'D, d M Y H:i:s O', 'Date formating for iTunes feed.' );

?>
			<enclosure url="<?php echo $fileurl; ?>" length="<?php echo $filesize; ?>" type="<?php echo $mimetype; ?>" />
			<guid><?php echo $fileurl; ?></guid>
			<pubDate><?php echo date( $dateformatstring, strtotime( rwmb_meta( 'faithmade_date_preached' ) ) ); ?></pubDate>
			<itunes:duration><?php echo rwmb_meta( 'faithmade_sermon_audio_duration' ); ?></itunes:duration>
		</item>
<?php

	endwhile;

?>
	</channel>
</rss>