<?php get_header(); global $wp_query; ?>
<?php
    if($wp_query->queried_object->parent == 0){
        $cur_tax = $wp_query->queried_object->name;
    }else{
        $term = get_term( $wp_query->queried_object->parent, 'color-categories' );
        $cur_tax = $term->name;
    }
?>
<script type="text/javascript">
    (function($){
        $(function(){
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
                            <h3>COLOR CATEGORIES</h3>
                        </header>
                        <div class="widget-content category-lists">
                            <ul class="sidebar-product-category-lists">
                                <?php $wcatTerms = get_terms('color-categories', array('hide_empty' => 0, 'order' => 'ASC', 'orderby' => 'id',  'parent' =>0)); //, 'exclude' => '17,77'
				foreach($wcatTerms as $wcatTerm) : 
					$wthumbnail_id = get_woocommerce_term_meta( $wcatTerm->term_id, 'thumbnail_id', true );
					$wimage = wp_get_attachment_image_src( $wthumbnail_id, 'thumbnail');
				?>
                                <li class="sidebar-product-category-list"><a href="<?php echo 'javascript:void(0)';//get_term_link( $wcatTerm->slug, $wcatTerm->taxonomy ); ?>" class="main-cat"><?php echo $wcatTerm->name; ?></a>
                                    <?php
                                        $wsubargs = array(
                                           'hierarchical' => 1,
                                           'show_option_none' => '',
                                           'hide_empty' => 0,
                                           'parent' => $wcatTerm->term_id,
                                           'taxonomy' => 'color-categories'
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
                                <?php endforeach; wp_reset_query();?>
                            </ul>
                        </div>
                    </aside>
                    <!--<aside class="widget">
                        <div class="widget-content">
                            <img src="<?php //echo get_template_directory_uri();?>/images/sidebar-add.jpg" alt="Add">
                        </div>
                    </aside>-->
                </div>
            </div>

            <section class="product-container clearfix">
                <section class="inner-product-container text-center clearfix">

                    <header class="heading-title page-title-block">
                        <div class="breadcrumb"><a href="<?php echo home_url();?>">HOME</a> <span class="active"><?php woocommerce_page_title(); ?></span></div>
                        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
                        <?php endif; ?>
                        <a href="javascript:window.history.back();" class="btn back-btn">Back</a>
                    </header>
                    <?php query_posts(array('taxonomy' => 'color-categories', 'post_type' => 'colors', 'posts_per_page' => -1, 'color-categories' => $wp_query->queried_object->slug));?>
                    <?php if ( have_posts() ) : ?>
<!--                    <div class="product-navigation clearfix">
                        <span class="total-product-display">Items 1 to 30 of 40 total</span>
                        <div class="product-nav" id="jq-pagination"></div>
                        <?php //result_count();?>
                        <?php //custom_numeric_posts_nav(); ?>
                        
                    </div>-->

                    <div class="color-listing clearfix">
                        <?php while ( have_posts() ) : the_post();?>
                        <?php $all_colors = get_field('colors'); //echo '<pre>'; print_r($all_colors);?>
                        <?php if(!empty($all_colors) && is_array($all_colors)):?>
                        <?php foreach($all_colors as $color):?>
                        <div class="color-block"> 
                            <div class="inn-color">
                                <figure class="color-image">
                                    <span class="color-box" style="background-color:<?php echo $color['color_picker'];?>"></span>
                                </figure>
                                <div class="color-description">
                                    <h4 class="color-title"><?php echo $color['color_name'];?></h4>
                                </div>
                            </div> 
                        </div>
                        <?php endforeach;?>
                        <?php endif;?>
                        <?php endwhile; wp_reset_query(); ?>
                        <?php else:?>
                        <p class="woocommerce-info">No color found!</p>
                    </div>
                    <?php endif; ?>
                </section>
            </section>
        </section>
    </section> <!-- #main -->
</section> <!-- #main-container -->
<?php get_footer();?>