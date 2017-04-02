<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package cosimo
 */

get_header();
$enlargeFeatImage = get_theme_mod('cosimo_theme_options_enlargefeatured', '1');
?>

	<div id="primary" class="content-area">
		<?php if ($enlargeFeatImage == 1) : ?>
			<div class="openFeatImage"><i class="fa fa-lg fa-angle-double-down"></i></div>
		<?php endif; ?>
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="theCosimoSingle-box">
						<header class="entry-header">
							<?php // the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						</header><!-- .entry-header -->
						<div class="intSeparator"></div>
						<div class="entry-content">

							<?php

							// Ensure the global $post variable is in scope
							global $post;

							// Retrieve the next 5 upcoming events
							$events = tribe_get_events( array(
							    'posts_per_page' => 5,
							) );

							// Loop through the events: set up each one as
							// the current post then use template tags to
							// display the title and content
							foreach ( $events as $post ) {
							    setup_postdata( $post );

							    // This time, let's throw in an event-specific
							    // template tag to show the date after the title!
							        //echo "$post->post_title";
							        //echo tribe_get_start_date( $post );
							}

							?>


							<?php the_content(); ?>
							<?php
								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'cosimo' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span class="page-links-number">',
									'link_after'  => '</span>',
									'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'cosimo' ) . ' </span>%',
									'separator'   => '<span class="screen-reader-text">, </span>',
								) );
							?>
						</div><!-- .entry-content -->
						<span style="display:none" class="updated"><?php the_time(get_option('date_format')); ?></span>
						<div style="display:none" class="vcard author"><a class="url fn" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></div>
						<div class="intSeparator"></div>
						<footer class="entry-footer smallPart">
							<?php edit_post_link( esc_html__( 'Edit', 'cosimo' ), '<span class="edit-link floatLeft"><i class="fa fa-wrench spaceRight"></i>', '</span>' ); ?>
						</footer><!-- .entry-footer -->
					</div><!-- .theCosimoSingle-box -->
				</article><!-- #post-## -->

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
