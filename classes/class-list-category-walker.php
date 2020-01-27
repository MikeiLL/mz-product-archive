<?php

/**
 * Walker Class for List Category which also pulls in image from ACF Field
 * source: https://wordpress.stackexchange.com/a/170603/48604
 *
 * Wrapped by card-columns in content-global-roject-categories.php
 * source https://getbootstrap.com/docs/4.1/components/card/#card-decks
 *
 */


class List_Category_Walker extends Walker_Category {
    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {

        $cat_name = apply_filters(
            'list_cats',
            esc_attr( $category->name ),
            $category
        );

        // Get array of images from ACF Image field
        if (function_exists('get_field')):
          $image_array = get_field('main_category_image', 'term_' . $category->term_id);
        else:
          $image_array = [];
        endif;

        // But if that's not set set it to image from latest post within category
        if (empty($image_array['sizes']['medium'])):

          // Get one post
          $args = array(
            'post_type' => 'project',
            'tax_query' => array([
                'taxonomy' => 'project-category',
                'terms' => $category->term_id,
            ]),
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'ASC'
          );

          global $post;

          $query = new WP_Query($args);

          if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {

              $query->the_post();

              $image = get_the_post_thumbnail_url( $post->ID, 'thumbnail', null );
              // Is there actually an image for this post?
              if (!$image) {
                $image =  get_template_directory_uri() . '/dist/images/category-icons-png.png';
              }
            }

          wp_reset_postdata();

          } else {
            // Do nothing.
          }

        else:
          $image = $image_array['sizes']['thumbnail'];
        endif;

        if ( ! empty( $args['show_count'] ) ) {
          $count = ' (' . number_format_i18n( $category->count ) . ')';
        }

        $class = 'card cat-item cat-item-' . $category->term_id;
        if ( ! empty( $args['current_category'] ) ) {
            $_current_category = get_term( $args['current_category'], $category->taxonomy );
            if ( $category->term_id == $args['current_category'] ) {
                $class .=  ' current-cat';
            } elseif ( $category->term_id == $_current_category->parent ) {
                $class .=  ' current-cat-parent';
            }
        }
        $output .= '  <a href="' . esc_url( get_term_link( $category ) ) . '" class="' . $class . '">';
        $output .= '    <div class="row no-gutters">';
        $output .= '      <div class="col-auto">';
        $output .= '        <img class="img-fluid" src="' . $image . '" alt="'. $category->name .'">';
        $output .= '      </div>';
        $output .= '      <div class="col align-items-center d-flex justify-content-center">';
        $output .= '        <h5 class="card-title mx-1">' . $cat_name . '</h5>';
        $output .= '      </div>';
    }

     public function end_el( &$output, $page, $depth = 0, $args = array() ) {
        $output .= "      </div>\n";
        $output .= "  </a>\n";
    }
}
