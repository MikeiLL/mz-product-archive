<?php
/**
 * project Images
 *
 * Display the project images meta box.
 *
 * @author      WooThemes
 * @category    Admin
 * @package     WooCommerce/Admin/Meta Boxes
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * WC_Meta_Box_project_Images Class.
 */
class MZ_Meta_Box_project_Images {

	/**
	 * Output the metabox.
	 *
	 * @param WP_Post $post
	 */
	public static function output( $post ) {
		?>
		<div id="project_images_container">
			<ul class="project_images">
				<?php
					if ( metadata_exists( 'post', $post->ID, '_project_image_gallery' ) ) {
						$project_image_gallery = get_post_meta( $post->ID, '_project_image_gallery', true );
					} else {
						// Backwards compat
						$attachment_ids = get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids&meta_key=_woocommerce_exclude_image&meta_value=0' );
						$attachment_ids = array_diff( $attachment_ids, array( get_post_thumbnail_id() ) );
						$project_image_gallery = implode( ',', $attachment_ids );
					}

					$attachments         = array_filter( explode( ',', $project_image_gallery ) );
					$update_meta         = false;
					$updated_gallery_ids = array();

					if ( ! empty( $attachments ) ) {
						foreach ( $attachments as $attachment_id ) {
							$attachment = wp_get_attachment_image( $attachment_id, 'thumbnail' );

							// if attachment is empty skip
							if ( empty( $attachment ) ) {
								$update_meta = true;
								continue;
							}

							echo '<li class="image" data-attachment_id="' . esc_attr( $attachment_id ) . '">
								' . $attachment . '
								<ul class="actions">
									<li><a href="#" class="delete tips" data-tip="' . esc_attr__( 'Delete image', 'woocommerce' ) . '">' . __( 'Delete', 'woocommerce' ) . '</a></li>
								</ul>
							</li>';

							// rebuild ids to be saved
							$updated_gallery_ids[] = $attachment_id;
						}

						// need to update project meta to set new gallery ids
						if ( $update_meta ) {
							update_post_meta( $post->ID, '_project_image_gallery', implode( ',', $updated_gallery_ids ) );
						}
					}
				?>
			</ul>

			<input type="hidden" id="project_image_gallery" name="project_image_gallery" value="<?php echo esc_attr( $project_image_gallery ); ?>" />

		</div>
		<p class="add_project_images hide-if-no-js">
			<a href="#" data-choose="<?php esc_attr_e( 'Add images to project gallery', 'woocommerce' ); ?>" data-update="<?php esc_attr_e( 'Add to gallery', 'woocommerce' ); ?>" data-delete="<?php esc_attr_e( 'Delete image', 'woocommerce' ); ?>" data-text="<?php esc_attr_e( 'Delete', 'woocommerce' ); ?>"><?php _e( 'Add project gallery images', 'woocommerce' ); ?></a>
		</p>
		<?php
	}

	/**
	 * Save meta box data.
	 *
	 * @param int $post_id
	 * @param WP_Post $post
	 */
	public static function save( $post_id, $post ) {
		$attachment_ids = isset( $_POST['project_image_gallery'] ) ? array_filter( explode( ',', wc_clean( $_POST['project_image_gallery'] ) ) ) : array();

		update_post_meta( $post_id, '_project_image_gallery', implode( ',', $attachment_ids ) );
	}
}
