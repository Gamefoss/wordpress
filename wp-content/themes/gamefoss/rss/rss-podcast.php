<?php // Template Name: RSS ?>
<?php echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>" ?>

<rss
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd"
	xmlns:itunesu="http://www.itunesu.com/feed"
	version="2.0"
>
	<channel>
		<language>
			pt-br
		</language>
		<title>
			<?php echo $podcast->name ?>
		</title>
		<description>
			<?php echo $podcast->description ?>
		</description>
		<link><?php echo get_term_link($podcast); ?></link>

		<?php if ( get_field("is_itunes", $podcast) ): ?>
			<itunes:subtitle>
				<?php echo get_field("itunes", $podcast)["description"] ?>
			</itunes:subtitle>
			<itunes:author>
				<?php echo get_field("itunes", $podcast)["author"] ?>
			</itunes:author>
			<itunes:summary>
				<?php echo $podcast->description ?>
			</itunes:summary>
			<itunes:owner>
			    <itunes:name>Game Foss</itunes:name>
			    <itunes:email>admin@gamefoss.com</itunes:email>
			</itunes:owner>
			<itunes:explicit>no</itunes:explicit>
			<itunes:image href="<?php echo get_field("logo", $podcast) ?>" />
			<itunes:category text="<?php echo htmlentities( get_field("itunes", $podcast)["category"] ) ?>">
				<itunes:category text="<?php echo get_field("itunes", $podcast)["subcategory"] ?>"></itunes:category>
			</itunes:category>
			<itunes:keywords>
				<?php echo get_field("itunes", $podcast)["keywords"] ?>
			</itunes:keywords>
		<?php endif ?>

		<?php foreach ( get_posts( array(
			'post_type'			=> "podcast",
			'numberposts'		=> -1,
			'tax_query'			=> array(
				array(
					'taxonomy'	=> 'podcasts',
					'field'			=> 'id',
					'terms'			=> $podcast->term_id
				)
			)
		) ) as $post ): ?>
			<?php setup_postdata( $post ) ?>
			<item>
			    <title>
					<?php echo get_the_title() ?>
				</title>
				<description>
					<![CDATA[<?php echo get_the_content() ?>]]>
				</description>
				<itunes:subtitle>
					<![CDATA[<?php echo get_field("itunes", $podcast)["description"] ?>]]>
				</itunes:subtitle>
			    <itunes:summary>
			    	<![CDATA[<?php echo get_the_content() ?>]]>
			    </itunes:summary>
			    <description>
			    	<?php echo get_the_excerpt() ?>
			    </description>
			    <link><?php echo get_the_permalink() ?></link>
			    <enclosure url="<?php echo get_field( "mp3" )["url"] ?>" type="audio/mpeg" length="<?php echo get_field( "mp3" )["filesize"] ?>"></enclosure>
				<?php if ( get_field("is_itunes", $podcast) ): ?>
					<itunes:author>GameFoss</itunes:author>
				    <itunes:duration>
				    	<?php echo get_field( "itunes" )["duration"] ?>
				    </itunes:duration>
				    <itunes:explicit>no</itunes:explicit>
				<?php endif ?>
				<pubdate>
					<![CDATA[<?php echo get_the_date( "r" ) ?>]]>
				</pubdate>
			</item>
			<?php wp_reset_postdata() ?>
		<?php endforeach ?>

	</channel>
</rss>
