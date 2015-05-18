<?php global $wpo_wcpdf; ?>
<table class="head container">
	<tr>
		<td class="header">
		<?php
		if( $wpo_wcpdf->get_header_logo_id() ) {
			$wpo_wcpdf->header_logo();
		} else {
			echo apply_filters( 'wpo_wcpdf_invoice_title', __( 'Invoice', 'wpo_wcpdf' ) );
		}
		?>
		</td>
		<td class="shop-info">
			<div class="shop-name"><h3><?php $wpo_wcpdf->shop_name(); ?></h3></div>
			<div class="shop-address"><?php $wpo_wcpdf->shop_address(); ?></div>
		</td>
	</tr>
	<tr>
		<td>
			<h3 class="document-type-label">
			<?php if( $wpo_wcpdf->get_header_logo_id() ) echo apply_filters( 'wpo_wcpdf_invoice_title', __( 'Invoice', 'wpo_wcpdf' ) ); ?>
			</h3>
			<?php do_action( 'wpo_wcpdf_after_document_label', 'invoice' ); ?>
		</td>
		<td>&nbsp;</td>
	</tr>

	<tr>
		<td>
			<div class="order-information">
			<?php if ( isset($wpo_wcpdf->settings->template_settings['display_number']) && $wpo_wcpdf->settings->template_settings['display_number'] == 'invoice_number') { ?>
				<span class="order-number-label"><?php _e( 'Invoice Number:', 'wpo_wcpdf' ); ?></span>
				<span class="order-number"><?php $wpo_wcpdf->invoice_number(); ?></span><br />
			<?php } ?>
			<?php if ( isset($wpo_wcpdf->settings->template_settings['display_date']) && $wpo_wcpdf->settings->template_settings['display_date'] == 'invoice_date') { ?>
				<span class="order-date-label"><?php _e( 'Invoice Date:', 'wpo_wcpdf' ); ?></span>
				<span class="order-date"><?php $wpo_wcpdf->invoice_date(); ?></span><br />
			<?php } ?>
				<span class="order-number-label"><?php _e( 'Order Number:', 'wpo_wcpdf' ); ?></span>
				<span class="order-number"><?php $wpo_wcpdf->order_number(); ?></span><br />
				<span class="order-date-label"><?php _e( 'Order Date:', 'wpo_wcpdf' ); ?></span>
				<span class="order-date"><?php $wpo_wcpdf->order_date(); ?></span><br />
				<span class="order-payment-label"><?php _e( 'Payment Method:', 'wpo_wcpdf' ); ?></span>
				<span class="order-payment"><?php $wpo_wcpdf->payment_method(); ?></span><br />
			</div>
		</td>
		<td>
			<div class="recipient-address"><?php $wpo_wcpdf->billing_address(); ?></div>
		</td>
	</tr>
</table><!-- head container -->

<?php do_action( 'wpo_wcpdf_before_order_details', 'invoice' ); ?>

<table class="order-details">
	<thead>
		<tr>
			<th class="product-label"><?php _e('Product', 'wpo_wcpdf'); ?></th>
			<th class="quantity-label"><?php _e('Quantity', 'wpo_wcpdf'); ?></th>
			<th class="price-label"><?php _e('Price', 'wpo_wcpdf'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php $items = $wpo_wcpdf->get_order_items(); if( sizeof( $items ) > 0 ) : foreach( $items as $item ) : ?>
		<tr>
			<td class="description">
				<?php $description_label = __( 'Description', 'wpo_wcpdf' ); // registering alternate label translation ?>
				<span class="item-name"><?php echo $item['name']; ?></span><span class="item-meta"><?php echo $item['meta']; ?></span>
				<dl class="meta">
					<?php $description_label = __( 'SKU', 'wpo_wcpdf' ); // registering alternate label translation ?>
					<?php if( !empty( $item['sku'] ) ) : ?><dt><?php _e( 'SKU:', 'wpo_wcpdf' ); ?></dt><dd><?php echo $item['sku']; ?></dd><?php endif; ?>
					<?php if( !empty( $item['weight'] ) ) : ?><dt><?php _e( 'Weight:', 'wpo_wcpdf' ); ?></dt><dd><?php echo $item['weight']; ?><?php echo get_option('woocommerce_weight_unit'); ?></dd><?php endif; ?>
				</dl>
			</td>
			<td class="quantity"><?php echo $item['quantity']; ?></td>
			<td class="price"><?php echo $item['order_price']; ?></td>
		</tr>
		<?php endforeach; endif; ?>
	</tbody>
	<tfoot>
		<tr class="no-borders">
			<td class="no-borders" colspan="3">
				<table class="totals">
					<tfoot>
						<?php foreach( $wpo_wcpdf->get_woocommerce_totals() as $key => $total ) : ?>
						<tr class="<?php echo $key; ?>">
							<td class="no-borders">&nbsp;</td>
							<th class="description"><?php echo $total['label']; ?></th>
							<td class="price"><span class="totals-price"><?php echo $total['value']; ?></span></td>
						</tr>
						<?php endforeach; ?>
					</tfoot>
				</table>
			</td>

		</tr>
	</tfoot>
</table><!-- order-details -->

<?php do_action( 'wpo_wcpdf_after_order_details', 'invoice' ); ?>

<table class="notes container">
	<tr>
		<td colspan="3">
			<div class="notes-shipping">
				<?php if ( $wpo_wcpdf->get_shipping_notes() ) : ?>
					<h3><?php _e( 'Customer Notes', 'wpo_wcpdf' ); ?></h3>
					<?php $wpo_wcpdf->shipping_notes(); ?>
				<?php endif; ?>
			</div>
		</td>
	</tr>
</table><!-- notes container -->


<?php if ( $wpo_wcpdf->get_footer() ): ?>
<div id="footer">
	<?php $wpo_wcpdf->footer(); ?>
</div><!-- #letter-footer -->
<?php endif; ?>