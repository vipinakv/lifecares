<?php
/*
Template Name: Blog page
*/
$base_url = get_bloginfo('wpurl');
?>
<?php get_header(); ?>

<div class="container">
<div class="news-list">
    <h2 class="text-center">Blogs</h2>
	<div class="row ">
		<div class="col-md-8">
  
<?php 
// the query
$wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1)); 

//Custom query for pagination
 $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$args = array(
               'posts_per_page' => 5,// query last 5 posts  
               'paged' => $paged,
				'post_type'=>'post', 
				'post_status'=>'publish',
             );
$customQuery = new WP_Query($args);
?>
 
<?php if ( $customQuery->have_posts() ) : ?>
 
	<div class="news-list-wrap">
							
 
    <!-- the loop -->
    <?php while ( $customQuery->have_posts() ) : $customQuery->the_post(); ?>
    <div class="news-card">
    <div class="thumbnail-div">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('');?>
									
									</a>
		<?php $category = get_the_category();?>
									<span class="category d-flex"><a href="<?=$base_url?>/categories?cat=<?=$category[0]->slug?>"><?=$category[0]->name?></a></span>
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
    <?php endwhile; ?>
    <!-- end of the loop -->
 	<!-- Add the pagination functions here. -->
<?php
 if (function_exists("cq_pagination")) {
		cq_pagination($customQuery->max_num_pages); 
}
?>   
                         
    </div>
 
    <?php wp_reset_postdata(); ?>
 
<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
</div>
<?php get_sidebar()?>
</div>
	</div>
</div>

<?php get_footer(); ?>