<footer class="footer-container clearfix">
    <div class="wrapper">
        <div class="inner-footer-container clearfix">
            <div class="footer-top-container clearfix">
                <div class="grid">
                    <div class="col-grid-4">
                        <div class="grid">
                            <div class="col-grid-4">
                                <div class="footer-block footer-block-account">
                                    <?php 
                                        if(is_active_sidebar('sidebar-4')){
                                            dynamic_sidebar('sidebar-4');
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-grid-4">
                                <div class="footer-block footer-help">
                                    <?php 
                                        if(is_active_sidebar('sidebar-5')){
                                            dynamic_sidebar('sidebar-5');
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-grid-4">
                                <div class="footer-block footer-company-info">
                                    <?php 
                                        if(is_active_sidebar('sidebar-6')){
                                            dynamic_sidebar('sidebar-6');
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-grid-8">
                        <div class="grid">
                            <div class="col-grid-4">
                                <div class="footer-block footer-fllow">
                                    <?php 
                                        if(is_active_sidebar('sidebar-7')){
                                            dynamic_sidebar('sidebar-7');
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-grid-3">
                                <div class="footer-block footer-accpect">
                                    <?php 
                                        if(is_active_sidebar('sidebar-8')){
                                            dynamic_sidebar('sidebar-8');
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-grid-5">
                                <div class="footer-block footer-newsletter">
                                    <h4 class="footer-title">Newsletter Signup</h4>
                                    <div class="newsletter-block">
                                        <p>Sign up to our newsletter and receive regular updates and articles directly to your inbox!  </p>
<!--                                        <form action="#">
                                            <input type="text" id="newsletter" placeholder="Your E-mail Address here">
                                            <input type="submit" class="btn btn-newsletter" value="Subscribe">
                                        </form>-->
                                        <?php echo do_shortcode('[xyz_em_subscription_html_code]');?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom-container clearfix">
                <div class="footer-navigation clearfix">
                    <?php
                        $footer_args = array(
                                'theme_location'  => 'footer',
                                'menu'            => '',
                                'container'       => 'div',
                                'container_class' => '',
                                'container_id'    => '',
                                'menu_class'      => 'menu',
                                'menu_id'         => '',
                                'echo'            => true,
                                'fallback_cb'     => 'wp_page_menu',
                                'before'          => '',
                                'after'           => '',
                                'link_before'     => '',
                                'link_after'      => '',
                                'items_wrap'      => '<ul>%3$s</ul>',
                                'depth'           => 0,
                                'walker'          => ''
                        );

                        wp_nav_menu( $footer_args );

                    ?>
                </div>
                <?php 
                    if(is_active_sidebar('sidebar-3')){
                        dynamic_sidebar('sidebar-3');
                    }
                ?>
            </div>
        </div>
    </div>
    </footer>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri();?>/js/vendor/jquery-1.11.0.js"><\/script>')</script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/flexslider/2.2.2/jquery.flexslider.js"></script>
    <script src="<?php echo get_template_directory_uri();?>/js/vendor/jquery.bxslider.js"></script>
    <script src="<?php echo get_template_directory_uri();?>/js/vendor/owl.carousel.js"></script>
    <script src="<?php echo get_template_directory_uri();?>/js/vendor/jquery.meanmenu.js"></script>    
    <script src="<?php echo get_template_directory_uri();?>/js/calculator.js"></script>    
    <script src="<?php echo get_template_directory_uri();?>/js/jquery.validate.min.js"></script>    
    <!--<script src="<?php //echo get_template_directory_uri();?>/js/jquery.spritezoom.js"></script>-->
<!--    <script src="<?php //echo get_template_directory_uri();?>/js/main.js"></script>-->
    <script type="text/javascript">
        $(document).ready(function() {
            loadTab('calcBasic');
            $('.add-to-wishlist').click(function(){
                setTimeout(function(){
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php');?>',
                        type: 'POST',
                        data: {action: 'get_wishlist_count'},
                        success: function(count){
                            $('#wishlist-count-show').empty().text(count);
                        }
                    });
                }, 1500);
            });
            $('.wishlist_table .remove').click(function(){
                setTimeout(function(){
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php');?>',
                        type: 'POST',
                        data: {action: 'get_wishlist_count'},
                        success: function(count){
                            $('#wishlist-count-show').empty().text(count);
                        }
                    });
                }, 1500);
            });
        });
    </script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
        (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='http://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
        ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>
    <?php wp_footer();?>
</body>
</html>