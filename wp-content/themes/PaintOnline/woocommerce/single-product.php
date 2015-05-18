<?php
session_start();
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>
<?php global $product, $post, $woocommerce;?>
<style>
.custom-combobox {
    position: relative;
    display: inline-block;
}
.custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -1px;
    padding: 0;
}
.custom-combobox-input {
    margin: 0;
    padding: 5px 10px;
}
</style>
<script type="text/javascript">
(function($) {
    $(function(){
         $.widget( "custom.combobox", {
        _create: function() {
        this.wrapper = $( "<span>" )
        .addClass( "custom-combobox" )
        .insertAfter( this.element );
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
        },
        _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
        value = selected.val() ? selected.text() : "";
        this.input = $( "<input>" )
        .appendTo( this.wrapper )
        .val( value )
        .attr( "title", "" )
        .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
        .autocomplete({
        delay: 0,
        minLength: 0,
        source: $.proxy( this, "_source" )
        })
        .tooltip({
        tooltipClass: "ui-state-highlight"
        });
        this._on( this.input, {
        autocompleteselect: function( event, ui ) {
        ui.item.option.selected = true;
        this._trigger( "select", event, {
        item: ui.item.option
        });
        },
        autocompletechange: "_removeIfInvalid"
        });
        },
        _createShowAllButton: function() {
        var input = this.input,
        wasOpen = false;
        $( "<a>" )
        .attr( "tabIndex", -1 )
        .attr( "title", "" )
        .tooltip()
        .appendTo( this.wrapper )
        .button({
        icons: {
        primary: "ui-icon-triangle-1-s"
        },
        text: false
        })
        .removeClass( "ui-corner-all" )
        .addClass( "custom-combobox-toggle ui-corner-right" )
        .mousedown(function() {
        wasOpen = input.autocomplete( "widget" ).is( ":visible" );
        })
        .click(function() {
        input.focus();
        // Close if already visible
        if ( wasOpen ) {
        return;
        }
        // Pass empty string as value to search for, displaying all results
        input.autocomplete( "search", "" );
        });
        },
        _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
        var text = $( this ).text();
        if ( this.value && ( !request.term || matcher.test(text) ) )
        return {
        label: text,
        value: text,
        option: this
        };
        }) );
        },
        _removeIfInvalid: function( event, ui ) {
        // Selected an item, nothing to do
        if ( ui.item ) {
        return;
        }
        // Search for a match (case-insensitive)
        var value = this.input.val(),
        valueLowerCase = value.toLowerCase(),
        valid = false;
        this.element.children( "option" ).each(function() {
        if ( $( this ).text().toLowerCase() === valueLowerCase ) {
        this.selected = valid = true;
        return false;
        }
        });
        // Found a match, nothing to do
        if ( valid ) {
        return;
        }
        // Remove invalid value
        this.input
        .val( "" )
        .attr( "title", value + " didn't match any item" )
        .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
        this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
            this.input.autocomplete( "instance" ).term = "";
        },
            _destroy: function() {
                this.wrapper.remove();
                this.element.show();
            }
        });
        
        $("#combobox").combobox({
            select: function(event, ui){
                $('p#msg').remove();             
                $('#selcted_color_cat').val(this.value);                
                var url = '<?php echo admin_url('admin-ajax.php')?>';
                var cat_id = $('#selcted_color_cat').val();                
                var data = {action: 'get_colors', cat_id: cat_id};
                if(cat_id == '0'){
                    $('div#specified_color').children().remove();
                    $('p#msg').remove();
                    var variation_id = $('input[type=hidden][name=variation_id]').val();
                    var data = {action: 'get_variation_price', variation_id: variation_id, no_color: '1'};
                    $('div.single_variation').text('Updating...');
                    setTimeout(function() {
                        $.getJSON(url, data, function(json){                
                            $('div.single_variation').text(json.price);                
                        });                    
                    }, 1000);
                }                
                $.getJSON(url, data, function(json){
                    $('#specified_color').html(json.color_html);
                });
            }
        });
        //$( document ).tooltip();
        $('ul#dynamic_color li').removeClass();
        $(document).delegate('ul#dynamic_color li a','click', function(){
            $('ul#dynamic_color li').removeClass();
            $(this).parent().addClass('selected');
            var color_name = $(this).attr('title');
            $('div.color_section').find('p#msg').remove();
            $('div.color_section').append('<p id="msg"><?php the_title();?> <strong>'+color_name+'</strong> selected</p>');
            var url = '<?php echo admin_url('admin-ajax.php')?>';
            var variation_id = $('input[type=hidden][name=variation_id]').val();
            var data = {action: 'get_variation_price', variation_id: variation_id, color_name: color_name, color_price: '0'};
            $('div.single_variation').text('Updating...');
            setTimeout(function() {
                $.getJSON(url, data, function(json){                
                    $('div.single_variation').text(json.price);                
                });                    
            }, 1000);            
        });
        $('.variations select').change(function(){
            $('ul#dynamic_color li').each(function(){
                if($(this).hasClass('selected')){
                    var color_name = $(this).children('a').attr('title');
                    //alert(color_name);
                    setTimeout(function() {
                        $('div.single_variation').text('Updating...');                   
                    }, 1000);
                    var data_product_variations = $('.variations_form').attr('data-product_variations');
                    var dataObj = $.parseJSON(data_product_variations);
                    var can_size = $('.variations select').val();
                    for(var i = 0; dataObj.length > i; i++){
                        var attributsObj = dataObj[i].attributes;
                        for(var attr_name in attributsObj){
                            if ( attributsObj.hasOwnProperty( attr_name ) ) {
                                var attr_val = attributsObj[ attr_name ];
                                if(attr_val == can_size){
                                    var variation_id = dataObj[i].variation_id;
                                }
                            }
                        }
                    }
                    var url = '<?php echo admin_url('admin-ajax.php')?>';
                    var data = {action: 'get_variation_price', variation_id: variation_id, color_name: color_name, color_price: '0'};
                    setTimeout(function() {
                        $.getJSON(url, data, function(json){                
                            $('div.single_variation').text(json.price);                
                        });                    
                    }, 1000);
                }
            });
        });
    });
})(jQuery);
</script>
<section class="main-container clearfix">
    <section class="main wrapper clearfix">
        
        <section class="inner-main-container clearfix">

            <section class="product-details-container clearfix">
                <section class="inner-product-container text-center clearfix">                     
                    <?php wc_print_notices(); ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                    <header class="heading-title page-title-block">
                        <?php
                                /**
                                 * woocommerce_before_main_content hook
                                 *
                                 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                                 * @hooked woocommerce_breadcrumb - 20
                                 */
                                do_action( 'woocommerce_before_main_content' );
                        ?>

                        <h1 class="page-title"><?php the_title();?></h1>
                    </header>

                    <div class="product-details-block text-left clearfix">
                        <div class="product-details-image">
                            <?php woocommerce_show_product_images();?>

                            <!-- data sheet -->
                    <?php  if(get_field('data_sheet')):  ?> 
                        <div class="data_sheet">
                          <!--<h4>MSDS/Data sheet</h4>-->
                              <?php 
                              while( has_sub_field('data_sheet') ): 
                                $infoType = get_sub_field('information_type');
                                $title = get_sub_field('title'); 
                                $fileUrl = get_sub_field('upload_document'); ?>

                              <?php if($infoType == 'msds'){ ?>
                              <ul>

                              <li><strong>Safety Data Sheets(SDS)</strong></li>

                               <li><a href="<?php echo $fileUrl; ?>" target="_blank"><?php echo $title; ?><img src="<?php bloginfo('template_url');?>/images/pdf-icon.png" width="15" height="15" alt="" class="pdf_icon" ></a></li>
                                </ul>
                               <?php } endwhile;  ?>
                            <?php 
                            while( has_sub_field('data_sheet') ): 
                             $infoType = get_sub_field('information_type');
                             $title = get_sub_field('title'); 
                             $fileUrl = get_sub_field('upload_document');
                            if ($infoType == 'data_sheets'){ ?>
                             <ul>
                                <li><strong>Product Data Sheets(PDS)</strong></li>
                                <li><a href="<?php echo $fileUrl; ?>" target="_blank"><?php echo $title; ?><img src="<?php bloginfo('template_url');?>/images/pdf-icon.png" width="15" height="15" alt="" class="pdf_icon" ></a></li>
                            </ul>
                          <?php } endwhile; ?>
                            <div class="clr"></div>
                        </div>
                         <?php endif; ?>
                        <!-- /data sheet -->
                        
                        </div>
                        
                        <div class="product-details-content">
                            <h3 class="product-details-title"><?php the_title();?></h3>

                            <div class="price">
                                <div class="single_variation_wrap">
                                        <?php 
                                            $_product   = wc_get_product( $post->ID, array( 'product_type' => 'variable' ) );
                                            $available_variations = array();
                                            foreach( $_product->get_children() as $child_id ) {
                                                    $child = $_product->get_child( $child_id );

                                                    if ( ! empty( $child->variation_id ) ) {
                                                            $available_variations[] = $child->get_variation_attributes();
                                                    }
                                            }
                                            if(count($available_variations) > 1):
                                        ?>
                                        <div class="single_variation">
                                            <?php if( $product->is_type( 'simple' ) ){?>
                                                    <?php echo strip_tags(woocommerce_price($product->regular_price));?>	
                                            <?php } elseif( $product->is_type( 'variable' ) ){ ?>
                                                <?php echo strip_tags(woocommerce_price($product->min_variation_price));?>	
                                            <?php } ?>
                                        </div>
                                        <?php else: ?>
                                        <div class="single_variation_bluf">
                                            <?php if( $product->is_type( 'simple' ) ){?>
                                                    <?php echo strip_tags(woocommerce_price($product->regular_price));?>	
                                            <?php } elseif( $product->is_type( 'variable' ) ){ ?>
                                                <?php echo strip_tags(woocommerce_price($product->min_variation_price));?>	
                                            <?php } ?>						
                                        </div>
                                        <?php endif;?>
                                </div>
                            </div>
                            <?php echo the_field('massage_for_zero_price_product'); ?>
<!--                            <div class="product-details-con">
                                <h4>PRODUCT DESCRIPTION:</h4>
                                <?php //echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
                            </div>-->
                            <div class="product-details-cart-area clearfix">
                                <?php
                                        /**
                                         * woocommerce_single_product_summary hook
                                         *
                                         * @hooked woocommerce_template_single_title - 5
                                         * @hooked woocommerce_template_single_rating - 10
                                         * @hooked woocommerce_template_single_price - 10
                                         * @hooked woocommerce_template_single_excerpt - 20
                                         * @hooked woocommerce_template_single_add_to_cart - 30
                                         * @hooked woocommerce_template_single_meta - 40
                                         * @hooked woocommerce_template_single_sharing - 50
                                         */
                                        do_action( 'woocommerce_single_product_summary' );
                                ?>
                            </div>
							
                            <!--<p class="or-tt">-Or-</p>-->
<!--                            <p class="payple-image">
                                <img src="<?php //echo get_template_directory_uri();?>/images/payple.jpg" alt="payple">
                            </p>-->
<!--                            <div class="product-details-social">
                                <a href="" class="add-to-wishlist">Add to Wishlist</a>
                                <a href="" class="add-to-email">Email to a Friend</a>
                            </div>-->
                            <?php TellAFriend(); ?>
                        </div>
                        <div class="clearfix clear"></div>
                        
                        <div class="clearfix clear"></div>
                        <div class="product-tab-related-area clearfix">
                            <?php
                                /**
                                 * woocommerce_after_single_product_summary hook
                                 *
                                 * @hooked woocommerce_output_product_data_tabs - 10
                                 * @hooked woocommerce_upsell_display - 15
                                 * @hooked woocommerce_output_related_products - 20
                                 */
                                do_action( 'woocommerce_after_single_product_summary' );
                            ?>
                        </div>
                    </div>
                    <?php endwhile;?>
                </section>
            </section>
        </section>
    </section> <!-- #main -->
</section> <!-- #main-container -->
<?php get_footer(); ?>