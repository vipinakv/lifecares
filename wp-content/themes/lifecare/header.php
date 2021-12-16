<!DOCTYPE html>
<html>

<head>
    <title>LifeCare</title>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrapv5.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/fancybox.css" />
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/slick/slick-theme.css"/>
</head>

<body>
    <div class="site-container">
        <header>
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#"><img class="logo-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.jpg" alt=""></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
                  </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <div id="navbar-nav">
                                <!--<ul>
                                    <li class="current_page_item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li>
                                        <a href="#">About</a>
                                    </li>
                                    <li>
                                        <a href="#">Departments</a>
                                    </li>
                                    <li>
                                        <a href="#">Gallery</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>
                                </ul>-->
                                <?php wp_nav_menu( array( 'theme_location' => 'top-header' ) ); ?>
                            </div>



                        </div>
                    </div>
                </nav>
            </div>

        </header>

<!--<div class="js">
<div id="preloader"></div>
</div>
<script>
$(document).ready(function () {
   //$('#preloader').fadeOut('slow',function(){$(this).remove();});
});
</script>-->