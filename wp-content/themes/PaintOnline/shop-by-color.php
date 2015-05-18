<?php
/* Template Name: Shop by color */
get_header(); global $wp_query; ?>
<script type="text/javascript">
    (function($){
        $(function(){
            $( "#tabs" ).tabs();
        });
    })(jQuery);
</script>
<section class="main-container clearfix">
    <section class="main wrapper clearfix">
        <section class="inner-main-container clearfix">
            <section class="inner-content clearfix">
                <header class="heading-title">
                    <h1><?php the_title();?></h1>
                </header>
                <div class="main-content shop-color-container clearfix">
                    <div id="tabs" class="tab-conatiner clearfix">
                        <ul>
                            <?php 
                                $wcatTerms = get_terms('color-categories', array('hide_empty' => 0, 'order' => 'ASC', 'orderby' => 'id',  'parent' =>0)); //, 'exclude' => '17,77'
                                foreach($wcatTerms as $wcatTerm) :
                                    if(get_total_color($wcatTerm->slug) == '0'){
                                        continue;
                                    }
                            ?>
                            <li><a href="#tabs-<?php echo $wcatTerm->slug; ?>"><?php echo $wcatTerm->name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php 
                            foreach($wcatTerms as $wcatTerm) :
                                if(get_total_color($wcatTerm->slug) == '0'){
                                    continue;
                                }
                        ?>
                        <div id="tabs-<?php echo $wcatTerm->slug; ?>" class="tab_details clearfix">
                            <?php
                                $wsubargs = array(
                                    'hierarchical' => 1,
                                    'show_option_none' => '',
                                    'hide_empty' => 0,
                                    'parent' => $wcatTerm->term_id,
                                    'order' => 'ASC',
                                    'orderby' => 'id',
                                    'taxonomy' => 'color-categories'
                                );
                                $wsubcats = get_categories($wsubargs);
                                foreach ($wsubcats as $wsc):
                                    if(get_total_color($wsc->slug) == '0'){
                                        continue;
                                    }
                            ?>
                            <div class="box">
                                <div class="view view-first">
                                    <?php query_posts(array('taxonomy' => 'color-categories', 'post_type' => 'colors', 'posts_per_page' => 1, 'color-categories' => $wsc->slug));?>
                                     <?php if ( have_posts() ) : ?>
                                    <a class="info" href="<?php echo get_term_link( $wsc->slug, $wsc->taxonomy );?>" id="various">
                                        <ul class="rangeShades">
                                            <?php while ( have_posts() ) : the_post(); $color_cnt = 0;?>
                                            <?php $all_colors = get_field('colors'); //echo '<pre>'; print_r($all_colors);?>
                                            <?php if(!empty($all_colors) && is_array($all_colors)):?>
                                            <?php foreach($all_colors as $color): $color_cnt++; if($color_cnt > 20){break;}?>
                                                <li style="background-color: <?php echo $color['color_picker'];?>"><span href="javascript:void(0);" class="color-swatch"></span></li>
                                            <?php endforeach;?>
                                            <?php endif;?>
                                            <?php endwhile; wp_reset_query(); ?>
                                        </ul>
                                    </a>
                                    <?php endif;?>
                                    <div class="mask"><a class="info" href="<?php echo get_term_link( $wsc->slug, $wsc->taxonomy );?>" id="various"><?php echo $wsc->name;?></a></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </section>
    </section> <!-- #main -->
</section> <!-- #main-container -->
<?php get_footer();?>