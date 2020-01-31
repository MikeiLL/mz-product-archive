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

// Count posts to send post index to the Portfolio page
$count = 0;
?>

<div class="container">
	<div class="row">
<?php
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
		?>
		<a class="portfolio__hp-thumb col-6 col-md-3" href="<?php home_url('portfolio') . add_query_arg('portfolio_item', $count, get_post_type_archive_link( "portfolio" )) ?>" style="<?php $background ?>">
			<div class="">
			<h4 class=""><?php the_title() ?></h4>
			<h5><strong><?php echo $project_category_name ?></strong></h5>
			</div>
		</a>
		<?php $count++; 
	endwhile; 
endif; 
?>

	</div>
</div>

<?php wp_reset_query();	 // Restore global post data stomped by the_post().  ?>
