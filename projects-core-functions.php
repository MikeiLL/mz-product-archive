<?php
/**
 * WooThemes Projects Core Functions
 *
 * Functions available on both the front-end and admin.
 *
 * @author 		WooThemes
 * @category 	Core
 * @package 	Projects/Functions
 * @version     1.0.0
 */

if ( ! function_exists( 'projects_get_page_id' ) ) {

	/**
	 * WooThemes Projects page IDs
	 *
	 * retrieve page ids - used for projects
	 *
	 * returns -1 if no page is found
	 *
	 * @access public
	 * @param string $page
	 * @return int
	 */
	function projects_get_page_id ( $page ) {
		$options 	= get_option( 'projects-pages-fields' );
		$page 		= apply_filters( 'projects_get_' . $page . '_page_id', $options[ $page . '_page_id' ] );

		return $page ? $page : -1;
	} // End projects_get_page_id()
}

if ( ! function_exists( 'projects_get_image' ) ) {

	/**
	 * Get the image for the given ID.
	 * @param  int 				$id   Post ID.
	 * @param  string/array/int $size Image dimension. (default: "projects-thumbnail")
	 * @since  1.0.0
	 * @return string       	<img> tag.
	 */
	function projects_get_image ( $id, $size = 'projects-thumbnail' ) {
		$response = '';

		if ( has_post_thumbnail( $id ) ) {
			// If not a string or an array, and not an integer, default to 150x9999.
			if ( is_int( $size ) || ( 0 < intval( $size ) ) ) {
				$size = array( intval( $size ), intval( $size ) );
			} elseif ( ! is_string( $size ) && ! is_array( $size ) ) {
				$size = array( 150, 9999 );
			}
			$response = get_the_post_thumbnail( intval( $id ), $size );
		}

		return $response;
	} // End projects_get_image()

}

/**
 * is_projects - Returns true if on a page which uses WooThemes Projects templates
 *
 * @access public
 * @return bool
 */
function is_projects () {
	return ( is_projects_archive() || is_product_category() || is_project() ) ? true : false;
} // End is_projects()

if ( ! function_exists( 'is_projects_archive' ) ) {

	/**
	 * is_projects_archive - Returns true when viewing the project type archive.
	 *
	 * @access public
	 * @return bool
	 */
	function is_projects_archive() {
		return ( is_post_type_archive( 'project' ) || is_project_taxonomy() || is_page( projects_get_page_id( 'projects' ) ) ) ? true : false;
	} // End is_projects_archive()
}

if ( ! function_exists( 'is_project_taxonomy' ) ) {

	/**
	 * is_project_taxonomy - Returns true when viewing a project taxonomy archive.
	 *
	 * @access public
	 * @return bool
	 */
	function is_project_taxonomy() {
		return is_tax( get_object_taxonomies( 'project' ) );
	} // End is_project_taxonomy()
}

if ( ! function_exists( 'is_product_category' ) ) {

	/**
	 * is_product_category - Returns true when viewing a project category.
	 *
	 * @access public
	 * @param string $term (default: '') The term slug your checking for. Leave blank to return true on any.
	 * @return bool
	 */
	function is_product_category( $term = '' ) {
		return is_tax( 'project-category', $term );
	} // End is_product_category()
}

if ( ! function_exists( 'is_project' ) ) {

	/**
	 * is_project - Returns true when viewing a single project.
	 *
	 * @access public
	 * @return bool
	 */
	function is_project() {
		return is_singular( array( 'project' ) );
	} // End is_project()
}

if ( ! function_exists( 'is_ajax' ) ) {

	/**
	 * is_ajax - Returns true when the page is loaded via ajax.
	 *
	 * @access public
	 * @return bool
	 */
	function is_ajax() {
		if ( defined('DOING_AJAX') )
			return true;

		return ( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) ? true : false;
	}
}

/**
 * Get template part (for templates like the projects-loop).
 *
 * @access public
 * @param mixed $slug
 * @param string $name (default: '')
 * @return void
 */
function projects_get_template_part( $slug, $name = '' ) {
	global $projects;
	$template = '';
	// Look in yourtheme/slug-name.php and yourtheme/projects/slug-name.php
	if ( $name )
		$template = locate_template( array ( "{$slug}-{$name}.php", "{$projects->template_url}{$slug}-{$name}.php" ) );

	// Get default slug-name.php
	if ( !$template && $name && file_exists( $projects->plugin_path() . "/templates/{$slug}-{$name}.php" ) )
		$template = $projects->plugin_path() . "/templates/{$slug}-{$name}.php";

	// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/projects/slug.php
	if ( !$template )
		$template = locate_template( array ( "{$slug}.php", "{$projects->template_url}{$slug}.php" ) );

	if ( $template )
		load_template( $template, false );
} // End projects_get_template_part()


/**
 * Get other templates and including the file.
 *
 * @access public
 * @param mixed $template_name
 * @param array $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return void
 */
function projects_get_template ( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	global $projects;

	if ( $args && is_array($args) )
		extract( $args );

	$located = projects_locate_template( $template_name, $template_path, $default_path );

	do_action( 'projects_before_template_part', $template_name, $template_path, $located, $args );

	include( $located );

	do_action( 'projects_after_template_part', $template_name, $template_path, $located, $args );
} // End projects_get_template()


/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 *		yourtheme		/	$template_path	/	$template_name
 *		yourtheme		/	$template_name
 *		$default_path	/	$template_name
 *
 * @access public
 * @param mixed $template_name
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return string
 */
function projects_locate_template( $template_name, $template_path = '', $default_path = '' ) {
	global $projects;

	if ( ! $template_path ) $template_path = $projects->template_url;
	if ( ! $default_path ) $default_path = $projects->plugin_path() . '/templates/';

	// Look within passed path within the theme - this is priority
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name
		)
	);

	// Get default template
	if ( ! $template )
		$template = $default_path . $template_name;

	// Return what we found
	return apply_filters( 'projects_locate_template', $template, $template_name, $template_path );
} // End projects_locate_template()

/**
 * Filter to allow product_cat in the permalinks for projects.
 *
 * @access public
 * @param string $permalink The existing permalink URL.
 * @param object $post
 * @return string
 */
function projects_project_post_type_link( $permalink, $post ) {
    // Abort if post is not a project
    if ( $post->post_type !== 'project' )
    	return $permalink;

    // Abort early if the placeholder rewrite tag isn't in the generated URL
    if ( false === strpos( $permalink, '%' ) )
    	return $permalink;

    // Get the custom taxonomy terms in use by this post
    $terms = get_the_terms( $post->ID, 'project-category' );

    if ( empty( $terms ) ) {
    	// If no terms are assigned to this post, use a string instead (can't leave the placeholder there)
        $product_cat = _x( 'uncategorized', 'slug', 'projects-by-mzoo' );
    } else {
    	// Replace the placeholder rewrite tag with the first term's slug
        $first_term = array_shift( $terms );
        $product_cat = $first_term->slug;
    }

    $find = array(
    	'%year%',
    	'%monthnum%',
    	'%day%',
    	'%hour%',
    	'%minute%',
    	'%second%',
    	'%post_id%',
    	'%category%',
    	'%product_category%'
    );

    $replace = array(
    	date_i18n( 'Y', strtotime( $post->post_date ) ),
    	date_i18n( 'm', strtotime( $post->post_date ) ),
    	date_i18n( 'd', strtotime( $post->post_date ) ),
    	date_i18n( 'H', strtotime( $post->post_date ) ),
    	date_i18n( 'i', strtotime( $post->post_date ) ),
    	date_i18n( 's', strtotime( $post->post_date ) ),
    	$post->ID,
    	$product_cat,
    	$product_cat
    );

    $replace = array_map( 'sanitize_title', $replace );

    $permalink = str_replace( $find, $replace, $permalink );

    return $permalink;
} // End projects_project_post_type_link()

add_filter( 'post_type_link', 'projects_project_post_type_link', 10, 2 );

/**
 * projects_get_gallery_attachment_ids function.
 *
 * @access public
 * @return array
 */
function projects_get_gallery_attachment_ids ( $post_id = 0 ) {
	global $post;
	if ( 0 == $post_id ) $post_id = get_the_ID();
	$project_image_gallery = get_post_meta( $post_id, '_project_image_gallery', true );
	if ( '' == $project_image_gallery ) {
		// Backwards compat
		$attachment_ids = get_posts( 'post_parent=' . intval( $post_id ) . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' );
		$attachment_ids = array_diff( $attachment_ids, array( get_post_thumbnail_id() ) );
		$project_image_gallery = implode( ',', $attachment_ids );
	}
	return array_filter( (array) explode( ',', $project_image_gallery ) );
} // End projects_get_gallery_attachment_ids()


/**
 * Add body classes for Projects pages
 *
 * @param  array $classes
 * @return array
 */
function woo_projects_body_class( $classes ) {
	$classes = (array) $classes;

	if ( is_projects() ) {
		$classes[] = 'projects';
		$classes[] = 'projects-page';
	}

	if ( is_project() ) {

		$attachments = count( projects_get_gallery_attachment_ids() );

		if ( $attachments > 0 ) {
			$classes[] = 'has-gallery';
		} else {
			$classes[] = 'no-gallery';
		}

		if ( !has_post_thumbnail() ) {
			$classes[] = 'no-cover-image';
		}

	}

	return array_unique( $classes );
}


/**
 * Find a category image.
 * @since  1.0.0
 * @return string
 */
function projects_category_image ( $cat_id = 0 ) {

	global $post;

	if ( 0 == $cat_id  ) return;

	$image = '';

	if ( false === ( $image = get_transient( 'projects_category_image_' . $cat_id ) ) ) {

		$cat = get_term( $cat_id, 'project-category' );

		$query_args = array(
			'post_type' => 'project',
			'posts_per_page' => -1,
			'no_found_rows' => 1,
			'tax_query' => array(
				array(
					'taxonomy'	=>	'project-category',
					'field'		=>	'id',
					'terms'		=>	array( $cat->term_id )
				)
			)
		);

		$query = new WP_Query( $query_args );

		while ( $query->have_posts() && $image == '' ) : $query->the_post();

			$image = projects_get_image( get_the_ID() );

			if ( $image ) {
				$image = '<a href="' . get_term_link( $cat ) . '" title="' . $cat->name . '">' . $image . '</a>';
				set_transient( 'projects_category_image_' . $cat->term_id, $image, 60 * 60 ); // 1 Hour.
			}

		endwhile;

		wp_reset_postdata();

	} // get transient

	return $image;

} // End projects_category_image()

/**
 * When a post is saved, flush the transient used to store the category images.
 * @since  1.0.0
 * @return void
 */
function projects_category_image_flush_transient ( $post_id ) {
	if ( get_post_type( $post_id ) != 'project' ) return; // we only want projects
	$categories = get_the_terms( $post_id, 'project-category' );
	if ( $categories ) {
		foreach ($categories as $category ) {
			delete_transient( 'projects_category_image_' . $category->term_id );
		}
	}
} // End projects_category_image_flush_transient()
add_action( 'save_post', 'projects_category_image_flush_transient' );

/**
 * Enqueue styles
 */
function projects_script() {

	// Register projects CSS 
	wp_register_style( 'projects-styles', plugins_url( '/dist/css/woo-projects.css', __FILE__ ), array(), PROJECTS_VERSION );
	wp_register_style( 'projects-handheld', plugins_url( '/dist/css/woo-projects-handheld.css', __FILE__ ), array(), PROJECTS_VERSION );
	
	/*
	 * This is basically copied from WooSwipe with alteration to load 
	 * if page is a Project page
	 *
	 */
	if ( is_project() ) {
		wp_enqueue_style( 'pswp-css', plugins_url( '/pswp/photoswipe.css', __FILE__ ) );

	    wp_enqueue_style( 'pswp-skin', plugins_url( '/pswp/default-skin/default-skin.css', __FILE__ )  );
	    wp_enqueue_style( 'slick-css', plugins_url( '/slick/slick.css', __FILE__ ));
	    wp_enqueue_style( 'slick-theme', plugins_url( '/slick/slick-theme.css', __FILE__ ));

	    wp_enqueue_script( 'pswp', plugins_url( '/pswp/photoswipe.min.js', __FILE__ ), null, PROJECTS_VERSION, true );
	    wp_enqueue_script( 'pswp-ui', plugins_url( '/pswp/photoswipe-ui-default.min.js', __FILE__ ), null, PROJECTS_VERSION, true );

		wp_enqueue_script( 'slick', plugins_url( '/slick/slick.min.js', __FILE__ ), null, PROJECTS_VERSION, true );
	    	
	    wp_enqueue_style( 'mz-project-archive', plugins_url( '/dist/css/slickswipe.css', __FILE__ ));
	    wp_enqueue_script( 'mz-project-archive', plugins_url( '/dist/js/slickswipe.js', __FILE__ ), null, PROJECTS_VERSION, true );
	    
	}
	
	if (is_archive('project')) {
	    wp_enqueue_style( 'mz-project-archive', plugins_url( '/dist/css/flickity.css', __FILE__ ));
	    wp_enqueue_style( 'projects-flickity', plugins_url( '/flickity/dist/flickity.min.css', __FILE__ ));
	    wp_enqueue_script( 'projects-flickity', plugins_url( '/flickity/dist/flickity.pkgd.min.js', __FILE__ ), null, PROJECTS_VERSION, true );
	    wp_enqueue_script( 'mz-project-archive', plugins_url( '/dist/js/project-init.js', __FILE__ ), null, PROJECTS_VERSION, true );
	}

	if ( apply_filters( 'projects_enqueue_styles', true ) ) {

		// Load Main styles
		wp_enqueue_style( 'projects-styles' );

		// Load styles applied to handheld devices
		wp_enqueue_style( 'projects-handheld' );

		// Load Dashicons
		if ( is_project() ) {
			wp_enqueue_style( 'dashicons' );
		}
	}

}

/* Taxonomy Breadcrumb */

if( !function_exists( 'inspiry_get_breadcrumbs_items' ) ) :
    /**
     * Returns a array of breadcrumbs items
     *
     * Source: https://gist.github.com/saqibsarwar/471cb91a6b17ffc457e2
     * @param $post_id  int Post id
     * @param $breadcrumbs_taxonomy string Taxonomy name
     * @return mixed|void
     */
    function inspiry_get_breadcrumbs_items( $post_id, $breadcrumbs_taxonomy, $home_page_id ) {
        // Add home at the beginning of the breadcrumbs
		$inspiry_breadcrumbs_items = array(
            array(
                'name' => __( 'Projects', 'mz-project-archive' ),
                //'url' => esc_url( home_url('/') ),
                'url' => esc_url( get_permalink($home_page_id) ),
                'class' => '',
            )
        );
        // Get all assigned terms
        $the_terms = get_the_terms( $post_id, $breadcrumbs_taxonomy);
        if ( $the_terms && ! is_wp_error( $the_terms ) ) :
        	// Work with first term in array
            $deepest_term = $the_terms[0];
            $deepest_depth = 0;
            // Find the deepest term
            foreach( $the_terms as $term ) {
                $current_term_depth = inspiry_get_term_depth( $term->term_id, $breadcrumbs_taxonomy );
                if ( $current_term_depth > $deepest_depth ) {
                    $deepest_depth = $current_term_depth;
                    $deepest_term = $term;
                }
            }
            // work on deepest term
            if ( $deepest_term ) {
                // Get ancestors if any and add them to breadcrumbs items
                $deepest_term_ancestors = get_ancestors( $deepest_term->term_id, $breadcrumbs_taxonomy );
                if ( $deepest_term_ancestors && ( 0 < count( $deepest_term_ancestors ) ) ) {
                    $deepest_term_ancestors = array_reverse( $deepest_term_ancestors ); // reversing the array is important
                    foreach ( $deepest_term_ancestors as $term_ancestor_id ) {
                        $ancestor_term = get_term_by( 'id', $term_ancestor_id, $breadcrumbs_taxonomy );
                        $inspiry_breadcrumbs_items[] = array(
                            'name' => $ancestor_term->name,
                            'url' => get_term_link( $ancestor_term, $breadcrumbs_taxonomy ),
                            'class' => ''
                        );
                    }
                }
                // add deepest term
                $inspiry_breadcrumbs_items[] = array(
                    'name' => $deepest_term->name,
                    'url' => get_term_link( $deepest_term, $breadcrumbs_taxonomy ),
                    'class' => ''
                );
            }
        endif;
        // Add the current page / property
        $inspiry_breadcrumbs_items[] = array(
            'name' => get_the_title( $post_id ),
            'url' => '',
            'class' => 'active',
        );		
		return apply_filters( 'inspiry_breadcrumbs_items', $inspiry_breadcrumbs_items );
	}
endif;
if( !function_exists( 'inspiry_get_term_depth' ) ) :
    /**
     * Returns an integer value that tells the term depth in it's hierarchy
     *
     * @param $term_id
     * @param $term_taxonomy
     * @return int
     */
    function inspiry_get_term_depth( $term_id, $term_taxonomy ) {
        $term_ancestors = get_ancestors( $term_id, $term_taxonomy );
        if ( $term_ancestors ) {
            return count( $term_ancestors );
        }
        return 0;
    }
endif;

if (!function_exists('mzoo_get_the_term_children')) {
	function mzoo_get_the_term_children($taxonomy = 'project-category') {
		$term_query = new WP_Term_Query( array( 'taxonomy' => $taxonomy, 
												'orderby' => 'name', 
												'child_of' => get_queried_object()->term_id,
												'hide_empty' => true ) );
		if ($term_query->terms == '') return false;
		$term_children_links = array();
		foreach ($term_query->terms as $term):
			$term_children_links[$term->name] = get_term_link($term->term_id);
		endforeach;
		return $term_children_links;
	}
} // if function not exists

if (!function_exists('mzoo_portfolio_intro')) {
	function mzoo_portfolio_intro($post_type = 'project') {
		
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
		
		$result = '<div class="container">';
		
		$result .= '	<div class="row portfolio__intro">';

		if( $the_query->have_posts() ): 
			while ( $the_query->have_posts() ) : $the_query->the_post(); 
				if(has_post_thumbnail()) {
					$thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'project-archive');
					$background = 'background: url(' . $thumbnail . '); background-repeat: no-repeat;background-size: auto;';
				 } else {
				 	$background = 'background-color: #999999';
				 }
				$result .= '	<div class="col-md-4 col-lg-3" style="' . $background . ' width:400px; height:400px">';
				$result .= '		<h4>' . get_the_title() . '</h4>'; 
				$result .= '	</div>';
			endwhile; 
		endif; 
		
		$result .= '	</div>';
		
		$result .= '</div>';

		wp_reset_query();	 // Restore global post data stomped by the_post(). 
		
		return $result;
	}
} // if function not exists
add_shortcode('portfolio_intro', 'mzoo_portfolio_intro');
