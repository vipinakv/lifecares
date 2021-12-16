<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$category = get_the_category();
$base_url = get_bloginfo('wpurl');
get_header(); ?>
        <div class="container">
            <section class="blog-inner">
                <div class="row">
                    <div class="col-md-8">
                        <article>
                            <div class="card-body">
                                <div class="category d-flex align-items-baseline">
									<p class="authorp">By <a class="authora"><?php echo getAuthor(get_the_ID()); ?></a> | </p>
                                    <a style="padding-right:7px;" href="<?=$base_url?>/categories?cat=<?=$category[0]->slug?>"><?=$category[0]->name?></a>
                                    <a><?php the_time( 'F, j, Y ')?></a>
                            </div> 
                            <?php the_title( '<h2>', '</h2>' ); ?>
                            </div>

                            <?php echo get_the_content(); ?>
                        </article>                                      
                    </div>
                   <?php get_sidebar()?>
                </div>
            </section>
        </div>
<?php get_footer(); ?>