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

?>
<!--<div id="wooswipe" class="images">
	<div class="woocommerce-product-gallery__image single-product-main-image">
		<a class="woocommerce-main-image zoom" href="http://localhost:8080/wp-content/uploads/2017/09/large_image_demo.jpg" title="large_image_demo"> <img class="attachment-shop_single size-shop_single wp-post-image" src="http://localhost:8080/wp-content/uploads/2017/09/large_image_demo-600x600.jpg" alt="" title="" data-hq="http://localhost:8080/wp-content/uploads/2017/09/large_image_demo.jpg" data-w="1440" data-h="1080" srcset="http://localhost:8080/wp-content/uploads/2017/09/large_image_demo-600x600.jpg 600w, http://localhost:8080/wp-content/uploads/2017/09/large_image_demo-150x150.jpg 150w, http://localhost:8080/wp-content/uploads/2017/09/large_image_demo-100x100.jpg 100w, http://localhost:8080/wp-content/uploads/2017/09/large_image_demo-180x180.jpg 180w, http://localhost:8080/wp-content/uploads/2017/09/large_image_demo-300x300.jpg 300w" sizes="(max-width: 600px) 100vw, 600px" height="600" width="600"> </a> 
	</div>
	<div class="thumbnails">
		<ul class="thumbnail-nav">
			<button class="slick-prev slick-arrow" type="button" data-role="none" aria-label="Previous" role="button" aria-disabled="false" style="display: block;">Previous</button> 
			<div class="slick-list draggable" aria-live="polite">
				<div class="slick-track" style="opacity: 1; width: 400px; transform: translate3d(-100px, 0px, 0px);" role="listbox">
					<li class="slick-slide" style="width: 90px;" tabindex="-1" role="option" aria-describedby="slick-slide00" data-slick-index="0" aria-hidden="true"> 
					<div class="thumb" data-hq="http://localhost:8080/wp-content/uploads/2017/09/large_image_demo.jpg" data-w="1440" data-h="1080" data-med="http://localhost:8080/wp-content/uploads/2017/09/large_image_demo-600x600.jpg" data-medw="600" data-medh="600">
						<img class="attachment-shop_thumbnail size-shop_thumbnail" src="http://localhost:8080/wp-content/uploads/2017/09/large_image_demo-180x180.jpg" alt="" srcset="http://localhost:8080/wp-content/uploads/2017/09/large_image_demo-180x180.jpg 180w, http://localhost:8080/wp-content/uploads/2017/09/large_image_demo-150x150.jpg 150w, http://localhost:8080/wp-content/uploads/2017/09/large_image_demo-100x100.jpg 100w, http://localhost:8080/wp-content/uploads/2017/09/large_image_demo-300x300.jpg 300w, http://localhost:8080/wp-content/uploads/2017/09/large_image_demo-600x600.jpg 600w" sizes="(max-width: 180px) 100vw, 180px" height="180" width="180"> 
					</div>
					</li>
					<li class="slick-slide slick-active" style="width: 90px;" tabindex="0" role="option" aria-describedby="slick-slide01" data-slick-index="1" aria-hidden="false"> 
					<div class="thumb" data-hq="http://localhost:8080/wp-content/uploads/2017/09/luxurious-metal-stairway-railing-wood-floors-a-front-door-with-sidelight-feature.jpg" data-w="1631" data-h="1080" data-med="http://localhost:8080/wp-content/uploads/2017/09/luxurious-metal-stairway-railing-wood-floors-a-front-door-with-sidelight-feature-600x600.jpg" data-medw="600" data-medh="600">
						<img class="attachment-shop_thumbnail size-shop_thumbnail" src="http://localhost:8080/wp-content/uploads/2017/09/luxurious-metal-stairway-railing-wood-floors-a-front-door-with-sidelight-feature-180x180.jpg" alt="" srcset="http://localhost:8080/wp-content/uploads/2017/09/luxurious-metal-stairway-railing-wood-floors-a-front-door-with-sidelight-feature-180x180.jpg 180w, http://localhost:8080/wp-content/uploads/2017/09/luxurious-metal-stairway-railing-wood-floors-a-front-door-with-sidelight-feature-150x150.jpg 150w, http://localhost:8080/wp-content/uploads/2017/09/luxurious-metal-stairway-railing-wood-floors-a-front-door-with-sidelight-feature-100x100.jpg 100w, http://localhost:8080/wp-content/uploads/2017/09/luxurious-metal-stairway-railing-wood-floors-a-front-door-with-sidelight-feature-300x300.jpg 300w, http://localhost:8080/wp-content/uploads/2017/09/luxurious-metal-stairway-railing-wood-floors-a-front-door-with-sidelight-feature-600x600.jpg 600w" sizes="(max-width: 180px) 100vw, 180px" height="180" width="180"> 
					</div>
					</li>
					<li class="slick-slide slick-active" style="width: 90px;" tabindex="0" role="option" aria-describedby="slick-slide02" data-slick-index="2" aria-hidden="false"> 
					<div class="thumb" data-hq="http://localhost:8080/wp-content/uploads/2017/09/large_image_demo.jpg" data-w="1440" data-h="1080" data-med="http://localhost:8080/wp-content/uploads/2017/09/large_image_demo-600x600.jpg" data-medw="600" data-medh="600">
						<img class="attachment-shop_thumbnail size-shop_thumbnail" src="http://localhost:8080/wp-content/uploads/2017/09/large_image_demo-180x180.jpg" alt="" srcset="http://localhost:8080/wp-content/uploads/2017/09/large_image_demo-180x180.jpg 180w, http://localhost:8080/wp-content/uploads/2017/09/large_image_demo-150x150.jpg 150w, http://localhost:8080/wp-content/uploads/2017/09/large_image_demo-100x100.jpg 100w, http://localhost:8080/wp-content/uploads/2017/09/large_image_demo-300x300.jpg 300w, http://localhost:8080/wp-content/uploads/2017/09/large_image_demo-600x600.jpg 600w" sizes="(max-width: 180px) 100vw, 180px" height="180" width="180"> 
					</div>
					</li>
					<li class="slick-slide slick-current slick-active" style="width: 90px;" tabindex="0" role="option" aria-describedby="slick-slide03" data-slick-index="3" aria-hidden="false"> 
					<div class="thumb" data-hq="http://localhost:8080/wp-content/uploads/2017/09/Contempary-stairs-Tigerwood-treadsplain-wrought-iron-balusters-posts.jpg" data-w="1440" data-h="1080" data-med="http://localhost:8080/wp-content/uploads/2017/09/Contempary-stairs-Tigerwood-treadsplain-wrought-iron-balusters-posts-600x600.jpg" data-medw="600" data-medh="600">
						<img class="attachment-shop_thumbnail size-shop_thumbnail" src="http://localhost:8080/wp-content/uploads/2017/09/Contempary-stairs-Tigerwood-treadsplain-wrought-iron-balusters-posts-180x180.jpg" alt="" srcset="http://localhost:8080/wp-content/uploads/2017/09/Contempary-stairs-Tigerwood-treadsplain-wrought-iron-balusters-posts-180x180.jpg 180w, http://localhost:8080/wp-content/uploads/2017/09/Contempary-stairs-Tigerwood-treadsplain-wrought-iron-balusters-posts-150x150.jpg 150w, http://localhost:8080/wp-content/uploads/2017/09/Contempary-stairs-Tigerwood-treadsplain-wrought-iron-balusters-posts-100x100.jpg 100w, http://localhost:8080/wp-content/uploads/2017/09/Contempary-stairs-Tigerwood-treadsplain-wrought-iron-balusters-posts-300x300.jpg 300w, http://localhost:8080/wp-content/uploads/2017/09/Contempary-stairs-Tigerwood-treadsplain-wrought-iron-balusters-posts-600x600.jpg 600w" sizes="(max-width: 180px) 100vw, 180px" height="180" width="180"> 
					</div>
					</li>
				</div>
			</div>
			<button class="slick-next slick-arrow slick-disabled" type="button" data-role="none" aria-label="Next" role="button" style="display: block;" aria-disabled="true">Next</button> 
		</ul>
	</div>
</div>-->
<?php
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$thumbnail_size    = apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' );
$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, $thumbnail_size );
$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . $placeholder,
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
	'col-md-6'
) );

?>
<div id="wooswipe" class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 1; transition: opacity .25s ease-in-out;">
	<figure class="woocommerce-product-gallery__wrapper">
			<?php
			$zoomed_image_size = array(1920, 1080);
			if ( has_post_thumbnail() ) {
				$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );

				$hq = wp_get_attachment_image_src( get_post_thumbnail_id(), apply_filters( 'wooswipe_zoomed_image_size', $zoomed_image_size ) );
				$image = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ),
					array(
						'title' => '',
						'data-hq' => $hq[0],
						'data-w' => $hq[1],
						'data-h' => $hq[2],
						)
				);

				//$attachment_count = count( $attachment_ids );

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '
					<div class="woocommerce-product-gallery__image single-product-main-image">
						<a href="%s"  class="woocommerce-main-image zoom" title="%s" >%s</a>
					</div>',
					$image_link, $image_title, $image ), $post->ID );
			} else {
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
			}



