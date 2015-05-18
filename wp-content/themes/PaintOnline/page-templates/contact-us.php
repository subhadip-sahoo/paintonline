<?php
/**
 * Template Name: Contact Us
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<style>
.contat-middle{ height: 345px; overflow: hidden;}

</style>
<SCRIPT LANGUAGE="JavaScript">
$(document).ready( function() {
$("#sydeneymaptitle").click(function(){ 
  $("#sydeneymap").css('display', 'block');
  $("#brismap").css('display', 'none');
}); 
  $("#brismaptitle").click(function(){    
  $("#brismap").css('display', 'block');
  $("#sydeneymap").css('display', 'none');  
});  

});
</SCRIPT>

<section class="main-container clearfix">
    <section class="main wrapper clearfix">
        <section class="inner-main-container clearfix">
            <header class="heading-title">
                <h1><?php the_title(); ?></h1>
            </header>
            <section class="inner-content clearfix">

<?php
  if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
    // Include the featured content template.
    get_template_part( 'featured-content' );
  }
?>

  <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
       <div class="about-row1">
      <div class="contact_us-wrap">
        <div class="grid">
          <div class="col-grid-2">
            <div class="contat-leftbar">
              <h5> <span><a href=" javascript:void(0);" id="sydeneymaptitle"> Sydney Office: </a></span> </h5>
                <p>111 Kurrajong Avenue,<br>
                Mount Druitt, NSW 2770 <br>
                Ph:  02 9832 0000<br>
                Fax: 02 9832 8888</p>
              <h5> <span> <a href=" javascript:void(0);" id="brismaptitle"> Brisbane Office:</a> </span> </h5>
                <p>444 Newman Road, <br>
                Geebung, QLD 4034<br> 
                Ph:   07 3265 7890<br>
                Fax : 07 3265 1890</p>
              <div class="">
               <!--  <div class="contact-icons-row"> <img src="<?php //bloginfo('template_url');?>/images/phone-icon.png" alt=""> 1300 372 468 </div>
                <div class="contact-icons-row"> <img src="<?php //bloginfo('template_url');?>/images/print-icon.png" alt=""> 02 9677 0566 </div> -->
                <div class="contact-icons-row"><a href="mailto:info@apcocoatings.com.au"> info@apcocoatings.com.au </a> </div>
              </div>
            </div>
          </div>
          <div class="col-grid-6">
            <div class="contat-middle">
              <h3> Location</h3>
              <div id="sydeneymap"><iframe  src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d26535.347334253755!2d150.801659!3d-33.76277399999988!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b129aed6bf00629%3A0x715248e8228190dd!2s111+Kurrajong+Ave!5e0!3m2!1sen!2sin!4v1404845133358" width="100%" height="298" frameborder="0" style="border:0"></iframe></div>
              <div id="brismap"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3543.369420259304!2d153.04849!3d-27.364176000000004!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b93e2923f96899f%3A0x9fadca7a48b251e9!2s444+Newman+Rd%2C+Geebung+QLD+4034%2C+Australia!5e0!3m2!1sen!2sin!4v1415760881161" width="100%" height="298" frameborder="0" style="border:0"></iframe></div>
            </div>
          </div>
          <div class="col-grid-4">
            <div class="contact-rightbar con_form">
              <h3> Feedback </h3>

                <?php echo do_shortcode('[contact-form-7 id="14" title="Contact form 1"]'); ?>
                  
            </div>
          </div>
        </div>
        </div>
    </div>
 
    </div><!-- #content -->
  </div><!-- #primary -->
  </section>
  </section>
  </section>
</section><!-- #main-content -->

<?php
get_footer();
