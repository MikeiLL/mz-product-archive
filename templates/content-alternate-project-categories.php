<?php
/**
 * The Template for displaying project archives category list including heirarchy.
 *
 *
 * @author 		mZoo
 * @package 	Projects/Templates
 * @version     1.0.0
 */
$args = array('taxonomy' => 'project-category',
			  'title_li' => '',
			  'depth' => 1);
			  ?>

<ul class="list-inline"> <?php
wp_list_categories($args);
?>
</ul>

