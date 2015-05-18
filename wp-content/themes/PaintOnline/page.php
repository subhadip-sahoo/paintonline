<?php get_header(); ?>
<section class="main-container clearfix">
    <section class="main wrapper clearfix">
        <section class="inner-main-container clearfix">
            <section class="inner-content clearfix">
            <?php if(have_posts()):?>
                <?php while(have_posts()): the_post();?>
                <header class="heading-title">
                    <h1><?php the_title();?></h1>
                </header>
                <div class="main-content clearfix">
                    <?php the_content();?>
                </div>
                <?php endwhile;?>
            <?php endif;?>
            </section>
        </section>
    </section> <!-- #main -->
</section> <!-- #main-container -->
<?php get_footer();?>