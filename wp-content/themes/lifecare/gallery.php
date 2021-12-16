<?php
/*
Template Name: Gallery page
*/

?>
<?php get_header(); ?>

<section class="page-title page-title-gallery">
    <div class="container">
    <h1>Gallery</h1>
    </div>
</section>
<section class="gallery">
    <div class="container">
        <div class="row justify-content-center">
        <?php 
            $results = $wpdb->get_results("SELECT * FROM wp_image_gallery");
            foreach($results as $result)
            {?>
                <div class="project-block">
                    <div class="inner-box">
                        <div class="image">
                            <a class="plus" href="<?=get_template_directory_uri()?>/assets/gallery/<?=$result->image_name?>" data-fancybox="gallery-1" data-caption=""
                            style="background-image: url('<?=get_template_directory_uri()?>/assets/gallery/<?=$result->image_name?>'); "    > 
                        </a>
                           
                        </div>
                    </div>
                </div>
            <?php }?>            
        </div>
    </div>
</section>

<?php get_footer(); ?>