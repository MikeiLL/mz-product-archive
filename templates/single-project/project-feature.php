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
				$thumbnail_id = get_post_thumbnail_id();
				$image_title = esc_attr( get_the_title( $thumbnail_id ) );
				$image_link  = wp_get_attachment_url( $thumbnail_id );
				
				$caption = wp_get_attachment_caption($thumbnail_id);
				$caption = (!empty($caption)) ? $caption : "";
				$hq = wp_get_attachment_image_src( get_post_thumbnail_id(), apply_filters( 'wooswipe_zoomed_image_size', $zoomed_image_size ) );
				$image = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ),
					array(
						'title' => get_the_title($thumbnail_id),
						'data-hq' => $hq[0],
						'data-w' => $hq[1],
						'data-h' => $hq[2],
						'data-caption' => $caption,
						'data-title' => $caption
						)
				);

				//$attachment_count = count( $attachment_ids );

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '
					<div class="woocommerce-product-gallery__image single-product-main-image">
						<a href="%s"  class="woocommerce-main-image zoom" title="%s" >%s</a>
					</div>',
					$image_link, $image_title, $image ), $post->ID );
			} else {
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', mzoo_project_archive_default_image(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
			}



