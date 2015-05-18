<?php
/* Template Name: Paint Calculator */
get_header(); ?>
<section class="main-container clearfix">
    <section class="main wrapper clearfix">
        <section class="inner-main-container clearfix">
            <section class="inner-content clearfix">
                <header class="heading-title">
                    <h1><?php the_title();?></h1>
                </header>
                <div class="main-content clearfix">
                    <div class="tabbing clearfix">
                        <div class="tabs clearfix">
                          <ul>
                            <li class="first calcBasic"><a title="Basic Paint Calculator" data-calc="calcBasic" href="Javascript:void(0);">Primary Paint Calculator</a></li>
                            <li class="calcComp active"><a title="Comprehensive Paint Calculator" data-calc="calcComp" href="Javascript:void(0);">Detailed Paint Calculator</a></li>
                          </ul>
                        </div>
                        <div class="tabContent clearfix"> 
                          <!--calcBlock starts here--> 
                          <div style="display: none;" class="calcBlock clearfix" id="calcBasic"> 
                            <!--calcBlock_left starts here-->
                            <div class="calcBlock_left">
                              <div class="rowBlock">
                                <h2>Where are you painting?</h2>
                                <ul>
                                  <li>
                                    <input class="radio1" name="radio" value="" checked="checked" data-type="Interior" data-coats="2" data-coverage="14" data-product="Luxe Interior Ultra Acrylic Low Sheen" data-image="<?php echo get_template_directory_uri(); ?>/images/calc/Luxe-Interior-Ultra-Low-sheen.png" type="radio">
                                    <small>Interior</small> </li>
                                  <li>
                                    <input class="radio1" name="radio" value="" data-type="Exterior" data-coats="2" data-coverage="14" data-product="Weatherblock Acrylic Low Sheen" data-image="<?php echo get_template_directory_uri(); ?>/images/calc/Weatherblock-Acrylic-Low-Sheen.png" type="radio">
                                    <small>Exterior</small> </li>
                                </ul>
                              </div>
                              <div class="height-gap"></div>
                              <div class="rowBlock">
                                <h2>Room Dimensions</h2>
                                <div class="colBlock"> <span>Width</span>
                                  <input class="inputbox basicWidth form-control" name="text" value="0" type="text">
                                  <small>metres</small> </div>
                                <div class="colBlock"> <span  class="measurement">Height</span>
                                  <input class="inputbox basicHeight form-control" name="text" value="0" type="text">
                                  <small>metres</small> </div>
                                <div class="colBlock"> <span>Coats</span>
                                  <input class="inputbox basicCoats form-control" name="text" value="2" type="text">
                                  <small>coats</small> </div>
                                <a title="Calculate Results" class="result_btn" href="Javascript:void(0);"><span>Calculate Results</span></a> 
                              </div>
                            </div>
                            <!--calcBlock_left ends here--> 
                            <!--calcBlock_right starts here-->
                            <div class="calcBlock_right">
                              <div class="rowBlock_right">
                                <h4>You need approximately</h4>
                                <h2 class="basicLitres">0</h2>
                                <span>Litres</span> </div>
                              <div class="rowBlock1_right">
                                <h4>Recommendation</h4>
                                <p class="basicProduct">Luxe Interior Ultra Acrylic Low Sheen</p>
                                <div class="select-image">
                                  <img class="basicImage" src="<?php echo get_template_directory_uri(); ?>/images/calc/Luxe-Interior-Ultra-Low-sheen.png" alt="">
                                </div> 
                                <a title="Print Calculation" class="print_page" href="Javascript:void(0);">Print Calculation</a> 
                              </div>
                            </div>
                            <!--calcBlock_right ends here--> 
                          </div>
                          <!--calcBlock ends here--> 

                          <!--calcBlock2 starts here-->
                          <div style="display: block;" class="calcBlock clearfix" id="calcComp"> 
                            <!--calcBlock2_left starts here-->
                            <div class="calcBlock2_left">
                              <div class="basicCalc_block"> <a class="surfaceToggle active" href="Javascript:void(0);"><span>Interior</span></a>
                                <ul>
                                  <li> <small>Ceiling</small> <strong> <a class="addSurface" title="+ Add" href="Javascript:void(0);" data-surface="Ceiling" data-type="Interior"  data-coverage="12" data-coats="2" data-product="Luxe High Opacity Ceiling Flat" data-image="<?php echo get_template_directory_uri(); ?>/images/calc/Luxe-Acrylic-Ceiling-Flat.png">+ Add</a> </strong> </li>
                                  <li> <small>Walls</small> <strong> <a class="addSurface" title="+ Add" href="Javascript:void(0);" data-surface="Walls" data-type="Interior" data-coverage="12" data-coats="2" data-product="Luxe Interior Ultra Acrylic Low Sheen"  data-measurement="Height" data-image="<?php echo get_template_directory_uri(); ?>/images/calc/Luxe-Interior-Ultra-Low-sheen.png">+ Add</a> </strong> </li>
                                  <li> <small>Skirting</small> <strong> <a class="addSurface" title="+ Add" href="Javascript:void(0);" data-surface="Skirting" data-type="Interior"   data-coverage="12" data-coats="2" data-product="Endure Int/Ext High Gloss Enamel" data-image="<?php echo get_template_directory_uri(); ?>/images/calc/Endure-Interior-Exterior-Gloss-Enamel-10l.png">+ Add</a> </strong> </li>
                                  <li> <small>Windows</small> <strong> <a class="addSurface" title="+ Add" href="Javascript:void(0);" data-surface="Windows" data-type="Interior" data-coverage="12"  data-coats="2" data-product="Endure Int/Ext High Gloss Enamel" data-image="<?php echo get_template_directory_uri(); ?>/images/calc/Endure-Interior-Exterior-Gloss-Enamel-10l.png">+ Add</a> </strong> </li>
                                  <li> <small>Doors(one side)</small> <strong> <a class="addSurface" title="+ Add" href="Javascript:void(0);" data-surface="Doors(one side)" data-type="Interior"  data-coverage="12" data-coats="2" data-product="Endure Int/Ext High Gloss Enamel" data-image="<?php echo get_template_directory_uri(); ?>/images/calc/Endure-Interior-Exterior-Gloss-Enamel-10l.png">+ Add</a> </strong> </li>
                                  <li> <small>Door Frame(one side)</small> <strong> <a class="addSurface" title="+ Add" href="Javascript:void(0);" data-surface="Door Frame(one side)" data-type="Interior"  data-coverage="12" data-coats="2" data-product="Endure Int/Ext High Gloss Enamel" data-image="<?php echo get_template_directory_uri(); ?>/images/calc/Endure-Interior-Exterior-Gloss-Enamel-10l.png">+ Add</a> </strong> </li>
                                  <li> <small>Trim</small> <strong> <a class="addSurface" title="+ Add" href="Javascript:void(0);" data-surface="Trim" data-type="Interior" data-coverage="12" data-coats="3" data-product="Simply Woodcare - Easy floor"  data-image="<?php echo get_template_directory_uri(); ?>/images/calc/Endure-Interior-Exterior-Gloss-Enamel-10l.png" data-measurement="Length">+ Add</a> </strong> </li>
                                </ul>
                              </div>
                              <div class="basicCalc_block"> <a class="surfaceToggle" href="Javascript:void(0);"><span>Exterior</span></a>
                                <ul style="display:none;">
                                  <li> <small>Gutters</small> <strong> <a class="addSurface" title="+ Add" href="Javascript:void(0);" data-surface="Gutters" data-type="Exterior" data-coverage="12" data-coats="2" data-product="Weatherblock Acrylic Gloss" data-prevpaint="8" data-image="<?php echo get_template_directory_uri(); ?>/images/calc/WeatherBlock-Acrylic-Gloss.png">+ Add</a> </strong> </li>
                                  <li> <small>Facia Boards</small> <strong> <a class="addSurface" title="+ Add" href="Javascript:void(0);" data-surface="Facia Boards" data-type="Exterior" data-coverage="12" data-coats="2" data-product="Weatherblock Acrylic Gloss" data-prevpaint="8" data-image="<?php echo get_template_directory_uri(); ?>/images/calc/WeatherBlock-Acrylic-Gloss.png">+ Add</a> </strong> </li>
                                  <li> <small>Eaves</small> <strong> <a class="addSurface" title="+ Add" href="Javascript:void(0);" data-surface="Eaves" data-type="Exterior" data-coverage="12" data-coats="2" data-product="Weatherblock Acrylic Flat" data-prevpaint="8" data-image="<?php echo get_template_directory_uri(); ?>/images/calc/WeatherBlock-Acrylic-Flat.png">+ Add</a> </strong> </li>
                                  <li> <small>Walls</small> <strong> <a class="addSurface" title="+ Add" href="Javascript:void(0);" data-surface="Walls" data-type="Exterior" data-coverage="10" data-coats="2" data-product="Weatherblock Acrylic Low Sheen" data-prevpaint="8"  data-measurement="Height" data-image="<?php echo get_template_directory_uri(); ?>/images/calc/Weatherblock-Acrylic-Low-Sheen.png">+ Add</a> </strong> </li>
                                  <li> <small>Window Frames</small> <strong> <a class="addSurface" title="+ Add" href="Javascript:void(0);" data-surface="Window Frames" data-type="Exterior" data-coverage="12" data-coats="2" data-product="Weatherblock Acrylic Low Sheen" data-prevpaint="8" data-image="<?php echo get_template_directory_uri(); ?>/images/calc/Endure-Interior-Exterior-Gloss-Enamel-10l.png">+ Add</a> </strong> </li>
                                  <li> <small>Doors (one side)</small> <strong> <a class="addSurface" title="+ Add" href="Javascript:void(0);" data-surface="Window Frames" data-type="Exterior" data-coverage="12" data-coats="2" data-product="Endure Int/Ext High Gloss Enamel" data-prevpaint="8" data-image="<?php echo get_template_directory_uri(); ?>/images/calc/Endure-Interior-Exterior-Gloss-Enamel-10l.png">+ Add</a> </strong> </li>
                                  <li> <small>Door Frame (one side)</small> <strong> <a class="addSurface" title="+ Add" href="Javascript:void(0);" data-surface="Window Frames" data-type="Exterior" data-coverage="12" data-coats="2" data-product="Endure Int/Ext High Gloss Enamel" data-prevpaint="8" data-image="<?php echo get_template_directory_uri(); ?>/images/calc/Endure-Interior-Exterior-Gloss-Enamel-10l.png">+ Add</a> </strong> </li>
                                  <li> <small>Roller Door (one side)</small> <strong> <a class="addSurface" title="+ Add" href="Javascript:void(0);" data-surface="Window Frames" data-type="Exterior" data-coverage="12" data-coats="2" data-product="Endure Int/Ext High Gloss Enamel" data-prevpaint="8" data-image="<?php echo get_template_directory_uri(); ?>/images/calc/Endure-Interior-Exterior-Gloss-Enamel-10l.png">+ Add</a> </strong> </li>
                                  <li> <small>Trim</small> <strong> <a class="addSurface" title="+ Add" href="Javascript:void(0);" data-surface="Window Frames" data-type="Exterior" data-coverage="12" data-coats="2" data-product="Endure Int/Ext High Gloss Enamel" data-prevpaint="8" data-image="<?php echo get_template_directory_uri(); ?>/images/calc/Endure-Interior-Exterior-Gloss-Enamel-10l.png">+ Add</a> </strong> </li>
                                  <li> <small>Decking Finish (top side)</small> <strong> <a class="addSurface" title="+ Add" href="Javascript:void(0);" data-surface="Decking Finish (top side)" data-type="Exterior" data-coverage="1" data-coats="2" data-product="Touchwood Deck and Furniture oil" data-prevpaint="8" data-image="<?php echo get_template_directory_uri(); ?>/images/calc/Touchwood-Deck-Furniture-Oil-10l.png">+ Add</a> </strong> </li>
                                  <li> <small>Driveway</small> <strong> <a class="addSurface" title="+ Add" href="Javascript:void(0);" data-surface="Driveway" data-type="Exterior" data-coverage="6" data-coats="2" data-product="Rapid Pave Paving Enamel" data-prevpaint="8" data-image="<?php echo get_template_directory_uri(); ?>/images/calc/Rapid-Pave-Paving-Enamel-20l.png">+ Add</a> </strong> </li>
                                  <li> <small>Roof (top side)</small> <strong> <a class="addSurface" title="+ Add" href="Javascript:void(0);" data-surface="Roof (top side)" data-type="Exterior" data-coverage="6" data-coats="2" data-product="Highshield Roof Acrylic" data-prevpaint="8" data-image="<?php echo get_template_directory_uri(); ?>/images/calc/Apco-Roof-Acrylic-gloss-20L.png">+ Add</a> </strong> </li>
                                </ul>
                              </div>
                            </div>
                            <!--calcBlock2_left ends here--> 
                            <!--calcBlock2_right starts here-->
                            <div class="calcBlock2_right"> 

                              <!--paintDesign_sec starts here-->
                              <div class="paintDesign_sec" style="display: none;"> 
                                <!--paintDesign_top starts here-->
                                <div class="paintDesign_top">
                                  <h2 class="surfaceName">Exterior Doors</h2>
                                  <span><a class="surfaceRemove" href="Javascript:void(0);"><img src="<?php echo get_template_directory_uri(); ?>/images/calc/cross_icon.png" alt=""></a></span> </div>
                                <!--paintDesign_top ends here--> 
                                <!--paintDesign_bottom starts here-->
                                <div class="paintDesign_bottom"> 
                                  <!--paintDesign_left starts here-->
                                  <div class="paintDesign_left surfaceMetrics">
                                    <div class="colBlock"> <span>Length</span>
                                      <input value="0" name="text" class="surfaceLength inputbox form-control" type="text">
                                      <small>metres</small> </div>
                                    <div class="colBlock"> <span>Width</span>
                                      <input value="0" name="text" class="surfaceWidth inputbox form-control" type="text">
                                      <small>metres</small> </div>
                                    <div class="colBlock"> <span class="measurement">Height</span>
                                      <input value="2.4" name="text" class="surfaceHeight inputbox form-control" type="text">
                                      <small>metres</small> </div>
                                    <div class="colBlock"> <span>Coats</span>
                                      <input value="2" name="text" class="surfaceCoats inputbox form-control" type="text">
                                      <small>coats</small> </div>
                                    <input name="text" class="surfaceCoverage" type="hidden">
                                    <input name="text" class="prevPainted" type="hidden">
                                  </div>
                                  <!--paintDesign_left ends here--> 
                                  <!--paintDesign_mid starts here-->
                                  <div class="paintDesign_mid">
                                    <div class="rowBlock1_right">
                                      <h4>Recommendation</h4>
                                      <p class="productName">Weatherblock Acrylic Low Sheen</p>
                                      <div class="add-image-block"><img class="surfaceImage" alt="" src="<?php echo get_template_directory_uri(); ?>/images/calc/Weatherblock-Acrylic-Low-Sheen.png"></div> </div>
                                  </div>
                                  <!--paintDesign_mid ends here--> 
                                  <!--paintDesign_right starts here-->
                                  <div class="paintDesign_right surfaceLitreage">
                                    <p>You need<br>
                                      approximately</p>
                                    <h3>0</h3>
                                    <h4>litres</h4>
                                  </div>

                                  <!--paintDesign_right ends here--> 
                                </div>
                                <!--paintDesign_bottom ends here--> 
                              </div>

                              <!--paintDesign_sec ends here--> 

                              <!--add_surface starts here--> 
                              <!--<div class="add_surface"><span>Add surfaces you want to measure by clicking</span> <small><a title="+ Add on" href="Javascript:void(0);">+ Add on</a> the left hand menu.</small> </div>--> 
                              <!--add_surface ends here--> 
                              <a href="Javascript:void(0);" title="Print Calculation" class="details_btn print_page"> <!--<small>  <img src="<?php echo get_template_directory_uri(); ?>/images/calc/print_img2.png" alt="print_info"> </small> --> <span>Print Calculation</span> </a> <a href="Javascript:void(0);" title="Help" id="calculator-help" class="details_btn wid help_btn"> <!-- <small> <img src="<?php echo get_template_directory_uri(); ?>/images/calc/i_img.png" alt="Help_info"> </small> --> <span>Help</span> </a> </div>
                          </div>
                          <!--calcBlock2_right ends here--> 
                        </div>
                        <!--calcBlock2 ends here--> 

                      </div>
                </div>
            </section>
        </section>
    </section> <!-- #main -->
</section> <!-- #main-container -->
<?php get_footer();?>