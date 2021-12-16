<?php
/*
Template Name: Allevents page
*/
$base_url = get_bloginfo('wpurl');

?>
<?php get_header(); ?>

<div class="container">
<div class="news-list">
    <h2 class="text-center">Events</h2>
	<div class="row ">
		<div class="col-md-8">
  
            <?php 
            $events_query = tribe_get_events(
                array(
                    'eventDisplay'=>'upcoming',
            )
            );
            ?>
            <div class="news-list-wrap">							
                <?php
                foreach($events_query as $post) {
                    $image = tribe_event_featured_image( $post->ID, 'large', false, false );
                ?>

                <div class="news-card">
                    <?php if(!empty($image))
                    {?>
                        <div class="thumbnail-div">
                        <a href="<?=$base_url?>/single_event?id=<?=$post->ID?>">
                        <img src="<?=tribe_event_featured_image( $post->ID, 'large', false, false );?>" class="attachment- size- wp-post-image" alt="" loading="lazy" width="360" height="280">
                        </a>
                        </div>
                    <?php } ?> 
                    <div class="card-content">

                        <a href="<?=$base_url?>/single_event?id=<?=$post->ID?>"><h5><?=$post->post_title?></h5></a>
                        <p><?=$post->post_excerpt?></p>
                        <p>On <?=tribe_get_start_date($post->ID,true,'j M Y')?></p>
                        <div class="calendar">
                                <div class="date"><?php the_time( 'j' )?></div>
                                <div class="month"><?php the_time( 'M' )?></div>
                        </div>    
                    </div>
                </div>

                <?php }?>
                <!-- end of the loop -->
                                    
            </div>
 
    <?php wp_reset_postdata(); ?>
        </div>
    </div>
</div>
</div>

<?php get_footer(); ?>