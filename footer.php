<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package SemPress
 * @since SemPress 1.0.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">
		<div id="site-publisher" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
			<meta itemprop="name" content="<?php echo get_bloginfo( 'name', 'display' ); ?>" />
			<meta itemprop="url" content="<?php echo home_url( '/' ); ?>" />
			<?php
			if ( has_custom_logo() ) {
				$image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) );
			?>
				<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
					<meta itemprop="url" content="<?php echo current( $image ); ?>" />
					<meta itemprop="width" content="<?php echo next( $image ); ?>" />
					<meta itemprop="height" content="<?php echo next( $image ); ?>" />
				</div>
			<?php } ?>
		</div>
		<div id="site-generator">
			<?php do_action( 'sempress_credits' ); ?>
			<?php printf( __( 'This site is powered by %1$s and styled with %2$s', 'sempress' ), '<a href="http://wordpress.org/" rel="generator">WordPress</a>', '<a href="http://notiz.blog/projects/sempress/">SemPress</a>' ); ?>
		</div>
<div>
<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons Licence" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/80x15.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>.
</div><!-- Creative COmmons License -->

	<div>
<a href="https://xn--sr8hvo.ws/🍗💵/previous">←</a>
An IndieWeb Webring 🕸💍
<a href="https://xn--sr8hvo.ws/🍗💵/next">→</a>
	</div><!-- Khurt Williams: adds IndieWeb Ring -->

<div>
<a rel="alternate" type="application/rss+xml" title="Island in the Net &raquo; RSS2 Feed" href="<?php bloginfo('rss2_url'); ?>" /><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>'); ?></a> |
<a rel="alternate" type="application/rss+xml" title="Island in the Net &raquo; Atom Feed" href="<?php bloginfo('atom_url'); ?>" /><?php _e('<abbr title="Atom">Atom</abbr>'); ?></a>
</div><!-- Standard feeds -->

<div>
<p>Customised RSS Feeds</p>
<a rel="alternate" type="application/rss+xml" title="Island in the Net &raquo; General Category Feed" href="<?php bloginfo('url'); ?>/category/general/feed/" /><?php _e('<abbr title="">General</abbr>'); ?></a> |
<a rel="alternate" type="application/rss+xml" title="Island in the Net &raquo; Photography Category Feed" href="<?php bloginfo('url'); ?>/category/photography/feed/" /><?php _e('<abbr title="">Photography</abbr>'); ?></a> |
<a rel="alternate" type="application/rss+xml" title="Island in the Net &raquo; Review Category Feed" href="<?php bloginfo('url'); ?>/category/reviews/feed/" /><?php _e('<abbr title="Review">Review</abbr>'); ?></a> |
<a rel="alternate" type="application/rss+xml" title="Island in the Net &raquo; Tutorial Category Feed" href="<?php bloginfo('url'); ?>/category/Tutorial/feed/" /><?php _e('<abbr title="Tutorial">Tutorial</abbr>'); ?></a> |
<a rel="alternate" type="application/rss+xml" title="Island in the Net &raquo; IndieWeb Category Feed" href="<?php bloginfo('url'); ?>/category/IndieWeb/feed/" /><?php _e('<abbr title="IndieWeb">IndieWeb</abbr>'); ?></a> |
<a rel="alternate" type="application/rss+xml" title="Island in the Net &raquo; Feed without beer/foursquare checkins" href="<?php bloginfo('url'); ?>?cat=-5672,-4754&feed=rss2" /><?php _e('<abbr title="without beer/foursquare checkins">without beer/foursquare checkins</abbr>'); ?></a>
</div><!-- Khurt Williams: adds custom RSS feed links to footer -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
