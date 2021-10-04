<?php
/**
 * Template part for displaying header top bar
 *
 * @link https://wpthemespace.com/product/beshop
 *
 * @package BeShop
 */

?>

<?php 
 function x_hub_post_carousel_output(){
	$X_hub_hslider_category = get_theme_mod('X_hub_hslider_category','all');
	$X_hub_hslider_post_orderby = get_theme_mod('X_hub_hslider_post_orderby','rand');
	$X_hub_hslider_posts_number = get_theme_mod('X_hub_hslider_posts_number',4);
	$X_hub_show_hslider_text = get_theme_mod('X_hub_show_hslider_text', 1);
	$X_hub_show_hslider_dots = get_theme_mod('X_hub_show_hslider_dots', 1);
	
	
	if($X_hub_hslider_post_orderby == 'rand'){
		$X_hub_hsp_order = 'DESC';
		$X_hub_hsp_orderby = 'rand';
	}elseif($X_hub_hslider_post_orderby == 'desc'){
		$X_hub_hsp_order = 'DESC';
		$X_hub_hsp_orderby = 'date';
	}else{
		$X_hub_hsp_order = 'ASC';
		$X_hub_hsp_orderby = 'date';
	}
	
	
	
	
		if($X_hub_hslider_category == 'all'){
				$X_hub_terms ='';
			}
			else{
				$X_hub_terms = array(
					array(
						'taxonomy'  => 'category',
						'field'  => 'slug',
						'terms'  => $X_hub_hslider_category
					)
				);
			}
	
			$X_hub_slider_three_args = array(
				'post_type'  		=>	'post',
				'post_status'  		=>	'publish',
				'posts_per_page' 	=> $X_hub_hslider_posts_number,
				'tax_query' 	    =>	$X_hub_terms,
				'orderby' => $X_hub_hsp_orderby,
				'order'   => $X_hub_hsp_order,
				'ignore_sticky_posts' => 1
			);
	
		$X_hub_loop= new WP_Query($X_hub_slider_three_args);
		if($X_hub_loop->have_posts()):
		 ?>

<!-- Slider main container -->
<div class="swiper-container xhub-post-carousel">
  <!-- Additional required wrapper -->
	<div class="swiper-wrapper">
	<?php
		Global $post;
		while ( $X_hub_loop->have_posts()) :  $X_hub_loop->the_post();
			
		$X_hub_categories = get_the_category();
		if($X_hub_categories){
			$X_hub_category = $X_hub_categories[mt_rand(0,count( $X_hub_categories)-1)];
		}else{
			$X_hub_category = '';
		}
		?>

		<!-- Slides -->
		<div class="swiper-slide post-item unload">
				<div class="home-slider-img">
					<a href="<?php the_permalink(); ?>">
						<?php
						if(has_post_thumbnail()){
							the_post_thumbnail('slider-big1');
						}else{
							echo '<div class="xhub-pro-no-simg"></div>';
						}
						?>
					 </a>
				</div>
				<?php if(!empty($X_hub_show_hslider_text)): ?>
				<div class="xhub-text text-center p-3">
					<div class="xhub-text-inner">
						<div class="grid-head">
						<?php
							if ( 'post' === get_post_type() && $X_hub_category ) : ?>
									<span class="ghead-meta list-meta"><a href="<?php echo esc_url(get_category_link($X_hub_category)); ?>"><?php echo esc_html($X_hub_category->name); ?></a>
									</span>
								<?php endif; ?>
							<h2 class="entry-title">
								<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
							</h2>
							<?php if ( 'post' === get_post_type() ) :
							?>
								<div class="list-meta list-author">
								<?php x_hub_posted_by(); ?>
								</div><!-- .entry-meta -->
							<?php endif; ?>
						</div>
						<a class="xhub-readmore pb-3 pt-3" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More ','x-hub'); ?> <i class="fas fa-long-arrow-alt-right"></i></a>
					</div>
				</div>
		<?php endif; ?>


		</div>
		<?php endwhile;
	 wp_reset_postdata(); ?>

	</div>


<?php if($X_hub_show_hslider_dots): ?>
	<!-- If we need pagination -->
	<div class="swiper-pagination xhub-cdot"></div>
<?php endif; ?>
</div>

<?php else: ?>
		<div class="slider slider-none">
			<p><?php esc_html_e('No slider item found','x-hub'); ?></p>
		</div>
<?php endif;


 }
add_action('x_hub_post_carousel','x_hub_post_carousel_output');

?>

