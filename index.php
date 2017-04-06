<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

    <head>
        <title>Home page</title>
	<link rel="stylesheet" type="text/css" href="css/common.css" />
        <link rel="stylesheet" type="text/css" href="css/CircleFlip.css" />
        <!-- Plugins -->
        <link href="css/HPanimations.css" rel="stylesheet">
        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/NavigationFooter.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript">

            function goToQuiz(){
                if(!(document.getElementById('na1').checked )){//|| document.getElementById('na2').checked || document.getElementById('na3').checked)){
                    valMessage.hidden=false;
                    var takeQuiz = document.getElementById('takeQuiz');
                    takeQuiz.style.backgroundColor="Grey";
                    takeQuiz.style.cursor="not-allowed";
                }else{
                    window.location.href="quizHome.php";
                }
            }
            function valiNationality(){
                    valMessage.hidden=true;
                    takeQuiz.style.cursor="pointer";
                    takeQuiz.style.backgroundColor="#ffd966";
            }
        </script>
    </head>
    <body class="no-trans">
        
        <?php require 'menu.php';?>     
        <?php
        $con = mysqli_connect("localhost", "phpuser", "phpuserpw");
        if (!$con) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
        //set the default client character set 
        mysqli_set_charset($con, 'utf-8');

        mysqli_select_db($con, "IEL1");
        $factsDB = mysqli_query($con, "SELECT fact FROM DIDYOUKNOW");
        $factsNum = mysqli_num_rows($factsDB);
        while($row=mysqli_fetch_array($factsDB))
        {
            $facts[]=$row;
        }
        $i=0;
        $randStr1=null;
        while ($i<$factsNum)
        {
            $randStr1.=$i;
            $i++;
        }
        $randStr2 = str_shuffle($randStr1);
        $length = 5;
        $randFacts = substr($randStr2,0,$length);
        mysqli_free_result($factsDB);
        mysqli_close($con);
        ?>
<!-- ================ -->
<!-- banner start -->
<!-- ================ -->
        <div id="banner" class="banner">
            <div class="banner-image"></div>
                <div class="banner-caption">
                    <div class="container">
                        <div class="col-md-8 col-md-offset-2 object-non-visible" data-animation-effect="fadeIn">
                            <h1 class="text-center">Test your English for <span>free</span> now</h1>
                            <p class="lead text-center">Select your nationality below and <br/>take a quiz customised specially to your nationality.</p>
                            <div class="col-lg-12 text-center">
                                <div class="row">
                                    <label>
                                        <input type="radio" id="na1" name="nationality" value="chinese" onclick="valiNationality();"/>
                                        <img src="img/cnlarge.gif" class="img-button">
                                    </label>
<!--                                    <label>
                                        <input type="radio" id="na2" name="nationality" value="ml" onclick="valiNationality();"/>
                                        <img src="img/cnlarge.gif" class="img-button">
                                    </label>
                                    <label>
                                        <input type="radio" id="na3" name="nationality" value="what" onclick="valiNationality();"/>
                                        <img src="img/cnlarge.gif" class="img-button">
                                    </label>-->
                                </div>
                                <input type="submit" id=takeQuiz class="btn-bigNormal" value="take quiz now" onclick="goToQuiz();"/>
                                <p id="valMessage" style="color:red; text-align: center; font-size:18px; font-weight: 500;" hidden="true;"><br/>Please select a nation to proceed.</p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
<!-- banner end -->
<!-- ================ -->
<!--circle flip section start--> 
        <section>
            <div style="background-color: #595959; padding: 5px; size: auto">
           <ul class="ch-grid">
               <li>
                   <div class="ch-item ch-img-3" style="margin-top: 70px;">				
                            <div class="ch-info-wrap">
                                    <div class="ch-info">
                                            <div class="ch-info-front ch-img-3"></div>
                                            <div class="ch-info-back">
                                                    <h3><?php print_r($facts[$randFacts[0]]["fact"]); ?></h3>
                                            </div>	
                                    </div>
                            </div>
                    </div>
                </li>
                <li>
                    <div class="ch-item ch-img-3">
                            <div class="ch-info-wrap">
                                    <div class="ch-info">
                                            <div class="ch-info-front ch-img-3"></div>
                                            <div class="ch-info-back">
                                                    <h3><?php print_r($facts[$randFacts[1]]["fact"]); ?></h3>
                                            </div>
                                    </div>
                            </div>
                    </div>
                    <div style="height:70px; ">
                            <h1 class="text-center" style="margin-top: 60px; color:#ffd966">DID YOU</h1>
                    </div>
                </li>

               <li>
                        <div class="ch-item ch-img-3" style="margin-top: 70px;">
                                <div class="ch-info-wrap">
                                        <div class="ch-info">
                                                <div class="ch-info-front ch-img-3"></div>
                                                <div class="ch-info-back">
                                                        <h3><?php print_r($facts[$randFacts[2]]["fact"]); ?></h3>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </li>
            </ul>    
                <h1 class="text-center" style="margin: 0; color:#ffd966">KNOW</h1>
                <ul class="ch-grid">
                    <li>
                        <div class="ch-item ch-img-3" style="margin-left: -30px;">				
                            <div class="ch-info-wrap">
                                <div class="ch-info">
                                    <div class="ch-info-front ch-img-3"></div>
                                    <div class="ch-info-back">
                                            <h3><?php print_r($facts[$randFacts[3]]["fact"]); ?></h3>
                                    </div>	
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="ch-item ch-img-3"  style="margin-left: 40px;">
                            <div class="ch-info-wrap">
                                    <div class="ch-info">
                                            <div class="ch-info-front ch-img-3"></div>
                                            <div class="ch-info-back">
                                                    <h3><?php print_r($facts[$randFacts[4]]["fact"]); ?></h3>
                                            </div>
                                    </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
<!--circle flip section end-->           
<!-- ================ -->
<!--Benefit section start-->
        <section id="benefits">
        <div class="container">
            <div class="row text-center min-set">
                <div class="col-md-12">
                    <h2><mark class="head-glow">Why English Learning Assistant (ELA)?</h2>
                    ELA facilitates English learning based on a person’s country of birth. 
                        We aim to help non-native English speakers to improve their English.
                    <hr class="sub-hr" >
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-3 text-center">
                    <img src="img/p1.png" class="img-set" />
                    <h3>NATIONALITY CUSTOMISED</h3>
                    <p> Quizzes and learnings are specially customised to address common mistakes made by your nationality.</p>
                </div>
                <div class="col-xs-6 col-sm-3 text-center">
                    <img src="img/p2.png" class="img-set" />
                    <h3>INSTANTANEOUS RESULTS</h3>
                    <p>When you take a quiz, your test results will be evaluated and generated instantly for you to viewing.</p>
                </div>
                <div class="col-xs-6 col-sm-3 text-center">
                    <img src="img/p3.png" class="img-set" />
                    <h3>TRUSTED SOURCES</h3>
                    <p>ELA learning materials are sourced from various credible and trusted English websites and articles.</p>
                </div>
                <div class="col-xs-6 col-sm-3 text-center">
                    <img src="img/p4.png" class="img-set" />
                    <h3>PROGRESS RECORDED</h3>
                    <p>With an account, you can keep track of your own learning progress as well as access more learnings.</p>
                </div>
            </div>
        </div>
    </section>
<!--Benefit section end-->
<!-- ================ -->
        <?php include 'footer.php';?>

        <!-- JavaScript files placed at the end of the document so the pages load faster
        ================================================== -->
        <!-- Jquery and Bootstap core js files -->
        <script type="text/javascript" src="plugins/jquery.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

        <!-- Modernizr javascript -->
        <script type="text/javascript" src="plugins/modernizr.js"></script>

        <!-- Isotope javascript -->
        <script type="text/javascript" src="plugins/isotope/isotope.pkgd.min.js"></script>

        <!-- Backstretch javascript -->
        <script type="text/javascript" src="plugins/jquery.backstretch.min.js"></script>

        <!-- Appear javascript -->
        <script type="text/javascript" src="plugins/jquery.appear.js"></script>

        <!-- Initialization of Plugins -->
        <script type="text/javascript" src="js/Homepage.js"></script>

        <!-- Custom Scripts -->
        <script type="text/javascript" src="js/custom.js"></script>
    </body>
</html>
