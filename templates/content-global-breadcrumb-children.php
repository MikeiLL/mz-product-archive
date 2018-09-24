<?php
/**
 * Projects breadcrumb
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if (is_archive('project-category')):
	$project_terms = mzoo_get_the_term_children('project-category');
	if ($project_terms):
		$count = count($project_terms);
		?> Subcategories: <?php
		foreach ($project_terms as $name => $link): ?>
			<a href="<?php echo $link ?>"><?php echo $name ?></a>
			<?php $count--; ?>
			<?php if ($count > 0): ?>
			<span class="breadcrumb-separator"> | </span>
			<?php endif;
		endforeach;
	endif; // terms
?>
<br style="clear: both;" />
<?php endif; // is archive?>