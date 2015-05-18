<?php
/* Template Name: Home */
get_header();
?>
<section class="banner-container clearfix">
    <?php //$image = wp_get_attachment_image_src(get_field('home_page_banner_image', 'option'), 'large');?>
    <div class="full-banner-container clearfix">
        <div class="wrapper-full">
            <div class="banner-slider text-center">
               <ul class="slides">
                   <?php
                      query_posts( array( 'post_type' => 'sliders' ) );
                      if ( have_posts() ) : while ( have_posts() ) : the_post();
                    ?>
                        <li>
                            <?php the_post_thumbnail('full');?>
                        </li>
                    <?php endwhile; endif; wp_reset_query(); ?>
                </ul>
            </div>
        </div>
        <div class="banner-text-container clearfix">
            <div class="wrapper">
                <div class="banner-slider">
                   <div class="slider-image">
                        <!-- <img src="<?php //bloginfo('template_directory'); ?>/images/slider01.png" alt="Banner" width="530" height="449" /> -->
                    </div>
                    <div class="slider-caption">
                    <div class="slider-caption-inner">
                                    <h2>Paint Online</h2><br>
                                     <p>Free Delivery - VIC, NSW, QLD</p><br>
                                    <p>Delivery charges applicable - SA, WA, NT and TAS</p> 
                                </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- END BANNER -->
    <section class="main-container clearfix">
    <section class="main wrapper clearfix">

        <section class="inner-main-container clearfix">

            <section class="home-category-block-container clearfix">
                <div class="grid">
                    <div class="col-grid-4">
                        <article class="category-block-container">
                            <figure class="category-block-image">
                                <?php $img = vt_resize(get_field('box_1_image', 'option'), '', 354, 204);?>
                                <img src="<?php echo $img['url'];?>" alt="">
                            </figure>
                            <div class="category-block-caption">
                                <div class="inner-category-block-caption">
                                    <h4 class="category-block-title"><?php echo get_field('box_1_title', 'option');?></h4>
                                    <p class="category-block"><?php echo get_field('box_1_text', 'option');?></p>
                                </div>
                                <a href="<?php echo site_url(); ?>/paint-calculator" class="btn btn-click-here">Click here</a>
                            </div>
                        </article>
                    </div>
                    <div class="col-grid-4">
                        <article class="category-block-container">
                            <figure class="category-block-image">
                                <?php $img = vt_resize(get_field('box_2_image', 'option'), '', 354, 204);?>
                                <img src="<?php echo $img['url'];?>" alt="">
                            </figure>
                            <div class="category-block-caption">
                                <div class="inner-category-block-caption">
                                    <h4 class="category-block-title"><?php echo get_field('box_2_title', 'option');?></h4>
                                    <p class="category-block"><?php echo get_field('box_2_text', 'option');?></p>
                                </div>
                                <a href="<?php echo site_url(); ?>/news-tips-advice" class="btn btn-click-here">Click here</a>
                            </div>
                        </article>
                    </div>
                    <div class="col-grid-4">
                        <article class="category-block-container">
                            <figure class="category-block-image">
                                <?php $img = vt_resize(get_field('box_3_image', 'option'), '', 354, 204);?>
                                <img src="<?php echo $img['url'];?>" alt="">
                            </figure>
                            <div class="category-block-caption">
                                <div class="inner-category-block-caption">
                                    <h4 class="category-block-title"><?php echo get_field('box_3_title', 'option');?></h4>
                                    <p class="category-block"><?php echo get_field('box_3_text', 'option');?></p>
                                </div>
                                <a href="<?php echo site_url(); ?>/shop-by-color" class="btn btn-click-here">Click here</a>
                            </div>
                        </article>
                    </div>
                </div>
            </section>
            
            <section class="feature-product-container clearfix">
                <header class="heading-title">
                    <h1>Featured products</h1>
                </header>
                <section class="inner-feature-product-container text-center clearfix">
                    <?php echo paintOnline_feature_products();?>
                </section>
            </section>
        </section>
    </section> <!-- #main -->
</section> <!-- #main-container -->
<?php get_footer();?>