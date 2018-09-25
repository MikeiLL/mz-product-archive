<?php
/**
 * Single Project Image
 *
 * @author 		WooThemes
 * @package 	Projects/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

$attachment_ids 	= projects_get_gallery_attachment_ids();

?>



		<div id="wooswipe" class="images">

			<?php
			$zoomed_image_size = array(1920, 1080);
			if ( $attachment_ids ) { ?>
				<div class="thumbnails">
						<ul class="thumbnail-nav">
							<?php
								function addImageThumbnail($attachment_id, $zoomed_image_size){
									global $post;
									$image       	= wp_get_attachment_image( $attachment_id, 'shop_thumbnail' );
									$hq       		= wp_get_attachment_image_src( $attachment_id, apply_filters( 'wooswipe_zoomed_image_size', $zoomed_image_size ) );
									$med       		= wp_get_attachment_image_src( $attachment_id, 'shop_single' );

									echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '
										<li>
											<div class="thumb" data-hq="%s" data-w="%s" data-h="%s" data-med="%s" data-medw="%s" data-medh="%s">%s</div>
										</li>',
										$hq[0], $hq[1], $hq[2], $med[0], $med[1], $med[2], $image ), $attachment_id, $post->ID );
								}

								/// add main image
								if ( has_post_thumbnail() ) {
									$attachment_id 	= get_post_thumbnail_id();
									addImageThumbnail($attachment_id, $zoomed_image_size);
								}

								//add thumbnails
								foreach ( $attachment_ids as $attachment_id ) {
									$image_link = wp_get_attachment_url( $attachment_id );
									if ( !$image_link ) { continue; }
									addImageThumbnail($attachment_id, $zoomed_image_size);
								} ?>
						</ul>

				</div>
				<?php do_action( 'wooswipe_after_thumbs' ); ?>
			<?php }
			// Hook After Wooswipe
			do_action( 'wooswipe_after_main' );?>
		</div>

		<!-- PSWP -->
		<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="pswp__bg"></div>
			<div class="pswp__scroll-wrap">
				<div class="pswp__container">
					<div class="pswp__item"></div>
					<div class="pswp__item"></div>
					<div class="pswp__item"></div>
				</div>
				<div class="pswp__ui pswp__ui--hidden">
					<div class="pswp__top-bar">
						<div class="pswp__counter"></div>
						<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
						<button class="pswp__button pswp__button--share" title="Share"></button>
						<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
						<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
						<div class="pswp__preloader">
							<div class="pswp__preloader__icn">
							  <div class="pswp__preloader__cut">
								<div class="pswp__preloader__donut"></div>
							  </div>
							</div>
						</div>
					</div>
					<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
						<div class="pswp__share-tooltip"></div>
					</div>
					<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
					</button>
					<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
					</button>
					<div class="pswp__caption">
						<div class="pswp__caption__center"></div>
					</div>
				</div>
			</div>
		</div>


	</figure>
</div>