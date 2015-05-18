$(document).ready(function() {

	var active_calculator = "basic";

	$('body').addClass('calc').addClass('basic');
	$(".calcBlock").hide();
	

	$(".tabs ul li a").click(function() {
		var calc = $(this).attr('data-calc');
		$(".calcBlock").hide();
		$('#' + calc).show();
		$(".tabs ul li").removeClass('active');
		$(this).parent().addClass('active');

		if(active_calculator == "basic") {
			active_calculator = "comp";
		}
		else {
			active_calculator = "basic";
		}

		console.log(active_calculator);

		return false;
	});

	$(".print_page").click(function() {
		window.print();
		return false;
	});

	// Comprehensive Calculator

	$(".surfaceToggle").click(function() {

		if($(this).hasClass('active')) {
			$(this).removeClass('active');
		}
		else {
			$(this).addClass('active');
		}

		$(this).parent().find('ul').slideToggle();
		return false;
	});

	$(".addSurface").click(function() {
		var surface = $(".paintDesign_sec").first().clone();

		var name = $(this).attr('data-surface');
		var type = $(this).attr('data-type');
		var coverage = $(this).attr('data-coverage');
		var prevpainted = $(this).attr('data-previously-painted');
		var coats = $(this).attr('data-coats');
		var image = $(this).attr('data-image');
		var product = $(this).attr('data-product');
		var measurement = $(this).attr('data-measurement');
		
		//measurement = (measurement == "") ? "Height" : measurement;
		surface.find('.surfaceName').html(type + " " + name);
		surface.find('.surfaceCoats').val(coats);
		surface.find('.surfaceCoverage').val(coverage);
		surface.find('.prevPainted').val(prevpainted);
		surface.find('.surfaceImage').attr('src', image);
		surface.find('.productName').html(product);
		//surface.find('.measurement').html(measurement);
		if(measurement !="Height"){
			//alert(measurement);
			surface.find('.measurement').parent('div').remove();
		}

		$(".paintDesign_sec").last().after(surface.clone().show());

		return false;
	});

	$(document).on('click', '.surfaceRemove', function() {
		var surface = $(this).parents('.paintDesign_sec');
		surface.animate({
			height: 0,
			opacity: 0
		}, 200, function() { surface.remove() });

		return false;
	});

	$(document).on('keyup', 'input[name="text"]', function() {
		var results = calculateLitres($(this));
		results['litres'] = (isNaN(results['litres'])) ? 0 : results['litres'];
		$(this).parents('.paintDesign_sec').find('.surfaceLitreage h3').html(results['litres']);
		$(this).parents('.paintDesign_sec').find('.prevPainted h3').html(results['prevpaint']);
	});


	$("input[name='radio']").click(function() {
		var product = $(this).attr('data-product');
		var image = $(this).attr('data-image');
		
		$(".basicProduct").html(product);
		$(".basicImage").attr('src', image);
	});


	$(".result_btn").click(function() {
		var surface = $("input[name='radio']:checked");
		var coverage = parseInt(surface.attr('data-coverage'));

		console.log(coverage);
		var width = parseFloat($(".basicWidth").val());
		var height = parseFloat($(".basicHeight").val());
		var coats = parseInt($(".basicCoats").val());

		var area = width * height;
		
		var litres = Math.ceil( (area * coats) / coverage );		
		
		console.log(litres);
		
		litres = (isNaN(litres)) ? 0 : litres;

		$(".basicLitres").html(litres);

		return false;
	});
});

function loadTab(tab_id) {
	$("#" + tab_id).show();
	$(".tabs").find('li').removeClass("active");
	$("." + tab_id).addClass('active');
}

function calculateLitres(e) {
	var metrics = e.parents('.surfaceMetrics');

	var length = parseFloat(metrics.find('.surfaceLength').val());
	var width = parseFloat(metrics.find('.surfaceWidth').val());
	var height = parseFloat(metrics.find('.surfaceHeight').val());
	var coats = parseInt(metrics.find('.surfaceCoats').val());
	var prevp = parseInt(metrics.find('.prevPainted').val());
	var coverage = parseFloat(metrics.find('.surfaceCoverage').val());
	var results = {}; 
	
	if(!isNaN(height)){							
		var area = parseFloat(length) * parseFloat(width) * parseFloat(height);
	
	}
	else{
		var area = parseFloat(length) * parseFloat(width);
		
	}
		
	results['litres']  = Math.ceil( (area * coats)/coverage );
	//alert(results['litres']);
	results['prevpaint'] = Math.ceil( (area * coats) / prevp );
	
	return results;
}
