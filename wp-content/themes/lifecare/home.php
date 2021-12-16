<?php
/*
Template Name: Home page
*/
$base_url = get_bloginfo('wpurl');
?>
<?php get_header(); ?>

<div class="site-content-wrap">

<section class="hero">
    <div id="carouselExampleCaptions" class="carousel-fade carousel slide" data-bs-ride="carousel">


        <div class="carousel-inner">
            <div class="carousel-item active" id="ci-1">

                <div class="container">
                    <div class="carousel-caption d-md-block">
                        <h1 class="title">
                            Care n Cure
                        </h1>
                        <h2 class="subtitle">
                        <span  class="quote">"</span>Life is everywhere but Care is only in Lifecare<span  class="quote">"</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="carousel-item" id="ci-2">

                <div class="container">
                    <div class="carousel-caption d-md-block">
                        <h1 class="title">
                            Book your appointment
                        </h1>
                        <h2 class="subtitle">
                            Call 8848838212 
                            Be healthy, be safe.
                        </h2>
                    </div>
                </div>
            </div>
            <div class="carousel-item" id="ci-3">

                <div class="container">
                    <div class="carousel-caption d-md-block">
                        <h1 class="title">
                            Here we are
                        </h1>
                        <h2 class="subtitle">
                            We're here when you need us. For everyday care or life-changing care, you can count on us to keep you and your loved ones safe and healthy
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="position: relative;">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1">1</button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2">2</button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3">3</button>
            </div>
        </div>
    </div>
</section>


<section class="hero-bottom">
    <div class="container">
        <ul class="home_box_container clearfix">
            <li class="home_box light_blue animated_element animation-fadeIn duration-500">
                <h2>
                    <a href="?page=contact" title="Emergency Case">
            Emergency Case
        </a>
                </h2>
                <div class="news clearfix">
                    <p class="text">
                        If you need a doctor urgently outside of lifecare opening hours, call emergency appointment number for emergency service.
                    </p>
                </div>
            </li>
            <li class="home_box blue animated_element animation-slideRight duration-800 delay-250">
                <div class="news clearfix">
                    <p class="text">
                        GENERAL MEDICINE | GYNECOLOGY
                    </p>
                    <p class="text">
                        DERMATOLOGY | PEDIATRICS | ENT
                    </p>
                    <h2>For booking :</h2> <a href="tel:8848838212" class="booking">8848838212</a>
                </div>
            </li>
            <li class="home_box dark_blue animated_element animation-slideRight200 duration-800 delay-500">
                <h2>
                    Opening Hours
                </h2>
                <ul class="items_list thin dark_blue opening_hours">
                    <li class="clearfix">
                        <span>
                Monday - Friday
            </span>
                        <div class="value">
                            8.00AM - 7.00PM
                        </div>
                    </li>
                    <li class="clearfix">
                        <span>
                Saturday
            </span>
                        <div class="value">
                            9.30AM - 3.00PM
                        </div>
                    </li>
                    <li class="clearfix">
                        <span>
                Sunday
            </span>
                        <div class="value">
                            9.30AM - 2.00PM
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</section>

<section class="featured-section">
    <div class="pattern-layer"></div>
    <div class="container">
        <div class="row">

            <div class="featured-block col-lg-4 col-md-6 col-sm-12">
                <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="image-layer"></div>
                    <div class="icon-box">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/assistance.png" alt="">
                    </div>
                    <h3><a href="#">Specialised <br> Support</a></h3>
                    <p>The hospital plays a statewide role in rehabilitation services, which includes the Acquired</p>
                </div>
            </div>

            <div class="featured-block col-lg-4 col-md-6 col-sm-12">
                <div class="inner-box wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1500ms">
                    <div class="image-layer"></div>
                    <div class="icon-box">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/medical-records.png" alt="">
                    </div>
                    <h3><a href="#">Diagnosis & <br> Investigation</a></h3>
                    <p>Hospital doctors examine patients so that they can diagnose and treat health conditions</p>
                </div>
            </div>

            <div class="featured-block col-lg-4 col-md-6 col-sm-12">
                <div class="inner-box wow fadeInLeft" data-wow-delay="600ms" data-wow-duration="1500ms">
                    <div class="image-layer"></div>
                    <div class="icon-box">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/first-aid-kit.png" alt="">
                    </div>
                    <h3><a href="#">Medical & <br> Surgical</a></h3>
                    <p>Medicine is a very wide field with many possible specialisms. Some doctors work in general</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
//For getting doctors
$doctors = get_doctors();
?>
<!-- team area start -->
<section class="team-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-3">
                <div class="section-title text-center">
                    <h6 class="sub-title left-line">Professional Team</h6>
                    <h2 class="title">Our Professional Doctor Working For Your Health</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center doctors">
            <?php foreach($doctors as $doctor)
            {
                $image = empty($doctor->image) ? 'avatar.jpg' : $doctor->image;
                $days = get_doctor_visit_days($doctor->id);
            ?>
            <div class="col-lg-3 col-md-6">
                <div class="single-team-inner style-two text-center">
                    <div class="thumb">
                        <img src="<?=get_template_directory_uri()?>/assets/doctors_photo/<?=$image?>" alt="team">
                    </div>
                    <div class="details">
                        <h5><a href="#"><?=$doctor->first_name." ".$doctor->last_name;?></a></h5>
                        <span><b><?=$doctor->designation?></b></span>
                        <p><?=$days?></p>
                        <ul class="social-media mt-3">
                            <li>
                                <a class="btn-base-m" href="#" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a class="btn-base-m" href="#" target="_blank">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a class="btn-base-m" href="#" target="_blank">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- team area end -->

<?php
    //Getting images from databse
	$results = get_gallery_images();
?>
<section class="gallery-section">
    <div class="image-layer" style="background-image:url(<?=get_template_directory_uri()?>/assets/img/gallery-bg.jpg)"></div>
    <div class="container">
        <div class="title-box">
            <h2>Gallery</h2>
        </div>
        <div class="row justify-content-center">

            <div class="project-block col-lg-3 col-md-6 col-sm-12">
                <div class="inner-box">
                    <div class="image">
                        <a class="plus" href="<?=get_template_directory_uri()?>/assets/gallery/<?=$results[0]->image_name?>" data-fancybox="gallery-1" data-caption=""
                        style="background-image: url('<?=get_template_directory_uri()?>/assets/gallery/<?=$results[0]->image_name?>'); "
                        >
                        </a>
                    </div>
                </div>
            </div>
            <div class="project-block col-lg-3 col-md-6 col-sm-12">
                <div class="inner-box">
                    <div class="image">
                        <a class="plus" href="<?=get_template_directory_uri()?>/assets/gallery/<?=$results[1]->image_name?>" data-fancybox="gallery-1" data-caption=""
                        style="background-image: url('<?=get_template_directory_uri()?>/assets/gallery/<?=$results[1]->image_name?>'); "
                        >
                        </a>
                    </div>
                </div>
            </div>
            <div class="project-block col-lg-3 col-md-6 col-sm-12">
                <div class="inner-box">
                    <div class="image">
                        <a class="plus" href="<?=get_template_directory_uri()?>/assets/gallery/<?=$results[2]->image_name?>" data-fancybox="gallery-1" data-caption=""
                        style="background-image: url('<?=get_template_directory_uri()?>/assets/gallery/<?=$results[2]->image_name?>'); "
                        >
                        </a>
                    </div>
                </div>
            </div>
            <div class="project-block col-lg-3 col-md-6 col-sm-12">
                <div class="inner-box">
                    <div class="image">
                        <a class="plus" href="<?=get_template_directory_uri()?>/assets/gallery/<?=$results[3]->image_name?>" data-fancybox="gallery-1" data-caption=""
                        style="background-image: url('<?=get_template_directory_uri()?>/assets/gallery/<?=$results[3]->image_name?>'); "
                        >
                        </a>
                    </div>
                </div>
            </div>
            <div class="project-block col-lg-3 col-md-6 col-sm-12">
                <div class="inner-box">
                    <div class="image">
                        <a class="plus" href="<?=get_template_directory_uri()?>/assets/gallery/<?=$results[4]->image_name?>" data-fancybox="gallery-1" data-caption=""
                        style="background-image: url('<?=get_template_directory_uri()?>/assets/gallery/<?=$results[4]->image_name?>'); "
                        >
                        </a>
                    </div>
                </div>
            </div>
            <div class="project-block col-lg-3 col-md-6 col-sm-12">
                <div class="inner-box">
                    <div class="image">
                        <a class="plus" href="<?=get_template_directory_uri()?>/assets/gallery/<?=$results[5]->image_name?>" data-fancybox="gallery-1" data-caption=""
                        style="background-image: url('<?=get_template_directory_uri()?>/assets/gallery/<?=$results[5]->image_name?>'); "
                        >
                        </a>
                    </div>
                </div>
            </div>
            <div class="project-block col-lg-3 col-md-6 col-sm-12">
                <div class="inner-box">
                    <div class="image">
                        <a class="plus" href="<?=get_template_directory_uri()?>/assets/gallery/<?=$results[6]->image_name?>" data-fancybox="gallery-1" data-caption=""
                        style="background-image: url('<?=get_template_directory_uri()?>/assets/gallery/<?=$results[6]->image_name?>'); "
                        >
                        </a>
                    </div>
                </div>
            </div>
            <div class="project-block col-lg-3 col-md-6 col-sm-12">
                <div class="inner-box">
                    <div class="image">
                        <a class="plus" href="<?=get_template_directory_uri()?>/assets/gallery/<?=$results[7]->image_name?>" data-fancybox="gallery-1" data-caption=""
                        style="background-image: url('<?=get_template_directory_uri()?>/assets/gallery/<?=$results[7]->image_name?>'); "
                        >
                        </a>
                    </div>
                </div>
            </div>

            
        </div>

        <div class="button-box text-center">
            <a href="gallery" class="btn-more">View All <span class="arrow icon-chevron-right"></span></a>
        </div>
    </div>
</section>

<?php
    //Getting events
    $events = get_all_events();

    if (!empty($events)) {
        $start_date1 = tribe_get_start_date($events[0]->ID,true, 'j');                
        $start_month1 = tribe_get_start_date($events[0]->ID,true, 'M');
        $start_datetime1 = tribe_get_start_date($events[0]->ID,true,'h A');
        $start_time1 = ltrim($start_datetime1,'0');
        $end_date1 = tribe_get_end_date($events[0]->ID,true, 'j');                
        $end_month1 = tribe_get_end_date($events[0]->ID,true, 'M');
        $end_datetime1 = tribe_get_end_date($events[0]->ID,true,'h A');
        $end_time1 = ltrim($end_datetime1,'0');
        $venue1 = tribe_get_venue($events[0]->ID);
        $image1 = !empty(tribe_event_featured_image($events[0]->ID, 'large', false, false )) ? tribe_event_featured_image($events[0]->id, 'large', false, false ) : get_template_directory_uri().'/assets/img/event.jpg';
    ?>
<section class="events-section">
    <div class="pattern-layer-two" style="background-image:url(<?=get_template_directory_uri()?>/assets/img/pattern-5.png)"></div>
    <div class="container">

        <div class="title-box">
            <div class="clearfix">
                <div class="pull-left">
                    <h2>Recent Events</h2>
                </div>
                <div class="pull-right">
                    <a href="allevents" class="view-events">View all Events <span class="arrow fa fa-angle-right"></span></a>
                </div>
            </div>
        </div>

        <div class="inner-container">
            <div class="pattern-layer-one" style="background-image:url(<?=get_template_directory_uri()?>/assets/img/pattern-4.png)"></div>
            <div class="row">
                
                <div class="column col-lg-6 col-md-12 col-sm-12">

                    <div class="event-block">
                        <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="upper-box clearfix">

                                <div class="event-date">
                                    <strong><?=$start_date1?></strong><?=$start_month1?>
                                </div>
                                <div class="image">
                                    <img src="<?=$image1?>" alt="" />
                                </div>
                                <ul class="event-list">
                                    <li><span class="fa fa-map-marker"></span><?=$venue1?></li>
                                    <li><span class="fa fa-clock-o"></span><?=$start_time1?> to <?=$end_time1?></li>
                                </ul>
                            </div>
                            <h3><a href="<?=$base_url?>/single_event?id=<?=$events[0]->ID?>"><?=$events[0]->post_title?></a></h3>
                            <a href="event-detail.html" class="btn-outline">join now</a>
                        </div>
                    </div>
                </div>
                <?php  array_splice($events, 0, 1);
                if(!empty($events))
                {?>
                <div class="column col-lg-6 col-md-12 col-sm-12">
                <?php
                   
                foreach ($events as $event) {
                    $start_date = tribe_get_start_date($event->ID, true, 'j');
                    $start_month = tribe_get_start_date($event->ID, true, 'M');
                    $start_datetime = tribe_get_start_date($event->ID, true, 'h A');
                    $start_time = ltrim($start_datetime, '0');
                    $end_date = tribe_get_end_date($event->ID, true, 'j');
                    $end_month = tribe_get_end_date($event->ID, true, 'M');
                    $end_datetime = tribe_get_end_date($event->ID, true, 'h A');
                    $end_time = ltrim($end_datetime, '0');
                    $venue = tribe_get_venue($event->ID); ?>
                    <div class="event-block-two">
                        <div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="content clearfix">

                                <div class="event-date">
                                    <strong><?=$start_date?></strong><?=$start_month?>
                                </div>
                                <ul class="event-list">
                                    <li><span class="fa fa-map-marker"></span><?=$venue?></li>
                                    <li><span class="fa fa-clock-o"></span><?=$start_time?> to <?=$end_time?></li>
                                </ul>
                                <h3><a href="<?=$base_url?>/single_event?id=<?=$event->ID?>"><?=$event->post_title?></a></h3>
                            </div>
                        </div>
                    </div>
                    <?php
                } ?>
                </div>
                <?php
                }?>
            </div>
        </div>
    </div>
</section>

<?php
}
get_footer(); ?>