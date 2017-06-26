<?php /* Template Name: QuizResult */ ?>
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

$layout = get_theme_mod('onepress_layout', 'right-sidebar');
?>
<?php echo onepress_breadcrumb(); ?>
<div id="content" class="site-content" style="border:#000 3px solid;">

    <?php
    // PHP Data Objects(PDO) Sample Code:
    $conn = mysqli_connect("127.0.0.1:52931", "azure", "6#vWHD_$");
    if (!$conn) {
        exit('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
    }
    //set the default client character set 
    mysqli_set_charset($conn, 'utf8');
    mysqli_select_db($conn, "localdb");
    global $current_user;
    get_currentuserinfo();
    $username = $current_user->user_login;
    $userID = $current_user->ID;
    $nationality = $_GET['nationality'];
    $quizID = $_GET['quizID'];
    $sql = 'SELECT questionDetail, explanation, option1, option2, option3, option4, correctAnswer FROM QUIZQUESTION WHERE nationality="' . $nationality . '" AND quizID=' . $quizID;

    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $questions[] = $row;
    }

    if (!isset($_POST['question1'])) {
        $userAnswer[0] = 'N';
    } else {
        $userAnswer[0] = $_POST['question1'];
    }
    if (!isset($_POST['question2'])) {
        $userAnswer[1] = 'N';
    } else {
        $userAnswer[1] = $_POST['question2'];
    }
    if (!isset($_POST['question3'])) {
        $userAnswer[2] = 'N';
    } else {
        $userAnswer[2] = $_POST['question3'];
    }
    if (!isset($_POST['question4'])) {
        $userAnswer[3] = 'N';
    } else {
        $userAnswer[3] = $_POST['question4'];
    }
    if (!isset($_POST['question5'])) {
        $userAnswer[4] = 'N';
    } else {
        $userAnswer[4] = $_POST['question5'];
    }
    if (!isset($_POST['question6'])) {
        $userAnswer[5] = 'N';
    } else {
        $userAnswer[5] = $_POST['question6'];
    }
    if (!isset($_POST['question7'])) {
        $userAnswer[6] = 'N';
    } else {
        $userAnswer[6] = $_POST['question7'];
    }
    if (!isset($_POST['question8'])) {
        $userAnswer[7] = 'N';
    } else {
        $userAnswer[7] = $_POST['question8'];
    }
    if (!isset($_POST['question9'])) {
        $userAnswer[8] = 'N';
    } else {
        $userAnswer[8] = $_POST['question9'];
    }
    if (!isset($_POST['question10'])) {
        $userAnswer[9] = 'N';
    } else {
        $userAnswer[9] = $_POST['question10'];
    }
    $userAnswers = '';
    for ($i = 0; $i < 10; $i++) {
        $userAnswers = $userAnswers . $userAnswer[$i];
    }


    for ($j = 0; $j < 10; $j++) {
        switch ($userAnswer[$j]) {
            case "A":
                $userAnswer[$j] = $questions[$j]["option1"];
                break;
            case "B":
                $userAnswer[$j] = $questions[$j]["option2"];
                break;
            case "C":
                $userAnswer[$j] = $questions[$j]["option3"];
                break;
            case "D":
                $userAnswer[$j] = $questions[$j]["option4"];
                break;
            default:
                $userAnswer[$j] = "Not Answered";
                break;
        }
    }
    $score = 0;
    for ($i = 0; $i < 10; $i++) {
        if ($userAnswer[$i] == $questions[$i]["correctAnswer"]) {
            $message[$i] = '';
            $tick[$i] = '&#x2714;';
            $score++;
        } else {
            $message[$i] = '&#x2718;';
            $tick[$i] = '';
        }
    }
    if ($username) {
        $insertHistory = mysqli_query($conn, "INSERT INTO userhistory (quizID, useranswers, date, username, nationality, score) VALUES ($quizID, '" . $userAnswers . "', CONVERT_TZ(NOW(),'+00:00','+10:00'), '" . $username . "', '" . $nationality . "', " . $score . ")");
        if (!$insertHistory) {
            die('Could not enter data: ' . mysql_error());
        }
    }
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>

    <script language="JavaScript" type="text/javascript">
        function window_onload() {
            var goodScore = document.getElementById('goodScore');
            var badScore = document.getElementById('badScore');
            var score = <?php echo $score; ?>;
            if (score < 6)
                badScore.style.display = "block";
            else
                goodScore.style.display = "block";
        }
        window.onload = window_onload;
    </script>

    <div id="banner-short" class="banner-short"
         style="background: url('../wp-content/themes/onepress/assets/images/banner1.jpg'); background-size: cover ">
        <div class="banner-short-caption">
            <div class="container">

                <div class="col-md-8 col-md-offset-2" data-animation-effect="fadeIn">
                    <div id="goodScore" style="display:none;" class="row" style="z-index: 1;position:absolute;margin-top:20px;padding-top:20px;"> 
                        <img  src="../wp-content/themes/onepress/assets/images/starfull.png" class="col-sm-3 img-set"/>
                        <div class="col-sm-9">
                            <h1 class="text-center">Congratulations,</h1>
                            <h2 class="text-center">you achieved <?php echo $score ?> out of 10 !</h2>
                        </div>
                        <div class="row col-lg-12 text-center" style="margin-top: 40px;">
                            <input type="button" id="nextQuiz" class="btnNormal" value="do another quiz" onclick="location.href = 'http://elawp.azurewebsites.net/common-mistakes-home/'"/>
                            <input type="button" id="history1" class="btnNormal" value="Quiz history"/>
                        </div>
                    </div>
                    <div id="badScore" style="display:none;" class="row" style="z-index: 1;position:absolute;margin-top:20px;padding-top:20px;">
                        <img  src="../wp-content/themes/onepress/assets/images/starempty.png" class="col-sm-3 img-set"/>
                        <div class="col-sm-9">
                            <h1 class="text-center">Oh,no!</h1>
                            <h2 class="text-center">You got <?php echo $score ?> out of 10 !</h2>
                        </div>
                        <div class="row col-lg-12 text-center" style="margin-top: 40px;">
                            <input type="button" id="nextQuiz" class="btnNormal" value="do another quiz" onclick="location.href = 'http://elawp.azurewebsites.net/common-mistakes-home/'"/>
                            <input type="button" id="history2" class="btnNormal" value="Quiz history" />
                        </div>
                    </div>

                    <!-- The Modal -->
                    <div id="myModal" class="modal fadeIn"  style="z-index:5; position:absolute; margin-top:20px;">
                        <!-- Modal content -->
                        <div class="modal-content text-center">
                            <span class="close">&times;</span>
                            <p>Login to track your quiz history.<br/>You can also easily login with your Facebook Accout.</p>
                            <button id="yes" type="button" class="btn-default">Yes</button>
                            <button id="cancel" type="button" class="btn-warning">Cancel</button>
                        </div>
                        <script>

                            // Get the modal
                            var modal = document.getElementById("myModal");
                            // Get the button that opens the modal
                            var btn = document.getElementById("history1");
                            // Get the <span> element that closes the modal
                            var span = document.getElementsByClassName("close")[0];
                            // Get the button that opens the modal
                            var yes = document.getElementById("yes");
                            // Get the button that opens the modal
                            var ca = document.getElementById("cancel");
                            // When the user clicks the button, open the modal 
                            btn.onclick = function () {
                                var userID = <?php echo $userID ?>;
                                if (userID == 0)
                                    modal.style.display = "block";
                                else
                                    location.href = "http://elawp.azurewebsites.net/quiz-history/";
                            };
                            yes.onclick = function () {
                                modal.style.display = "none";
                                location.href = "http://elawp.azurewebsites.net/login/";
                            };
                            // When the user clicks on <span> (x), close the modal
                            span.onclick = function () {
                                modal.style.display = "none";
                            };
                            ca.onclick = function () {
                                modal.style.display = "none";
                            };
                            // When the user clicks anywhere outside of the modal, close it
                            window.onclick = function (event) {
                                if (event.target == modal) {
                                    modal.style.display = "none";
                                }
                            };
                        </script>
                    </div>

                    <!-- The 2nd Modal -->
                    <div id="myModal2" class="modal fadeIn">
                        <!-- Modal content -->
                        <div class="modal-content text-center">
                            <span class="close">&times;</span>
                            <p>Login to track your quiz history.<br/>You can also easily login with your Facebook Accout.</p>
                            <button id="yesBtn" type="button" class="btn-default">Yes</button>
                            <button id="cancelBtn" type="button" class="btn-warning">Cancel</button>
                        </div>
                        <script>
                            // Get the modal
                            var modal2 = document.getElementById("myModal2");
                            // Get the button that opens the modal
                            var btn2 = document.getElementById("history2");
                            // Get the <span> element that closes the modal
                            var closespan2 = document.getElementsByClassName("close")[1];
                            // Get the button that opens the modal
                            var ye2 = document.getElementById("yesBtn");
                            // Get the button that opens the modal
                            var ca2 = document.getElementById("cancelBtn");
                            // When the user clicks the button, open the modal 
                            btn2.onclick = function () {
                                var userID = <?php echo $userID ?>;
                                if (userID == 0)
                                    modal2.style.display = "block";
                                else
                                    location.href = "http://elawp.azurewebsites.net/quiz-history/";
                            };
                            ye2.onclick = function () {
                                modal2.style.display = "none";
                                location.href = "http://elawp.azurewebsites.net/login/";
                            };
                            // When the user clicks on <span> (x), close the modal
                            closespan2.onclick = function () {
                                modal2.style.display = "none";
                            };
                            ca2.onclick = function () {
                                modal2.style.display = "none";
                            };
                            // When the user clicks anywhere outside of the modal, close it
                            window.onclick = function (event) {
                                if (event.target == modal2) {
                                    modal2.style.display = "none";
                                }
                            };
                        </script>
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
                <div style="width:86%;display:table;margin-left: auto;margin-right: auto;padding-left:20px;">
                    <h2 style="margin-left:-55px;">Review and Explanation</h2>

                    <div class="row review" style="margin-bottom:-10px;">
                        <div class="col-lg-1 col-xs-11 text-center">
                            <div id="diamond"><span class="qTitle"> Q&nbsp;1</span></div>
                        </div>
                        <div class="col-lg-10 col-xs-11 question">
                            <?php print_r($questions[0]["questionDetail"]); ?>
                            <h5>Your answer: <?php echo $userAnswer[0]; ?><br/>
                                Correct answer: <?php print_r($questions[0]["correctAnswer"]); ?></h5>
                        </div>
                        <div class="col-lg-1 col-xs-11 feedback text-center">
                            <span style="color: red;"><?php print_r($message[0]); ?></span>
                            <span style="color: #01DF01;"><?php print_r($tick[0]); ?></span>
                        </div>
                    </div><br/>
                    <div class="explaination">
                        <h4>Explanation:</h4><?php print_r($questions[0]["explanation"]); ?>
                    </div>

                    <div class="row review" style="margin-bottom:-10px;">
                        <div class="col-lg-1 col-xs-11 text-center">
                            <div id="diamond"><span class="qTitle"> Q&nbsp;2</span></div>
                        </div>
                        <div class="col-lg-10 col-xs-11 question">
                            <?php print_r($questions[1]["questionDetail"]); ?>
                            <h5>Your answer: <?php echo $userAnswer[1]; ?><br/>
                                Correct answer: <?php print_r($questions[1]["correctAnswer"]); ?></h5>
                        </div>
                        <div class="col-lg-1 col-xs-11 feedback text-center">
                            <span style="color: red;"><?php print_r($message[1]); ?></span>
                            <span style="color: #01DF01;"><?php print_r($tick[1]); ?></span>
                        </div>
                    </div><br/>
                    <div class="explaination">
                        <h4>Explanation:</h4><?php print_r($questions[1]["explanation"]); ?>
                    </div>

                    <div class="row review" style="margin-bottom:-10px;">
                        <div class="col-lg-1 col-xs-11 text-center">
                            <div id="diamond"><span class="qTitle"> Q&nbsp;3</span></div>
                        </div>
                        <div class="col-lg-10 col-xs-11 question">
                            <?php print_r($questions[2]["questionDetail"]); ?>
                            <h5>Your answer: <?php echo $userAnswer[2]; ?><br/>
                                Correct answer: <?php print_r($questions[2]["correctAnswer"]); ?></h5>
                        </div>
                        <div class="col-lg-1 col-xs-11 feedback text-center">
                            <span style="color: red;"><?php print_r($message[2]); ?></span>
                            <span style="color: #01DF01;"><?php print_r($tick[2]); ?></span>
                        </div>
                    </div><br/>
                    <div class="explaination">
                        <h4>Explanation:</h4><?php print_r($questions[2]["explanation"]); ?>
                    </div>

                    <div class="row review" style="margin-bottom:-10px;">
                        <div class="col-lg-1 col-xs-11 text-center">
                            <div id="diamond"><span class="qTitle"> Q&nbsp;4</span></div>
                        </div>
                        <div class="col-lg-10 col-xs-11 question">
                            <?php print_r($questions[3]["questionDetail"]); ?>
                            <h5>Your answer: <?php echo $userAnswer[3]; ?><br/>Correct answer: <?php print_r($questions[3]["correctAnswer"]); ?></h5>
                        </div>
                        <div class="col-lg-1 col-xs-11 feedback text-center">
                            <span style="color: red;"><?php print_r($message[3]); ?></span><span style="color: #01DF01;"><?php print_r($tick[3]); ?></span>
                        </div>
                    </div><br/>
                    <div class="explaination">
                        <h4>Explanation:</h4><?php print_r($questions[3]["explanation"]); ?>
                    </div>


                    <div class="row review" style="margin-bottom:-10px;">
                        <div class="col-lg-1 col-xs-11 text-center">
                            <div id="diamond"><span class="qTitle"> Q&nbsp;5</span></div>
                        </div>
                        <div class="col-lg-10 col-xs-11 question">
                            <?php print_r($questions[4]["questionDetail"]); ?>
                            <h5>Your answer: <?php echo $userAnswer[4]; ?><br/>
                                Correct answer: <?php print_r($questions[4]["correctAnswer"]); ?></h5>
                        </div>
                        <div class="col-lg-1 col-xs-11 feedback text-center">
                            <span style="color: red;"><?php print_r($message[4]); ?></span>
                            <span style="color: #01DF01;"><?php print_r($tick[4]); ?></span>
                        </div>
                    </div><br/>
                    <div class="explaination">
                        <h4>Explanation:</h4><?php print_r($questions[4]["explanation"]); ?>
                    </div>


                    <div class="row review" style="margin-bottom:-10px;">
                        <div class="col-lg-1 col-xs-11 text-center">
                            <div id="diamond"><span class="qTitle"> Q&nbsp;6</span></div>
                        </div>
                        <div class="col-lg-10 col-xs-11 question">
                            <?php print_r($questions[5]["questionDetail"]); ?>
                            <h5>Your answer: <?php echo $userAnswer[5]; ?><br/>
                                Correct answer: <?php print_r($questions[5]["correctAnswer"]); ?></h5>
                        </div>
                        <div class="col-lg-1 col-xs-11 feedback text-center">
                            <span style="color: red;"><?php print_r($message[5]); ?></span>
                            <span style="color: #01DF01;"><?php print_r($tick[5]); ?></span>
                        </div>
                    </div><br/>
                    <div class="explaination">
                        <h4>Explanation:</h4><?php print_r($questions[5]["explanation"]); ?>
                    </div>


                    <div class="row review" style="margin-bottom:-10px;">
                        <div class="col-lg-1 col-xs-11 text-center">
                            <div id="diamond"><span class="qTitle"> Q&nbsp;7</span></div>
                        </div>
                        <div class="col-lg-10 col-xs-11 question">
                            <?php print_r($questions[6]["questionDetail"]); ?>
                            <h5>Your answer: <?php echo $userAnswer[6]; ?><br/>
                                Correct answer: <?php print_r($questions[6]["correctAnswer"]); ?></h5>
                        </div>
                        <div class="col-lg-1 col-xs-11 feedback text-center">
                            <span style="color: red;"><?php print_r($message[6]); ?></span>
                            <span style="color: #01DF01;"><?php print_r($tick[6]); ?></span>
                        </div>
                    </div><br/>
                    <div class="explaination">
                        <h4>Explanation:</h4><?php print_r($questions[6]["explanation"]); ?>
                    </div>


                    <div class="row review" style="margin-bottom:-10px;">
                        <div class="col-lg-1 col-xs-11 text-center">
                            <div id="diamond"><span class="qTitle"> Q&nbsp;8</span></div>
                        </div>
                        <div class="col-lg-10 col-xs-11 question">
                            <?php print_r($questions[7]["questionDetail"]); ?>
                            <h5>Your answer: <?php echo $userAnswer[7]; ?><br/>
                                Correct answer: <?php print_r($questions[7]["correctAnswer"]); ?></h5>
                        </div>
                        <div class="col-lg-1 col-xs-11 feedback text-center">
                            <span style="color: red;"><?php print_r($message[7]); ?></span>
                            <span style="color: #01DF01;"><?php print_r($tick[7]); ?></span>
                        </div>
                    </div><br/>
                    <div class="explaination">
                        <h4>Explanation:</h4><?php print_r($questions[7]["explanation"]); ?>
                    </div>

                    <div class="row review" style="margin-bottom:-10px;">
                        <div class="col-lg-1 col-xs-11 text-center">
                            <div id="diamond"><span class="qTitle"> Q&nbsp;9</span></div>
                        </div>
                        <div class="col-lg-10 col-xs-11 question">
                            <?php print_r($questions[8]["questionDetail"]); ?>
                            <h5>Your answer: <?php echo $userAnswer[8]; ?><br/>
                                Correct answer: <?php print_r($questions[8]["correctAnswer"]); ?></h5>
                        </div>
                        <div class="col-lg-1 col-xs-11 feedback text-center">
                            <span style="color: red;"><?php print_r($message[8]); ?></span>
                            <span style="color: #01DF01;"><?php print_r($tick[8]); ?></span>
                        </div>
                    </div><br/>
                    <div class="explaination">
                        <h4>Explanation:</h4><?php print_r($questions[8]["explanation"]); ?>
                    </div>

                    <div class="row review" style="margin-bottom:-10px;">
                        <div class="col-lg-1 col-xs-11 text-center">
                            <div id="diamond"><span class="qTitle"> Q10</span></div>
                        </div>
                        <div class="col-lg-10 col-xs-11 question">
                            <?php print_r($questions[9]["questionDetail"]); ?>
                            <h5>Your answer: <?php echo $userAnswer[9]; ?><br/>
                                Correct answer: <?php print_r($questions[9]["correctAnswer"]); ?></h5>
                        </div>
                        <div class="col-lg-1 col-xs-11 feedback text-center">
                            <span style="color: red;"><?php print_r($message[9]); ?></span>
                            <span style="color: #01DF01;"><?php print_r($tick[9]); ?></span>
                        </div>
                    </div><br/>
                    <div class="explaination">
                        <h4>Explanation:</h4><?php print_r($questions[9]["explanation"]); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jquery and Bootstap core js files -->
    <script type="text/javascript" src="plugins/jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <!--Modernizr javascript -->
    <script type="text/javascript" src="plugins/modernizr.js"></script>

    <!--Isotope javascript -->
    <script type="text/javascript" src="plugins/isotope/isotope.pkgd.min.js"></script>

    <!--Backstretch javascript--> 
    <script type="text/javascript" src="plugins/jquery.backstretch.min.js"></script>

    <!--Appear javascript--> 
    <script type="text/javascript" src="plugins/jquery.appear.js"></script>

    <!--Initialization of Plugins--> 
    <script type="text/javascript" src="js/Homepage.js"></script>

    <!--Custom Scripts--> 
    <script type="text/javascript" src="js/custom.js"></script>

    <?php if ($layout != 'no-sidebar') { ?>
        <?php get_sidebar(); ?>
    <?php } ?>

    <!--<div>#content-inside -->
</div><!-- #content -->

<?php get_footer(); ?>