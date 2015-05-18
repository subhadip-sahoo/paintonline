<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

if ( ! $product->is_purchasable() ) return;
?>

<?php
	// Availability
	$availability      = $product->get_availability();
	$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';
	
	echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" method="post" enctype='multipart/form-data'>
                <?php 
                    $color_list = autocomplete_color_lists();
                    if($color_list[0]['id'] != '0'):
                ?>
            <div class="color_section">
                    <label>SELECT COLOR</label>
                    <select id="combobox">
                        <option value="">Select one...</option>
                    <?php 
                        $color_list = autocomplete_color_lists();
                        foreach ($color_list as $color) {
                            echo '<option value="'.$color['id'].'">'.$color['label'].'</option>';
                        }
                    ?>
                    </select>
                    <input type="hidden" id="selcted_color_cat" />
                    <div id="specified_color"></div>
                </div>
            <?php endif;?>
	 	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
			<div class="variations_button">
				<div class="quntity-area"> <label for="qty">Qty</label> 
			
				 	<?php
				 		if ( ! $product->is_sold_individually() )
				 			woocommerce_quantity_input( array(
				 				'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
				 				'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
				 			) );
				 	?>
				</div>
	 			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />
		
	 			<button type="submit" class="single_add_to_cart_button button alt"><?php echo $product->single_add_to_cart_text(); ?></button>
			</div>
                        
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>