<?php // Template Name: RSS ?>
<?php echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>" ?>
<rss
  xmlns:atom="http://www.w3.org/2005/Atom"
  xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd"
  xmlns:itunesu="http://www.itunesu.com/feed"
  version="2.0"
  >
  <channel>
    <link><?php echo get_term_link($podcast); ?></link>
    <language><?php echo get_option( "rss_language" ); ?></language>
    <copyright><![CDATA[<?php echo "©" . date( "Y" ) ?>]]>
    </copyright>
    <webmaster><![CDATA[<?php echo get_userdata(1)->user_email . " (" . get_userdata(1)->user_nicename . ")" ?>]]>
    </webmaster>
    <managingeditor><![CDATA[<?php echo get_userdata(1)->user_email . " (" . get_userdata(1)->user_nicename . ")" ?>]]>
    </managingeditor>
    <image>
      <url><![CDATA[<?php echo get_field("logo", $podcast) ?>]]>
      </url>
      <title><![CDATA[<?php echo $podcast->name ?>]]>
      </title>
      <link><![CDATA[<?php echo get_term_link($podcast) ?>]]>
      </link>
    </image><?php if ( get_field("is_itunes", $podcast) ): ?>
    <itunes:owner>
      <itunes:name><![CDATA[Game Foss]]>
      </itunes:name>
      <itunes:email><![CDATA[admin@gamefoss.com]]>
      </itunes:email>
    </itunes:owner>
    <itunes:category text="<?php echo htmlentities( get_field("itunes", $podcast)["category"] ) ?>">
      <itunes:category text="<?php echo htmlentities( get_field("itunes", $podcast)["subcategory"] ) ?>"></itunes:category>
    </itunes:category>
    <itunes:keywords><![CDATA[<?php echo htmlentities( get_field("itunes", $podcast)["keywords"] ) ?>]]>
    </itunes:keywords>
    <itunes:explicit>no</itunes:explicit>
    <itunes:image href="<?php echo get_field("logo", $podcast) ?>"></itunes:image>
    <itunes:author><![CDATA[<?php echo get_field("itunes", $podcast)["author"] ?>]]>
    </itunes:author>
    <itunes:summary><![CDATA[<?php echo $podcast->description ?>]]>
    </itunes:summary>
    <itunes:subtitle><![CDATA[<?php echo htmlentities( get_field("itunes", $podcast)["description"] ) ?>]]>
    </itunes:subtitle><?php endif ?>
    <atom:link href="<?php echo home_url() . "feed/podcasts/{$podcast->slug}"  ?>" rel="self" type="application/rss+xml"></atom:link>
    <pubdate><![CDATA[<?php echo date("r") ?>]]>
    </pubdate>
    <title><![CDATA[<?php echo $podcast->name ?>]]>
    </title>
    <description><![CDATA[<?php echo htmlentities( $podcast->description ) ?>]]>
    </description>
    <lastbuilddate><![CDATA[<?php echo date( "r" ) ?>
]]>
    </lastbuilddate><?php $_posts = get_posts( array(
	'post_type'			=> "podcast",
	'numberposts'		=> -1,
	'tax_query'			=> array(
		array(
			'taxonomy'	=> 'podcasts',
			'field'			=> 'id',
			'terms'			=> $podcast->term_id
		)
	)
) ); ?><?php foreach ( $_posts as $post ): ?>
    <item><?php setup_postdata( $post ) ?>
      <title><![CDATA[<?php echo get_the_title() ?>]]>
      </title>
      <description><![CDATA[<?php echo get_the_excerpt() ?>]]>
      </description><?php if ( get_field("is_itunes", $podcast) ): ?>
      <itunes:summary><![CDATA[<?php echo get_the_excerpt() ?>]]>
      </itunes:summary>
      <itunes:subtitle><![CDATA[<?php echo get_field( "itunes" )["description"] ?>]]>
      </itunes:subtitle>
      <itunes:duration><![CDATA[<?php echo get_field( "itunes" )["duration"] ?>]]>
      </itunes:duration><?php endif ?>
      <enclosure url="<?php echo get_field( "mp3" )["url"] ?>" type="audio/mpeg" length="<?php echo get_field( "mp3" )["filesize"] ?>"></enclosure>
      <guid><![CDATA[<?php echo get_field( "mp3" )["url"] ?>]]>
      </guid>
      <pubdate><![CDATA[<?php echo get_the_date( "r" ) ?>]]>
      </pubdate><?php wp_reset_postdata() ?>
    </item><?php endforeach ?>
  </channel>
</rss>
