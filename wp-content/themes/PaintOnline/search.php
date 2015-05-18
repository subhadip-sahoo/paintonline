<?php get_header(); ?>
<section class="main-container clearfix">
    <section class="main wrapper clearfix">
        <section class="inner-main-container clearfix">
            <section class="inner-content clearfix">
                <header class="heading-title">
                    <h1><?php printf( __( 'Search Results for: %s', 'twentyfourteen' ), get_search_query() ); ?></h1>
                </header>
            <?php if(have_posts()):?>
                <section class="inner-feature-product-container text-center clearfix">
                    <?php woocommerce_product_loop_start(); ?>
                        <?php while ( have_posts() ) : the_post(); ?>

                                <?php wc_get_template_part( 'content', 'product' ); ?>

                        <?php endwhile; // end of the loop. ?>
                             
                    <?php woocommerce_product_loop_end(); ?>
                    <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>
                </section>
            <?php endif;?>
            </section>
        </section>
    </section> <!-- #main -->
</section> <!-- #main-container -->
<?php get_footer();?>