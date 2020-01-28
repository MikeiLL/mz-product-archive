<?php
/**
 * Projects category filter
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// See if this is a WP_Term object ie category archive
$obj = get_queried_object();
if (is_a($obj, 'WP_Term')):

	// If there are children, we can filter by taxonomy
	$project_terms = mzoo_get_the_term_children( $obj->term_id, 'project-category');
	
	if (empty( $project_terms )) return;
	
	$count = count($project_terms);
	
	printf( '%s subcategories: ', $count );

	foreach ($project_terms as $name => $link): ?>
		<a href="<?php echo $link ?>"><?php echo $name ?></a>
		<?php $count--; ?>
		<?php if ($count > 0): ?>
		<span class="breadcrumb-separator"> | </span>
		<?php endif;
	endforeach;
?>
<br style="clear: both;" />

<?php

endif;

/*$project_terms = mzoo_get_the_term_children_select('project-category');
*if ($project_terms):
*	$count = count($project_terms);
*	foreach ($project_terms as $name => $link): ?>
*		<a href="<?php echo $link ?>"><?php echo $name ?></a>
*		<?php $count--; ?>
*		<?php if ($count > 0): ?>
*		<span class="breadcrumb-separator"> | </span>
*		<?php endif;
*	endforeach;
*endif; // terms
*/	
?>
