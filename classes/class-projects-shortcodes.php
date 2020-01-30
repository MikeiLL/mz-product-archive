<?php
/**
 * Projects_Shortcodes class.
 *
 * @class 		Projects_Shortcodes
 * @version		1.0.0
 * @package 	WordPress
 * @subpackage 	Projects/Classes
 * @category	Class
 * @author 		WooThemes
 */
class Projects_Shortcodes {

	public function __construct() {
		// Regular shortcodes
		add_shortcode( 'projects', array( $this, 'projects' ) );
		add_shortcode( 'categories_intro', array( $this, 'mzoo_categories_intro'));
		add_shortcode( 'portfolio_intro', array( $this, 'mzoo_portfolio_intro'));
	}

	/**
	 * Shortcode Wrapper
	 *
	 * @param mixed $function
	 * @param array $atts (default: array())
	 * @return string
	 */
	public static function shortcode_wrapper(
		$function,
		$atts = array(),
		$wrapper = array(
			'class' 	=> 'projects',
			'before' 	=> null,
			'after' 	=> null
		)
	){
		ob_start();

		$before 		= empty( $wrapper['before'] ) ? '<div class="' . $wrapper['class'] . '">' : $wrapper['before'];
		$after 			= empty( $wrapper['after'] ) ? '</div>' : $wrapper['after'];

		echo $before;
		call_user_func( $function, $atts );
		echo $after;

		return ob_get_clean();
	}

	/**
	 * Recent Products shortcode
	 *
	 * @access public
	 * @param array $atts
	 * @return string
	 */
	public function projects( $atts ) {

		global $projects_loop;

		extract( shortcode_atts( array(
			'limit' 				=> '12',
			'columns' 				=> '2',
			'orderby' 				=> 'date',
			'order' 				=> 'desc',
			'exclude_categories'	=> null,
			'include_children'		=> true
		), $atts ) );

		// Cater for fallback on false attribute
		if ( $include_children === 'false' ) {
			$include_children = false;
		} // End If Statement

		$args = array(
			'post_type'				=> 'project',
			'post_status' 			=> 'publish',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' 		=> $limit,
			'orderby' 				=> $orderby,
			'order' 				=> $order,
			'tax_query' 			=> array(
										array(
											'taxonomy' 	=> 'project-category',
											'field' 	=> 'id',
											'terms' 	=> explode( ',', $exclude_categories ),
											'include_children'	=> $include_children,
											'operator' 	=> 'NOT IN'
										)
									)
		);

		ob_start();

		$projects = new WP_Query( apply_filters( 'projects_query', $args, $atts ) );

		$projects_loop['columns'] = $columns;

		if ( $projects->have_posts() ) : ?>

			<?php projects_project_loop_start(); ?>

				<?php while ( $projects->have_posts() ) : $projects->the_post(); ?>

					<?php projects_get_template_part( 'content', 'project' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php projects_project_loop_end(); ?>

		<?php endif;

		wp_reset_postdata();

		return '<div class="projects columns-' . $columns . '">' . ob_get_clean() . '</div>';

	}
	
	public function mzoo_portfolio_intro($post_type = 'project') {
		
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
		
			// Count posts to send post index to the Portfolio page
			$count = 0;
		
			$result = '<div class="container">';
		
			$result .= '	<div class="row portfolio__intro">';

			if( $the_query->have_posts() ): 
				while ( $the_query->have_posts() ) : $the_query->the_post(); 
					if(has_post_thumbnail()) {
						$thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'project-archive');
						$background = 'background: url(' . $thumbnail . '); ';
					 } else {
						$background = 'background-color: #999999';
					 }
					$project_category = get_the_terms(get_the_ID(), 'project-category');
					$project_category_name = (is_object($project_category[0]) && (!empty($project_category[0]->name))) ? $project_category[0]->name : '';
					$result .= '	<a class="portfolio__hp-thumb col-6 col-md-3" href="' . home_url('portfolio') . add_query_arg('portfolio_item', $count, get_post_type_archive_link( "portfolio" )) .'" style="' . $background . ' ">';
					$result .= '		<div class="portfolio__hp-content">'; 
					$result .= '			<h4 class="portfolio__thumb-title">' . get_the_title() . '</h4>';
					$result .= '			<h5><strong>' . $project_category_name . '</strong></h5>';
					$result .= '		</div>';
					$result .= '	</a>';
					$count++;
				endwhile; 
			endif; 
		
			$result .= '	</div>';
		
			$result .= '</div>';

			wp_reset_query();	 // Restore global post data stomped by the_post(). 
		
			return $result;
		}


		public function mzoo_categories_intro($post_type = 'project') {
		
			require_once( 'classes/class-list-category-walker.php' );
		
			$args = array('taxonomy' => 'project-category',
				  'title_li' => '',
				  'depth' => 1,
				  'walker' => new List_Category_Walker,
				  'style' => '',
				  'echo' => 0
				);
				  ?>

			<?php $categories = wp_list_categories($args);

			if ( $categories ) {
				return '<div class="category-grid card-columns">'.$categories.'</div>';
			} else {
				return "<h3>No Categories to display.</h3>";
			}

		}

}


new Projects_Shortcodes();
