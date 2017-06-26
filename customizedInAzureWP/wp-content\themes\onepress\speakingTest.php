<?php /* Template Name: spokenQuiz2 */ ?>
<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package OnePress
 */

get_header();

$layout = get_theme_mod( 'onepress_layout', 'right-sidebar' );
?>
	<?php echo onepress_breadcrumb(); 
     $i = 1;
     $sent = array("[responsivevoice buttonposition=\"after\"]Rich people reached America  [/responsivevoice]",
                   "[responsivevoice buttonposition=\"after\"]My uncle broke his ankle [/responsivevoice]",
                   "[responsivevoice buttonposition=\"after\"]He had some chips which were cheap  [/responsivevoice]",
                   "[responsivevoice buttonposition=\"after\"]I ran when she asked me to run  [/responsivevoice]",
                   "[responsivevoice buttonposition=\"after\"]I drank while he was drunk  [/responsivevoice]",
                   "[responsivevoice buttonposition=\"after\"]At least the list was there  [/responsivevoice]",
                   "[responsivevoice buttonposition=\"after\"]Pete fell into the pit  [/responsivevoice]",
                   "[responsivevoice buttonposition=\"after\"]People in the mill had their meal  [/responsivevoice]",
                   "[responsivevoice buttonposition=\"after\"]The dam was built by a dumb person  [/responsivevoice]",
                   "[responsivevoice buttonposition=\"after\"]Beach shack and white shark  [/responsivevoice]");
     ?>
<script type="text/javascript">
   var i = 0;
   var queText ="";
   var sentences = ["Rich people reached America","My uncle broke his ankle","He had some chips which were cheap","I ran when she asked me to run",
     "I drank while he was drunk","At least the list was there","Pete fell into the pit",
     "People in the mill had their meal","The dam was built by a dumb person","Beach shack and white shark"];
  window.onload=function(){
    $("#t1").show();
    queText = sentences[0].toUpperCase();
    // Chrome 1+
    var isChrome = !!window.chrome && !!window.chrome.webstore;
    if(isChrome){document.getElementById('warning').innerHTML = "";}
    }
    //next&pervious
    function nexSen(){
      switch(i) {
        case 0:
           i++; $("#t1").hide(); $("#t2").show(); queText = sentences[1].toUpperCase(); break;
        case 1:
           i++; $("#t2").hide(); $("#t3").show(); queText = sentences[2].toUpperCase();break;
        case 2:
           i++; $("#t3").hide(); $("#t4").show(); queText = sentences[3].toUpperCase();break;
        case 3:
           i++; $("#t4").hide(); $("#t5").show(); queText = sentences[4].toUpperCase();break;
        case 4:
           i++; $("#t5").hide(); $("#t6").show(); queText = sentences[5].toUpperCase();break;
        case 5:
           i++; $("#t6").hide(); $("#t7").show(); queText = sentences[6].toUpperCase();break;
        case 6:
           i++; $("#t7").hide(); $("#t8").show(); queText = sentences[7].toUpperCase();break;
        case 7:
           i++; $("#t8").hide(); $("#t9").show(); queText = sentences[8].toUpperCase();break;
        case 8:
           i++; $("#t9").hide(); $("#t10").show(); queText = sentences[9].toUpperCase();break;
        case 9:
           i++; $("#t10").hide(); $("#t11").show(); queText = sentences[10].toUpperCase();break;
        case 10:
           i++; $("#t11").hide(); $("#t12").show(); queText = sentences[11].toUpperCase();break;
        case 11:
           i++; $("#t12").hide(); $("#t13").show(); queText = sentences[12].toUpperCase();break;
        case 12:
           i++; $("#t13").hide(); $("#t14").show(); queText = sentences[13].toUpperCase();break;
        case 13:
           i++; $("#t14").hide(); $("#t15").show(); queText = sentences[14].toUpperCase();break;
        case 14:
           i++; $("#t15").hide(); $("#t16").show(); queText = sentences[15].toUpperCase();break;
        case 15:
           i++; $("#t16").hide(); $("#t17").show(); queText = sentences[16].toUpperCase();break;
        default:
           i=0; $("#t17").hide(); $("#t1").show(); queText = sentences[0].toUpperCase();
        }
        document.getElementById('interim_span').innerHTML = " ";
        document.getElementById('mark').innerHTML = "";
        document.getElementById('final_span').innerHTML = " ";
     }
     function perSen(){
      switch(i) {
        case 1:
           i--; $("#t1").show(); $("#t2").hide(); queText = sentences[0].toUpperCase();break;
        case 2:
           i--; $("#t2").show(); $("#t3").hide(); queText = sentences[1].toUpperCase();break;
        case 3:
           i--; $("#t3").show(); $("#t4").hide(); queText = sentences[2].toUpperCase();break;
        case 4:
           i--; $("#t4").show(); $("#t5").hide(); queText = sentences[3].toUpperCase();break;
        case 5:
           i--; $("#t5").show(); $("#t6").hide(); queText = sentences[4].toUpperCase();break;
        case 6:
           i--; $("#t6").show(); $("#t7").hide(); queText = sentences[5].toUpperCase();break;
        case 7:
           i--; $("#t7").show(); $("#t8").hide(); queText = sentences[6].toUpperCase();break;
        case 8:
           i--; $("#t8").show(); $("#t9").hide(); queText = sentences[7].toUpperCase();break;
        case 9:
           i--; $("#t9").show(); $("#t10").hide(); queText = sentences[8].toUpperCase();break;
        case 10:
           i--; $("#t10").show(); $("#t11").hide(); queText = sentences[9].toUpperCase();break;
        case 11:
           i--; $("#t11").show(); $("#t12").hide(); queText = sentences[10].toUpperCase();break;
        case 12:
           i--; $("#t12").show(); $("#t13").hide(); queText = sentences[11].toUpperCase();break;
        case 13:
           i--; $("#t13").show(); $("#t14").hide(); queText = sentences[12].toUpperCase();break;
        case 14:
           i--; $("#t14").show(); $("#t15").hide(); queText = sentences[13].toUpperCase();break;
        case 15:
           i--; $("#t15").show(); $("#t16").hide(); queText = sentences[14].toUpperCase();break;
        case 16:
           i--; $("#t16").show(); $("#t17").hide(); queText = sentences[15].toUpperCase();break;
        default:
           i=16; $("#t17").show(); $("#t1").hide(); queText = sentences[16].toUpperCase();
        }
        document.getElementById('interim_span').innerHTML = " ";
        document.getElementById('mark').innerHTML = "";
        document.getElementById('final_span').innerHTML = " ";
     }
</script>
	<div id="content" class="site-content speaking-content" style="min-height:75vmin;">
		<div id="content-inside" class="container  <?php echo esc_attr( $layout ); ?>">
             <div class="content" style="min-height:250px;margin:30px 0;">
             <h2 style="text-transform: uppercase;">Practise your pronunciation</h2>
             <p style="font-size:18px;">Press the 'start' button and read the short sentence </p>

                 <div class="text-center speakingQue">
                    <h3 id="que">
                      <p id="t1" style="display:none;"><?php echo do_shortcode($sent[0]);?><span>1/10</span></p>
                      <p id="t2" style="display:none;"><?php echo do_shortcode($sent[1]);?><span>2/10</span></p>
                      <p id="t3" style="display:none;"><?php echo do_shortcode($sent[2]);?><span>3/10</span></p>
                      <p id="t4" style="display:none;"><?php echo do_shortcode($sent[3]);?><span>4/10</span></p>
                      <p id="t5" style="display:none;"><?php echo do_shortcode($sent[4]);?><span>5/10</span></p>
                      <p id="t6" style="display:none;"><?php echo do_shortcode($sent[5]);?><span>6/10</span></p>
                      <p id="t7" style="display:none;"><?php echo do_shortcode($sent[6]);?><span>7/10</span></p>
                      <p id="t8" style="display:none;"><?php echo do_shortcode($sent[7]);?><span>8/10</span></p>
                      <p id="t9" style="display:none;"><?php echo do_shortcode($sent[8]);?><span>9/10</span></p>
                      <p id="t10" style="display:none;"><?php echo do_shortcode($sent[9]);?><span>10/10</span></p>
                    </h3><br/>
                    <div id="results" class="text-center speakingResults">
                        <span id="final_span" class="final"></span>
                        <span id="interim_span" class="interim">
                             <p id="warning" style="font-size:15px;color:red;">
                               Sorry, but the speech recognition function is only supported in Google Chrome browsers.<br/><a style="color:blue;"href="https://www.google.com/chrome/browser/desktop">Click here to download <span style="font-size:18px;font-weignt:800;">Google Chrome</span></a></p>
                        </span>
                        <span id="mark"></span>
                    </div><br/><br/>
                    <div style="margin-bottom:40px;width:100%;">
                        <a id="perSen" onclick="perSen();" class="btnNormal"><</a> 
                        <a id="button" onclick="startDictation(event)" class="btnNormal">Start</a>
                        <a id="nexSen" onclick="nexSen();" class="btnNormal">></a>
                    </div>
                 </div>
             </div>
        </div>
            
          <script type="text/javascript">
          var final_transcript = '';
          var recognizing = false;
          
          if ('webkitSpeechRecognition' in window) {
          
            var recognition = new webkitSpeechRecognition();
          
            recognition.continuous = true;
            recognition.interimResults = true;
          
            recognition.onstart = function() {
              recognizing = true;
            };
          
            recognition.onerror = function(event) {
              console.log(event.error);
            };
          
            recognition.onend = function() {
              recognizing = false;
            };
          
            recognition.onresult = function(event) {
              var interim_transcript = '';
              for (var i = event.resultIndex; i < event.results.length; ++i) {
                if (event.results[i].isFinal) {
                  final_transcript += event.results[i][0].transcript;
                } else {
                  interim_transcript += event.results[i][0].transcript;
                }
              }
              final_transcript = capitalize(final_transcript);
              final_span.innerHTML = linebreak(final_transcript);
              interim_span.innerHTML = linebreak(interim_transcript);
            };
          }
          
          var two_line = /\n\n/g;
          var one_line = /\n/g;
          function linebreak(s) {
            return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
          }
          
          function capitalize(s) {
            return s.replace(s.substr(0,1), function(m) { return m.toUpperCase(); });
          }
          
          function startDictation(event) {
            if (recognizing) {
              recognition.stop();
              document.getElementById("button").innerHTML = "Start";
              var per = document.getElementById("perSen");
              per.hidden = false;
              var nex = document.getElementById("nexSen");
              nex.hidden = false;
              //var ques = document.getElementById("que");
              //var queText = ques.textContent.toUpperCase();
              while(queText != queText.replace(" ", "")){
                queText = queText.replace(" ", "");
              }
              var ans = document.getElementById("interim_span");
              var ansText = ans.textContent.toUpperCase();
              while(ansText != ansText.replace(" ", "")){
                ansText = ansText.replace(" ", "");
              }
              //window.alert(queText+","+ansText);
              if(ansText == queText){
                mark.innerHTML ='&#x2714;';
              }
              else{mark.innerHTML = '&#x2718;';}
              return;
            }
            else{
              recognizing = true;
              document.getElementById("button").innerHTML = "Stop";
              var per = document.getElementById("perSen");
              per.hidden = true;
              var nex = document.getElementById("nexSen");
              nex.hidden = true;
            }
            final_transcript = '';
            recognition.lang = 'en-US';
            recognition.start();
            final_span.innerHTML = '';
            interim_span.innerHTML = '';
            mark.innerHTML = '';
          }
          
          </script>

			</div><!-- #primary -->
            <?php if ( $layout != 'no-sidebar' ) { ?>
			<?php get_sidebar(); ?>
            <?php } ?>

		</div><!--#content-inside -->
	</div><!-- #content -->

<?php get_footer(); ?>
