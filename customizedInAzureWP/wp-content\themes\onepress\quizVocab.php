<?php /* Template Name: Vocabulary Quiz */ ?>
<?php get_header(); 
$layout = get_theme_mod( 'onepress_layout', 'right-sidebar' );
?>


	<?php echo onepress_breadcrumb(); ?>

	<div id="content" class="site-content">
		<div id="content-inside" class="container <?php echo esc_attr( $layout ); ?>">
			<div id="primary" class="content-area">

<?php echo do_shortcode("[wce_code id=2]");?>
<div class="row">
    <div class="col-lg-9 col-sm-9 col-xs-12 text-center" style="border:2px solid red;float:left;">
        <div id="card1" style="display:none;width:700px;"><?php echo do_shortcode("[bw_embed code=\"5CD4FA\" width=700 height=400 allowfullscreen=1]"); ?></div>
        <div id="b1" style="display:none;">
            <button onclick="document.getElementById('card2').style.display = 'block';
                    document.getElementById('b2').style.display = 'block';
                    document.getElementById('card1').style.display = 'none';
                    document.getElementById('b1').style.display = 'none';">next deck2</button>
        </div>
        <div id="card2" style="display: none;width:700px;"><?php echo do_shortcode("[bw_embed code=\"2CDWZZ\" width=700 height=400 allowfullscreen=1]"); ?></div>
        <div id="b2" style="display:none;">
            <button onclick="document.getElementById('card1').style.display = 'block';
                    document.getElementById('b1').style.display = 'block';
                    document.getElementById('card2').style.display = 'none';
                    document.getElementById('b2').style.display = 'none';">previous deck1</button>
            <button onclick="document.getElementById('card3').style.display = 'block';
                    document.getElementById('b3').style.display = 'block';
                    document.getElementById('card2').style.display = 'none';
                    document.getElementById('b2').style.display = 'none';">next deck3</button>
        </div>
        <div id="card3" style="display: none;width:700px;"><?php echo do_shortcode("[bw_embed code=\"SCDX63\" width=700 height=400 allowfullscreen=1]"); ?></div>
        <div id="b3" style="display:none;">
            <button onclick="document.getElementById('card2').style.display = 'block';
                    document.getElementById('b2').style.display = 'block';
                    document.getElementById('card3').style.display = 'none';
                    document.getElementById('b3').style.display = 'none';">previous deck2</button>
            <button onclick="document.getElementById('card4').style.display = 'block';
                    document.getElementById('b4').style.display = 'block';
                    document.getElementById('card3').style.display = 'none';
                    document.getElementById('b3').style.display = 'none';">next deck4</button>
        </div>
        <div id="card4" style="display: none;width:700px;"><?php echo do_shortcode("[bw_embed code=\"UCDX8X\" width=700 height=400 allowfullscreen=1]"); ?></div>
        <div id="b4" style="display:none;">
            <button onclick="document.getElementById('card3').style.display = 'block';
                    document.getElementById('b3').style.display = 'block';
                    document.getElementById('card4').style.display = 'none';
                    document.getElementById('b4').style.display = 'none';">previous deck3</button>
            <button onclick="document.getElementById('card5').style.display = 'block';
                    document.getElementById('b5').style.display = 'block';
                    document.getElementById('card4').style.display = 'none';
                    document.getElementById('b4').style.display = 'none';">next deck5</button>
        </div>
        <div id="card5" style="display: none;width:700px;"><?php echo do_shortcode("[bw_embed code=\"VCDYBS\" width=700 height=400 allowfullscreen=1]"); ?></div>
        <div id="b5" style="display:none;">
            <button onclick="document.getElementById('card4').style.display = 'block';
                    document.getElementById('b4').style.display = 'block';
                    document.getElementById('card5').style.display = 'none';
                    document.getElementById('b5').style.display = 'none';">previous deck4</button>
        </div>
    
        <div id="lost" style="display: none;font-size:25px;">Sorry, we could not find the <br/>deck you were looking for. <br/>Please try another one in
            <a href="http://elawp.azurewebsites.net/voc-home/">vocabulary home</a>.
        </div>
    </div>
    <div class="col-lg-2 col-sm-2 col-xs-12">
        HOW TO USE:
    
    To flip: Click on the card to flip it.
    
    To navigate: Use the left and right arrows on your keyboard to move between cards, or swipe left and right for mobile.
    </div>
</div>
<script>
   var query_string = {};
   var query = window.location.search.substring(1);
   var pair = query.split("=");
   if(pair[1]=="ECDQFD"){
   document.getElementById('card1').style.display='block';
   document.getElementById('b1').style.display='block';}
   else if(pair[1]=="2CDWZZ"){
   document.getElementById('card2').style.display='block';
   document.getElementById('b2').style.display='block';}
   else if(pair[1]=="SCDX63"){
   document.getElementById('card3').style.display='block';
   document.getElementById('b3').style.display='block';}
   else if(pair[1]=="UCDX8X"){
   document.getElementById('card4').style.display='block';
   document.getElementById('b4').style.display='block';}
   else if(pair[1]=="VCDYBS"){
   document.getElementById('card5').style.display='block';
   document.getElementById('b5').style.display='block';}
   else{
       document.getElementById('lost').style.display='block';}
</script>

			</div><!-- #primary -->
            <?php if ( $layout != 'no-sidebar' ) { ?>
			<?php get_sidebar(); ?>
            <?php } ?>

		</div><!--#content-inside -->
	</div><!-- #content -->

<?php get_footer(); ?>
