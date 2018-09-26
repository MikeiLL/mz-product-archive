<?php
/**
 * Projects breadcrumb
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if (!is_post_type_archive()):
//source: https://gist.github.com/saqibsarwar/471cb91a6b17ffc457e2
	global $post;
	$home_page_id = get_option( 'projects-pages-fields' )['projects_page_id'];
	$inspiry_breadcrumbs_items = inspiry_get_breadcrumbs_items( $post->ID, 'project-category', $home_page_id);
	if ( is_array( $inspiry_breadcrumbs_items ) && ( 0 < count( $inspiry_breadcrumbs_items ) ) && (!in_array(get_queried_object_id(), array($home_page_id, 0) ) ) ) {
		?>
		<nav class="projects-breadcrumb">
			<?php
			foreach( $inspiry_breadcrumbs_items as $item ) :
				$class = ( !empty( $item['class'] ) ) ? 'class="' . $item['class'] . '"' : '';
				if ( !empty ( $item['url'] ) ) :
					?>
						<a href="<?php echo esc_url( $item['url'] ); ?>" <?php echo $class ?>><?php echo $item['name']; ?></a>   
						<?php if (get_queried_object()->name === $item['name']) { ?>
	   </nav>
						<?php
							break; 
						}
						?>                    
						<span class="breadcrumb-separator"> / </span>
					<?php
				else :
					?>
					<?php echo $item['name']; ?>
					<?php
				endif;
			endforeach;
			?>
		</nav>
		<?php
	}
?>
<br style="clear: both;" />
<?php endif; ?>