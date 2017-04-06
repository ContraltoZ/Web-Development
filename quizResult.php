<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Result</title>
        <link rel="stylesheet" type="text/css" href="css/common.css" />
        <link rel="stylesheet" type="text/css" href="css/CircleFlip.css" />
        <!-- Plugins -->
        <link href="css/HPanimations.css" rel="stylesheet">
        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/NavigationFooter.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
        $sql = "SELECT questionDetail, questionID, explanation, correctAnswer FROM QUIZQUESTION WHERE nationality='Chinese' AND quizID=1";
        $result = mysqli_query($con, $sql);
        while($row=mysqli_fetch_array($result))
        {   
            $questions[]=$row;
        }
        $userAnswer[0]=$_POST['question1'];
        $userAnswer[1]=$_POST['question2'];
        $userAnswer[2]=$_POST['question3'];
        $userAnswer[3]=$_POST['question4'];
        $userAnswer[4]=$_POST['question5'];
        $userAnswer[5]=$_POST['question6'];
        $userAnswer[6]=$_POST['question7'];
        $userAnswer[7]=$_POST['question8'];
        $userAnswer[8]=$_POST['question9'];
        $userAnswer[9]=$_POST['question10'];                       
        for ($i = 0; $i < 10; $i++) {
            if($userAnswer[$i]!=$questions[$i]["correctAnswer"][0])
            {
                $mistakeID.=$i;
                
            }
        }
        $mistakeNum = strlen($mistakeID);
        $score = 10 - $mistakeNum;
        mysqli_free_result($result);
        mysqli_close($con);
        ?>
<!-- ================ -->
<!-- banner start -->
<!-- ================ -->
       <div id="banner-short" class="banner-short" 
        style="background: url('img/banner1.jpg'); background-size: cover ">
                <div class="banner-short-caption">
                    <div class="container">
                        <div class="col-md-8 col-md-offset-2" data-animation-effect="fadeIn">
                            <div class="row">
                                <img  src="img/starfull.png" class="img-set"  style="float: left;margin: 0 8%;"/>
                               
                                <h1 class="text-center">Congratulations,</h1>
                                <h2 class="text-center">you achieved <?php echo $score ?> out of 10 !</h2>
                                <div class="row col-lg-12 text-center" style="margin-top: 40px;">
                                    <input type="button" id=nextQuiz class="btnNormal" value="do another quiz" onclick="location.href='quizHome.php'"/>
                                    <input type="button" id=repeatQuiz class="btnWhite" value="redo quiz" onclick="location.href='quiz.php'"/>
                                </div>
                            </div>
                            <div class="row">
                                <img  src="img/starfull.png" class="img-set"  style="float: left;margin: 0 8%;"/>
                               
                                <h1 class="text-center">Oh,no!</h1>
                                <h2 class="text-center">You got <?php echo $score ?> out of 10 !</h2>
                                <div class="row col-lg-12 text-center" style="margin-top: 40px;">
                                    <input type="button" id=nextQuiz class="btnNormal" value="do another quiz" onclick="location.href='quizHome.php'"/>
                                    <input type="button" id=repeatQuiz class="btnWhite" value="redo quiz" onclick="location.href='quiz.php'"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!-- banner end -->
<!-- ================ -->
<!-- explanation start -->
    <section>
        <div class="col-lg-12" style="background-color: lightgray; padding: 5px; size: auto">
            
            <div class="container">
                <div class="text-left col-lg-10 " style="margin-left: 80px;" >
                    <h2>Mistakes and Explanation</h2>
                    
                    <div style="background-color: #595959; padding: 15px; size: auto; color: whitesmoke; margin: 15px 0; border-radius: 10px;">
                        <h3>Question <?php echo $mistakeID[2]+1; ?><br/><?php print_r($questions[$mistakeID[2]]["questionDetail"]); ?></h3>
                        <h4>Your answer: <?php echo $userAnswer[$mistakeID[2]];?> <br/>Correct answer: <?php print_r($questions[2]["correctAnswer"]); ?><br/><br/>
                            Explanation:<br/>
                            <?php print_r($questions[$mistakeID[2]]["explanation"]); ?></h4>
                    </div>
                     
                    <div style="background-color: #595959; padding: 15px; size: auto; color: whitesmoke; margin: 15px 0; border-radius: 10px;">
                        <h3>Question <?php echo $mistakeID[4]+1; ?><br/><?php print_r($questions[$mistakeID[4]]["questionDetail"]); ?></h3>
                        <h4>Your answer: <?php echo $userAnswer[$mistakeID[4]];?> <br/>Correct answer: <?php print_r($questions[4]["correctAnswer"]); ?><br/><br/>
                            Explanation:<br/>
                            <?php print_r($questions[$mistakeID[4]]["explanation"]); ?></h4>
                    </div>
                    
                    <div style="background-color: #595959; padding: 15px; size: auto; color: whitesmoke; margin: 15px 0; border-radius: 10px;">
                        <h3>Question <?php echo $mistakeID[9]+1; ?><br/><?php print_r($questions[$mistakeID[9]]["questionDetail"]); ?></h3>
                        <h4>Your answer: <?php echo $userAnswer[$mistakeID[9]];?> <br/>Correct answer: <?php print_r($questions[9]["correctAnswer"]); ?><br/><br/>
                            Explanation:<br/>
                            <?php print_r($questions[$mistakeID[9]]["explanation"]); ?></h4>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
<!-- explanation end -->
<!-- ================ -->
<!-- banner2 start -->
    <section>
        <div class="col-lg-12" style="background-color: #ffd966; padding: 25px; size: auto">
            <div class="container">
                <div class="text-center col-lg-10 " style="margin-left: 80px;" >
                    <h1>Looking for more study material?</h1>
                    <input type="button" id=nextQuiz class="btn-bigWhite" value="Go to general learnings"/>
                </div>
            </div>
        </div>
    </section>
  <!-- banner2 end -->
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
