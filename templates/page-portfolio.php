<?php
/**
 * The Template for displaying project archives, including the main showcase page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/projects/archive-project.php
 *
 * @author 		WooThemes
 * @package 	Projects/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $projects_loop;

// Store column count for displaying the grid
if ( empty( $projects_loop['columns'] ) )
	$projects_loop['columns'] = apply_filters( 'projects_loop_columns', 2 );

get_header( 'projects' ); ?>

	<?php
		/**
		 * projects_before_main_content hook
		 *
		 * @hooked projects_output_content_wrapper - 10 (outputs opening divs for the content)
		 */
		do_action( 'projects_before_main_content' );
	?>

		<?php if ( apply_filters( 'projects_show_page_title', true ) ) : ?>

			<h1 class="page-title">Portfolio</h1>

		<?php endif; ?>
		
		<?php
		$args = array(
			'numberposts'	=> 8,
			'post_type'		=> 'project',
			'meta_query'	=> array(
				'relation'		=> 'OR',
				array(
					'key'		=> 'portfolio_status',
					'value'		=> 'Portfolio Item',
					'compare'	=> 'LIKE'
				)
			)
		);


		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) : ?>

			<?php
				/**
				 * projects_before_loop hook
				 *
				 */
				do_action( 'portfolio_before_loop' );
			?>

			<div class="projects columns-<?php echo $projects_loop['columns']; ?>">

			<?php projects_portfolio_loop_start(); ?>

				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

					<?php projects_get_template_part( 'content', 'portfolio' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php projects_portfolio_loop_end(); ?>

			</div><!-- .projects -->

			<?php
				/**
				 * projects_after_loop hook
				 *
				 * @hooked projects_pagination - 10
				 */
				do_action( 'portfolio_after_loop' );
			?>

		<?php else : ?>

			<?php projects_get_template( 'loop/no-projects-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * projects_after_main_content hook
		 *
		 * @hooked projects_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'projects_after_main_content' );
	?>
	
	<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>

	<?php
		/**
		 * projects_sidebar hook
		 *
		 * @hooked projects_get_sidebar - 10
		 */
		do_action( 'projects_sidebar' );
	?>

<?php get_footer( 'projects' ); ?>