<?php
/**
 * Single Project Meta
 *
 * @author 		WooThemes
 * @package 	Projects/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
?>
<div class="project-meta">

	<?php
		// Categories
		$terms_as_text 	= get_the_term_list( $post->ID, 'project-category', '<li>', '</li><li>', '</li>' );

		do_action( 'projects_before_meta' );

		/**
		 * Display categories if they're set
		 */
		if ( $terms_as_text ) {
			echo '<div class="categories">';
			echo '<h3>' . __( 'Categories', 'projects-by-mzoo' ) . '</h3>';
			echo '<ul class="single-project-categories">';
			echo $terms_as_text;
			echo '</ul>';
			echo '</div>';
		}

		do_action( 'projects_after_meta' );
	?>
</div>