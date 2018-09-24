<?php
/**
 * The template for displaying project content in the single-project.php template
 *
 * Override this template by copying it to yourtheme/projects/content-single-project.php
 *
 * @author 		WooThemes
 * @package 	Projects/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	/**
	 * projects_before_single_project hook
	 *
	 */
	 do_action( 'projects_before_single_project' );
?>

<div id="project-<?php the_ID(); ?>" <?php post_class('row'); ?>>

	<?php
		/**
		 * projects_before_single_project_description hook
		 * @hooked projects_template_single_title - 10
		 * @hooked projects_template_single_short_description - 20
	 	 * @hooked projects_template_single_feature - 30
	 	 * @hooked projects_template_single_images - 40 was projects_template_single_gallery MikeiLL
		 */
		do_action( 'projects_before_single_project_description' );
	?>

		<?php
			/**
			 * projects_single_project_description hook
			 *
			 * @hooked projects_template_single_description - 10
			 * @hooked projects_template_single_meta - 20
			 */
			do_action( 'projects_single_project_description' );
		?>

	<?php
		/**
		 * projects_after_single_project_description hook
		 *
		 */
		do_action( 'projects_after_single_project_description' );
	?>

</div><!-- #project-<?php the_ID(); ?> -->

<?php
	/**
	 * projects_after_single_project hook
	 *
	 * @hooked projects_single_pagination - 10
	 */
	do_action( 'projects_after_single_project' );