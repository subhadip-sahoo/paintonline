<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;
//echo '<pre>';
//print_r($product);
//echo get_post_meta($product->ID, 'short_decription', true);


// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>
<div class="product-block <?php post_class();?>">
    <div class="inn-product">
        <figure class="product-image">
            <a href="<?php the_permalink();?>">
                <?php do_action( 'woocommerce_before_shop_loop_item_title' );  ?>
            </a>
        </figure>
        <div class="product-description">
            <h4 class="product-title"><?php echo get_the_title(); ?></h4>
            <p class="product-text"><?php echo substr($product->post->post_excerpt, 0, 50); ?></p>
            <p class="product-price">
            <?php 
                if( $product->is_type( 'simple' ) ){
                    echo strip_tags(woocommerce_price($product->regular_price));
                } elseif( $product->is_type( 'variable' ) ){
                    echo strip_tags(woocommerce_price($product->min_variation_price));
                }
            ?>
            </p>
<!--            <div class="product-others">
                <span class="product-icon cart-icon sprite-icon"><a href="<?php //echo esc_url( $product->add_to_cart_url() );?>" rel="nofollow" data-product_id="<?php //echo esc_attr( $product->id );?>" data-product_sku="<?php //echo esc_attr( $product->get_sku() );?>">Add to Cart</a></span>
                <span class="product-icon view-icon sprite-icon"><a href="<?php //echo get_permalink( get_option('woocommerce_cart_page_id') ); ?>">View Cart</a></span>
                <span class="product-icon details-icon sprite-icon"><a href="<?php //the_permalink(); ?>">Details</a></span>
            </div>-->
        </div>
        <?php if ( $product->is_on_sale() ) : ?>
                <?php echo apply_filters( 'woocommerce_sale_flash', '<span class="product-sale">' . __( 'Sale', 'woocommerce' ) . '</span>', $post, $product ); ?>
        <?php endif; ?>
    </div>
</div>