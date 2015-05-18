window.jQuery = window.$ = jQuery;
jQuery(document).ready(function () {

	jQuery('.banner-slider').flexslider({
	    animation: "slide",
	    controlNav: false
	});

	 jQuery('.bxslider').bxSlider();

	 jQuery('.product-thumbanil-slider').bxSlider({
	 	slideWidth: 100,
	    minSlides: 2,
	    maxSlides: 3,
	    slideMargin: 10,
	    randomStart: false,
	    useCSS:false,
	    auto:false,
	    moveSlides: 1,
	    pager:false,
	    infiniteLoop: false,
		hideControlOnEnd: true,
	 });
	 
    jQuery('header nav').meanmenu({
    	meanMenuContainer: '.nav-container',
    	meanScreenWidth: "767",
    });

    jQuery('.owl-carousel').owlCarousel({
	    loop:true,
	    margin:10,
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1,
	            nav:true,
	            loop:false
	        },
	        480:{
	            items:2,
	            nav:true,
	            loop:false
	        },
	        600:{
	            items:3,
	            nav:true,
	            loop:false
	        },
	        900:{
	            items:4,
	            nav:true,
	            loop:false
	        },
	        1000:{
	            items:5,
	            nav:true,
	            loop:false
	        }
	    }
	});

	// jQuery(".zoom-product").spritezoom({
	// 	layout : "inner"
	// });
	jQuery('.color-description').hide();

	jQuery('.color-block').mouseenter(function(){

		jQuery('.color-listing .color-block .inn-color .color-description').hide('slow');
		jQuery(this).children().children('.color-description').stop().show('slow');
		console.log(jQuery(this).children().children());
	})

	jQuery('.color-block').mouseleave(function(e){
		jQuery('.color-listing .color-block .inn-color .color-description').stop().hide('slow');
	});

	jQuery('.thumb-img').each(function(){
		var large_image = jQuery(this).attr('href');
		console.log(large_image); 

		jQuery('.product-thumbanil-slider .thumb-img').removeClass('active');
		jQuery('.product-details-image .product-thumbanil-slider li a').removeClass('active');
		
		jQuery(this).mouseenter(function(e){
			jQuery('.product-details-image .product-thumbanil-slider li a').removeClass('active');
			jQuery(this).addClass('active');
			//jQuery(this).removeAttr('data-rel');
			jQuery('.product-details-image .product-image img').attr('src',  large_image);
			jQuery('.product-details-image .product-image a').attr('href',  large_image);
			
			e.preventDefault();
		})

		jQuery(this).mouseleave(function(e){
			//jQuery(this).removeClass('active');
		});
	});

	jQuery('.shop_table').parent().addClass('table-responsive');

});



jQuery(document).ready(function () {
	
	//jQuery('.category-lists ul ul').hide();

	jQuery('.category-lists ul ul').each(function(){
		if(jQuery(this).children().length){
			jQuery(this, 'li:first-child').parent().append('<a class="cat-children" href="#">+</a>');
			jQuery(this, 'li:first-child').parent().addClass('has-children');
                        
		}
	});
	jQuery('.cat-children').on('click', function(e){
		e.preventDefault();
		if(jQuery(this).hasClass('show-lists')) {
			//console.log('show');
			jQuery(this).text('+');
			jQuery(this).prev('ul').slideUp(600, function(){});
		} else {
			//console.log('hide');
			jQuery(this).text('-');
			jQuery(this).prev('ul').slideDown(600, function(){});
		}
		jQuery(this).toggleClass("show-lists"); 
	});
        jQuery('.main-cat').on('click', function(e){
		e.preventDefault();
                var cat_children = jQuery(this).siblings('.cat-children');
		if(cat_children.hasClass('show-lists')) {
			//console.log('show');
			cat_children.text('+');
			cat_children.prev('ul').slideUp(600, function(){});
		} else {
			//console.log('hide');
			cat_children.text('-');
			cat_children.prev('ul').slideDown(600, function(){});
		}
		cat_children.toggleClass("show-lists"); 
	});






	var targetUl = jQuery('.category-lists-radio-check ul li ul');

	jQuery(targetUl).hide();

	jQuery(targetUl).each(function(){
		if(jQuery(this).children().length) {
			jQuery(this, 'li:first-child').parent().addClass('has-children-checkbox');
			jQuery(this).hide();
		}
		jQuery('.category-lists-radio-check li.has-children-checkbox ul').slideUp(600, function(){});
	});

	jQuery('.category-lists-radio-check li  label input[type=radio]').change(function(){

		jQuery('.category-lists-radio-check li.has-children-checkbox ul').slideUp(600, function(){});

		jQuery(".category-lists-radio-check li  label input[type=radio]:checked").each(function(){

			jQuery(this).parent().parent().children('ul').slideDown(600, function(){});
			//console.log('Show');
		});

	});
});