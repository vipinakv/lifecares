<?php
/*
Template Name: Categories page
*/
?>
<?php
get_header();
?>
<?php 
$category = $_GET['cat'];
$query = 'SELECT name FROM wp_terms WHERE slug="'.$category.'"';
$results = $wpdb->get_results($query);
//Custom query for pagination
 $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$args = array(
               'posts_per_page' => 5,
               'paged' => $paged,
				'post_type'=>'post', 
				'post_status'=>'publish',
				'category_name'=> $category
             );
$customQuery = new WP_Query($args);
?>
    <div class="container">
    	<div class="news-list">
	<h2 class="text-center">
Category: <span class="category-head"><?=$results[0]->name;?></span>

	</h2>	
	<div style="margin-bottom:52px">
                <div class="separator__line" style="margin-left:auto;margin-right:auto"></div>
            </div>
		<div class="row ">


<div class="col-md-8">
 <?php if ( $customQuery->have_posts() ) : ?>


<!-- Start of the main loop. -->
<?php while ( $customQuery->have_posts() ) : $customQuery->the_post();  ?>

<!-- the rest of your theme's main loop -->
<div class="news-list-wrap">
							<div class="news-card">
								
							<div class="thumbnail-div">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('');?>
									
									</a>
									<span class="category d-flex"><?php the_category( '<a>','</a>' );?></span>
								</div>
								
							<div class="card-content">
						
							<a href="<?php the_permalink(); ?>"><?php the_title( '<h5>', '</h5>' ); ?></a>
								<?php the_excerpt( '<p>' );?>	
								<div class="calendar">
										<div class="date"><?php the_time( 'j' )?></div>
										<div class="month"><?php the_time( 'M' )?></div>
									</div>    
							</div>
								
								
								
	
							</div>

						</div>

<?php endwhile; ?>
<!-- End of the main loop -->

<!-- Add the pagination functions here. -->
<?php
 if (function_exists("cq_pagination")) {
	cq_pagination($customQuery->max_num_pages); 
}
?> 
    			<?php wp_reset_postdata(); ?>
 
				<?php else : ?>
    			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php endif; ?>
			
</div>
<?php get_sidebar()?>
</div>
		</div>
    </div>
<?php
get_footer();
?>