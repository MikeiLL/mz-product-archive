<?php
/**
 * The template for displaying project content within loops.
 *
 * Override this template by copying it to yourtheme/projects/content-project.php
 *
 * @author 		WooThemes
 * @package 	Projects/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  ?>

<?php
/**
* projects_loop_item hook
*
* @hooked projects_template_loop_project_thumbnail - 10
* @hooked projects_template_loop_project_title - 20
*/
//do_action( 'projects_loop_item' );
$project_thumb = projects_get_project_thumbnail('project-thumbnail');

if (!empty($project_thumb)):
	  echo $project_thumb;
else:
	// This is a hack.
	echo '<img style="width:100px;height:100px" src="' . mzoo_project_archive_default_image() . '"/>';
endif;

?>

