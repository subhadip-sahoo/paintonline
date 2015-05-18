<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); 
    global $woocommerce, $wp_query;
//    echo '<pre>';
//    print_r($wp_query);
//    echo '</pre>';
    if($wp_query->queried_object->parent == 0){
        $cur_tax = $wp_query->queried_object->name;
    }else{
        $term = get_term( $wp_query->queried_object->parent, 'product_cat' );
        $cur_tax = $term->name;
    }
?>
<script type="text/javascript">
    (function($){
        $(function(){
            $( "#tabs" ).tabs();
            $('.category-lists ul ul').hide();
            $('ul.sidebar-product-category-lists li').each(function(){
                if($(this).children('a:first').text() == '<?php echo $cur_tax;?>'){
                    //e.preventDefault();
                    if($(this).hasClass('has-children')){
                        $(this).children('.cat-children').text('-');
                        $(this).children('.cat-children').prev('ul').slideDown(600, function(){});
                    }
                }  
            });
        });
    })(jQuery);
</script>
<section class="main-container clearfix">
    <section class="main wrapper clearfix">

        <section class="inner-main-container clearfix">

            <div class="product-sidebar-container">
                <div class="inn-product-sidebar clearfix">
                    <aside class="widget">
                        <header class="widget-title">
                            <h3>Price</h3>
                        </header>
                        <div class="widget-content">
                            <?php 
                                if(is_active_sidebar('sidebar-10')){
                                    dynamic_sidebar('sidebar-10');
                                }
                            ?>
                        </div>
                    </aside>
                    <aside class="widget">
                        <header class="widget-title">
                            <h3>CATEGORIES</h3>
                        </header>
                        <div class="widget-content category-lists">
                            <ul class="sidebar-product-category-lists">
                                <?php $wcatTerms = get_terms('product_cat', array('hide_empty' => 0, 'order' => 'ASC', 'orderby' => 'id',  'parent' =>0)); //, 'exclude' => '17,77'
				foreach($wcatTerms as $wcatTerm) : 
					$wthumbnail_id = get_woocommerce_term_meta( $wcatTerm->term_id, 'thumbnail_id', true );
					$wimage = wp_get_attachment_image_src( $wthumbnail_id, 'thumbnail');
				?>
                                <li class="sidebar-product-category-list"><a href="<?php echo get_term_link( $wcatTerm->slug, $wcatTerm->taxonomy ); ?>"><?php echo $wcatTerm->name; ?></a>
                                    <?php
                                        $wsubargs = array(
                                           'hierarchical' => 1,
                                           'show_option_none' => '',
                                           'hide_empty' => 0,
                                           'parent' => $wcatTerm->term_id,
                                           'taxonomy' => 'product_cat'
                                        );
                                        $wsubcats = get_categories($wsubargs);
                                        $count = 0;
                                        if(!empty($wsubcats)):
                                            foreach ($wsubcats as $wsc): $count++;?>
                                            <?php if($count == 1): ?>
                                            <ul>
                                            <?php endif; ?> 
                                                <li><a href="<?php echo get_term_link( $wsc->slug, $wsc->taxonomy );?>"><?php echo $wsc->name;?></a></li>
                                           <?php if($count == (count($wsubcats))): ?>
                                            </ul>
                                            <?php endif; ?>
                                        <?php endforeach; ?> 
                                    <?php endif; ?> 
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </aside>
                    <aside class="widget">
                        <header class="widget-title">
                            <h3>RECENTLY VIEWED PRODUCTS</h3>
                        </header>
                        <div class="widget-content">
                            <div class="sidebar-recent-product-block clearfix">
                                <?php echo rc_woocommerce_recently_viewed_products();?>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>

            <section class="product-container clearfix">
                <section class="inner-product-container text-center clearfix">
                    <header class="heading-title page-title-block">
                        <!--<div class="breadcrumb"><a href="">HOME</a> <span class="active">paint</span></div>-->
                        <?php
                                /**
                                 * woocommerce_before_main_content hook
                                 *
                                 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                                 * @hooked woocommerce_breadcrumb - 20
                                 */
                                do_action( 'woocommerce_before_main_content' );
                        ?>
<!--                        <h1 class="page-title">PAINT</h1>-->
                        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
                        <?php endif; ?>
                    </header> 
                    <div id="tabs" class="tab-conatiner clearfix">
                        <ul>
                            <li><a href="#tabs-all">All</a></li>
                            <?php 
                                $wsubsubargs = array(
                                    'hierarchical' => 1,
                                    'show_option_none' => '',
                                    'hide_empty' => 0,
                                    'order' => 'ASC',
                                    'orderby' => 'id',
                                    'parent' => $wp_query->queried_object->term_id,
                                    'taxonomy' => 'product_cat'
                                 );
                                $wsubsubcats = get_categories($wsubsubargs);
                                if(!empty($wsubsubcats)):
                                    foreach ($wsubsubcats as $wcat):
                            ?>
                                    <li><a href="#tabs-<?php echo $wcat->slug; ?>"><?php echo $wcat->name; ?></a></li>
                            <?php 
                                    endforeach;
                                endif;
                            ?>
                        </ul>
                        <div id="tabs-all" class="tab_details clearfix">
                            <?php if ( have_posts() ) : ?>
                                <div class="product-navigation clearfix">
                                    <!--<span class="total-product-display">Items 1 to 30 of 40 total</span>-->
                                    <?php woocommerce_result_count(); ?>
                                    <?php custom_numeric_posts_nav();?>
                                    <?php woocommerce_catalog_ordering();?>
                                </div>
                                <?php //wc_print_notices();?>
                                <?php woocommerce_product_loop_start(); ?>
                                    <?php while ( have_posts() ) : the_post(); ?>

                                            <?php wc_get_template_part( 'content', 'product' ); ?>

                                    <?php endwhile; wp_reset_query(); // end of the loop. ?>

                                <?php woocommerce_product_loop_end(); ?>
                                <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

                                    <?php wc_get_template( 'loop/no-products-found.php' ); ?>

                            <?php endif; ?>
                        </div>
                        <?php 
                            $wsubsubargs = array(
                                'hierarchical' => 1,
                                'show_option_none' => '',
                                'hide_empty' => 0,
                                'order' => 'ASC',
                                'orderby' => 'id',
                                'parent' => $wp_query->queried_object->term_id,
                                'taxonomy' => 'product_cat'
                             );
                            $wsubsubcats = get_categories($wsubsubargs);
                            if(!empty($wsubsubcats)):
                                foreach ($wsubsubcats as $wcat):
                                    $subcatargs = array(
                                            'taxonomy' => 'product_cat', 
                                            'posts_per_page' => -1, 
                                            'product_cat' => $wcat->slug, 
                                            'post_type' => 'product'
                                    );
                                    $wc = new WC_Query();
                                    
                                    if(isset($_REQUEST['min_price']) && isset($_REQUEST['max_price'])){
                                        $filtered_products = $wc->price_filter(array());
                                        if(!empty($filtered_products)){
                                            $subcatargs['post__in'] = $filtered_products;
                                        }
                                    }
                                    
                                    $args = (isset($_REQUEST['orderby']))? $wc->get_catalog_ordering_args(): 'date';
                                    if(is_array($args)){
                                        foreach ($args as $key => $value) {
                                            $subcatargs[$key] = $value;
                                        }
                                    }
//                                    echo '<pre>';
//                                    print_r($subcatargs);
//                                    echo '</pre>';
                                    query_posts($subcatargs);
                        ?>
                            <div id="tabs-<?php echo $wcat->slug;?>" class="tab_details clearfix">
                                <?php if ( have_posts() ) : ?>
                                <div class="product-navigation clearfix">
                                    <!--<span class="total-product-display">Items 1 to 30 of 40 total</span>-->
                                    <?php woocommerce_result_count(); ?>
                                    <?php //custom_numeric_posts_nav();?>
                                    <?php woocommerce_catalog_ordering();?>
                                </div>
                                <?php //wc_print_notices();?>
                                <?php woocommerce_product_loop_start(); ?>
                                    <?php while ( have_posts() ) : the_post(); ?>
                                            
                                            <?php wc_get_template_part( 'content', 'product' ); ?>

                                    <?php endwhile; wp_reset_query(); ?>

                                <?php woocommerce_product_loop_end(); ?>
                                <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

                                    <?php wc_get_template( 'loop/no-products-found.php' ); ?>

                            <?php endif; ?>
                        </div>
                    <?php 
                            endforeach;
                        endif;
                    ?>
                </div>
                </section>
            </section>
        </section>
    </section> <!-- #main -->
</section> <!-- #main-container -->
<?php get_footer(); ?>