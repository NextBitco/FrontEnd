<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package X Hub
 */
$xhub_blog_style = get_theme_mod( 'xhub_blog_style', 'grid' );
if( $xhub_blog_style == 'list' && !is_single() ):
	get_template_part( 'template-parts/content', 'list' );
elseif( $xhub_blog_style == 'grid' && !is_single() ):
	get_template_part( 'template-parts/content', 'img' );
else:
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="xpost-item shadow pb-5 mb-5">

		<div class="xpost-text p-3">
		<?php x_hub_post_thumbnail(); ?>
			<header class="entry-header text-center pb-4">
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;

				if ( 'post' === get_post_type() ) :
					?>
					<div class="entry-meta">
						<?php
						x_hub_posted_on();
						x_hub_posted_by();
						?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->
			<div class="entry-content">
				<?php
				if(is_single()){
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'xhub-blog' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					)
				);

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'xhub-blog' ),
						'after'  => '</div>',
					)
				);
			}else{
				the_excerpt(  );
			}

				?>
				</div><!-- .entry-content -->
			<footer class="entry-footer">
				<?php x_hub_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
<?php endif; ?>