<?php
/*
Template Name: Single_event page
*/
?>
<?php
get_header();
?>
<?php
$id = $_GET['id'];
$events_query = tribe_get_events(
    array(
        'eventDisplay'=>'upcoming',
        'ID'=>$id,
)
);
$featrued_image = tribe_event_featured_image( $id, 'large', false, false );
$start_date = tribe_get_start_date($id,true,'j M Y');
$end_date = tribe_get_end_date($id,true,'j M Y');

$date = ($start_date == $end_date) ? $start_date : $start_date." - ".$end_date;

?>
<div class="container">
<section class="blog-inner">
    <div class="row">
        <div class="col-md-8">
            <article>
                    <div class="card-body card-event">
                    <h2><?=$events_query[0]->post_title ?></h2>
                    <h6><?=tribe_get_start_date($id); ?></h6>

                    <p><?=$events_query[0]->post_content ?></p>
                    <?php if(!empty($featrued_image))
                    {?>
                        <figure class="wp-block-image size-full"><img src="<?=$image?>" alt="" class="wp-image-48"></figure>
                    <?php }
                        $start_datetime1 = tribe_get_start_date($id,true,'h A');
                        $start_time1 = ltrim($start_datetime1,'0');
                        $end_datetime1 = tribe_get_end_date($id,true,'h A');
                        $end_time1 = ltrim($end_datetime1,'0');
                    ?>
                    <p>Date : <b><?=$date ?></b></p>
                    <p>Time : <b><?=$start_time1?> to <?=$end_time1?></b></p>    
                    <p>at <b><?=tribe_get_address($id)?>, <?=tribe_get_venue($id)?>, <?=tribe_get_city($id);?>, <?=tribe_get_country($id);?> - <?=tribe_get_zip($id);?></b></p>    
                    </div>
            </article>
        </div>
        <div class="col-md-4">
            <a href="allevents" style="color:#000">All events</a>
        </div>
    </div>
</section>
</div>
        

<?php
get_footer();
?>