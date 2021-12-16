            <!-- footer area start -->
            <footer class="footer-area bg-overlay">
                <div class="container">

                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="widget widget_about pr-xl-4">
                                <div class="thumb footer-logo">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.jpg" alt="img">
                                </div>
                                <div class="details">
                                    <p>MediiCare to bring significant changes online based learning by doing resed cased learning by cosin extensive of arch for Driving course</p>
                                    <ul class="social-media">
                                        <li>
                                            <a class="btn-base-m" href="#">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="btn-base-m" href="#">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="btn-base-m" href="#">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="btn-base-m" href="#">
                                                <i class="fa fa-linkedin"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <div class="widget widget_nav_menu">
                                <h4 class="widget-title">Quick LInks</h4>
                                <?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <div class="widget widget_nav_menu">
                                <h4 class="widget-title">Services</h4>
                                <ul>
                                    <li><a href="services">General Medicine</a></li>
                                    <li><a href="services">Gynecology</a></li>
                                    <li><a href="services">Dermatology</a></li>
                                    <li><a href="services">Pediatrics</a></li>
                                    <li><a href="services">ENT</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="widget widget_contact pl-lg-3">
                                <h4 class="widget-title">Contact Us</h4>
                                <ul class="details">
                                    <li><i class="fa fa-phone"></i> 8848838212</li>
                                    <li><i class="fa fa-envelope"></i> info@MediiCare.com</li>
                                    <li><i class="fa fa-map-marker"></i> KWIC Business Centre, Dharmasala, Kannur</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 align-self-center">
                                <p>Copyright © 2021 MediiCare. All Right reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- footer area end -->
        </div>
    </div>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/fancybox.umd.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/slick/slick.min.js"></script>
<script>
    $('.doctors').slick({
    dots: true,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 1000,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [
        {
        breakpoint: 1024,
        settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
        }
        },
        {
        breakpoint: 600,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 2
        }
        },
        {
        breakpoint: 480,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1
        }
        }
    ]
    });
</script>
</body>

</html>