<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/NavigationFooter.css">
    <link rel="stylesheet" type="text/css" href="css/quizStyle.css">
            
    <link rel="stylesheet" type="text/css" href="css/common.css" />
</head>
<body  class="no-trans">
    <?php require 'menu.php';?> 
<!-- ================ -->
<!-- banner start -->
<!-- ================ -->
<div class="row text-center col-lg-12" style="background-image: url('img/quiz/bg-grid.jpg'); background-repeat: repeat; overflow: auto;">
                <div class="container"  style="padding:130px 0; width: 100%; z-index: 2;">
                    <div class="col-md-8 col-md-offset-2">

                    <h1 class="text-center">WELCOME</h1>
                    <p class="lead text-center">Please select a stage to begin quiz.</p>
                    
                    <div id="wrapper">
                        <div class="row text-center" style="margin: 0 auto; padding-left: 40px;">
                            
                            <div class="col-lg-2 col-md-3 col-sm-5 col-xs-6" style="margin: 0 12px;">
                                <div class="div-square" onclick="location.href='quiz.php'">
                                    Quiz<h3>01</h3>
                                </div>
                            </div> 

                            <div class="col-lg-2 col-md-3 col-sm-5 col-xs-6"style="margin: 0 12px;">
                                <div class="div-lockSquare" Title="Finish stage 01 to unlock">
                                    Quiz<h3>02</h3>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-5 col-xs-6"style=" margin: 0 12px;">
                                <div class="div-lockSquare" Title="login to unlock" >
                                    Quiz<h3>03</h3>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-5 col-xs-6"style="margin: 0 12px;">
                                <div class="div-lockSquare" Title="login to unlock">
                                    Quiz<h3>04</h3>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-5 col-xs-6"style="margin: 0 12px;">
                                <div class="div-lockSquare" Title="login to unlock">
                                    Quiz<h3>05</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--</div>-->
        <!-- /. ROW  -->   
        <?php include 'footer.php';?>
        
        <!-- Appear javascript -->
        <script type="text/javascript" src="plugins/jquery.appear.js"></script>

        <!-- Initialization of Plugins -->
        <script type="text/javascript" src="js/Homepage.js"></script>
        <script type="text/javascript" src="plugins/jquery.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
