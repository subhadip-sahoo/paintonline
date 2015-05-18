<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title><?php wp_title('|', 'right', TRUE);?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='shortcut icon' type='image/x-icon' href='<?php echo get_template_directory_uri();?>/favicon.ico' />
        <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic|Roboto:400,400italic,500,500italic,700,700italic,900,900italic,300italic,300,100italic,100|Oswald:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/normalize.min.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/flexslider.css" media="all" />
        <link href="<?php echo get_template_directory_uri();?>/css/jquery.bxslider.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/meanmenu.css" media="all" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/owl.carousel.css" media="all">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/main.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/main-color.css">
        
        
        <script src="<?php echo get_template_directory_uri();?>/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <?php wp_head();?> 
    </head>
    <body <?php body_class(); ?>>
        <?php global $woocommerce; ?>
        <header class="header-container clearfix">

            <section class="inner-header-container clearfix">
                <div class="wrapper">
                    <div class="main-logo-container clearfix">
                        <div class="main-logo pull-left">
                            <a href="<?php echo home_url();?>" class="logo-site">
                                <img src="<?php header_image();?>" alt="Logo">
                            </a>
                        </div>
                        <aside class="header-right-container clearfix">
                            <div class="login-menu-area text-right">
                                <ul>
                                    <?php if ( is_user_logged_in() ): ?>
                                    <li><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">MY ACCOUNT</a></li>
                                    <li><a href="<?php echo site_url();?>/wishlist">MY WISHLIST: <span class="cart-item"><span class="cart-item-count" id="wishlist-count-show"><?php echo yith_wcwl_count_products();?></span> ITEM (S)</span></a></li>
                                    <li class="logout"><a href="<?php echo wp_logout_url( home_url() ) ?>">Logout</a></li>
                                    <?php else:?>
                                    <li><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">LOG IN / Register</a></li>
                                    <li><a href="<?php echo site_url();?>/wishlist">MY WISHLIST: <span class="cart-item"><span class="cart-item-count" id="wishlist-count-show"><?php echo yith_wcwl_count_products();?></span> ITEM (S)</span></a></li>
                                    <?php endif;?>
                                </ul>
                            </div>
                            <div class="header-cart-search-area">
                            <h4 style="display: inline-block;padding:0px; text-align: center;float: left; color: #e11823; font-style: italic;"><?php echo get_bloginfo ( 'description' );  ?></h4>
                                <div class="my-cart-block">
                                    <strong class="my-cart-ti">MY CART:</strong>  <a href="<?php echo get_permalink( get_option('woocommerce_cart_page_id') ); ?>"><span class="cart-item"><span class="cart-item-count"><?php echo $woocommerce->cart->cart_contents_count;?></span> ITEM (S)</span></a>
                                </div>
                                <div class="header-search-form">
                                    <?php dynamic_sidebar('header-search'); ?>                                    
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </section>

            <div class="nav-container clearfix">
                <div class="wrapper">
                    <nav class="main-menu">
                        <?php
                            $main_menu_args = array(
                                    'theme_location'  => 'primary',
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
                            wp_nav_menu( $main_menu_args );
                        ?>
                    </nav>
                </div>
            </div>
        </header>
        <!-- END HEADER -->