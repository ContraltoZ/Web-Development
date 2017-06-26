<?php /* Template Name: QuizHistory */ ?>
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
<div id="content" class="site-content">
    <div id="content-inside" class="container <?php echo esc_attr($layout); ?>">
        <div id="primary" class="content-area">
            <!-- expand jquery -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

            <?php
            // PHP Data Objects(PDO) Sample Code:
            $conn = mysqli_connect("127.0.0.1:52931", "azure", "6#vWHD_$");
            if (!$conn) {
                exit('Connect Error (' . mysqli_connect_errno() . ') '
                        . mysqli_connect_error());
            }
            //set the default client character set 
            mysqli_set_charset($conn, 'utf-8');
            mysqli_select_db($conn, "localdb");
            global $current_user;
            get_currentuserinfo();
            $username = $current_user->user_login;

            //retrive data from UserHistory table in database
            $historySql = "SELECT quizID, useranswers, date, nationality, score FROM UserHistory WHERE username='" . $username . "'";
            $historyResult = mysqli_query($conn, $historySql);
            while ($row = mysqli_fetch_array($historyResult)) {
                $histories[] = $row;
            }

            //get the number of history records 
            $historyNum = mysqli_num_rows($historyResult);

            //close the connection
            mysqli_free_result($historyResult);
            ?>
            <script language="JavaScript" type="text/javascript">
                window.onload = function () {
                    var hasHist = document.getElementById('hasHistory');
                    var noHist = document.getElementById('noHistory');
                    var hisNum = <?php echo $historyNum ?>;
                    if (hisNum > 0) {
                        hasHist.style.display = "block";
                    }
                    else{
                        noHist.style.display = "block";
                        sect.style.display = "none";
                    }
                }
            </script>
            <!-- ================ -->
            <!-- banner start -->
            <!-- ================ -->

            <div id="banner-short" class="banner-short" 
                 style="background: url('../wp-content/themes/onepress/assets/images/banner1.png'); background-size: cover ">
                <div class="banner-short-caption">
                    <div class="container">
                        <div class="col-md-8 col-md-offset-2" data-animation-effect="fadeIn">
                            <div class="row" id="hasHistory" style="display: none;">
                                <h2>Hi <?php echo $username; ?>.</h2><br/>
                                <h3> Here is your quiz history:</h3>
                            </div>
                            <div class="row" id="noHistory" style="display: none;">
                                <h2>Hi, <?php echo $username; ?>.</h2><br/>
                                <h3> You have not attempted a common mistakes quiz yet.<br/>
                                    <a href='common-mistakes-home' style="color:blue;">
                                        Try a quiz </a>now!</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner end -->

            <section>
                <div id="sect" class="col-lg-12" style="background-color: lightgray; padding: 5px; size: auto; border-radius:30px;">
                    <div class="container">
                        <div style="width:92%;display:table;margin-left: auto;margin-right: auto;padding-left:20px;">

                            <!-- expandable panel start -->
                            <!-- output histories one by one -->
                            <?php
                            for ($i = 0; $i < $historyNum; $i++) {
                                //retrive data from QUIZQUESTION table in database
                                $nationality = $histories[$i]['nationality'];
                                $quizID = $histories[$i]['quizID'];
                                $questionSql = "SELECT questionDetail, option1, option2, option3, option4, explanation, correctAnswer FROM QUIZQUESTION WHERE quizID=" . $quizID . " AND nationality='" . $nationality . "'";

                                $questionResult = mysqli_query($conn, $questionSql);

                                while ($row = mysqli_fetch_array($questionResult)) {
                                    $questions[] = $row;
                                }

                                mysqli_free_result($questionResult);
                                //replace the simple answers with full option express
                                for ($j = 0; $j < 10; $j++) {
                                    switch ($histories[$i]["useranswers"][$j]) {
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

                                //mark the wrong answer with a cross and mark the right answer with a tick
                                for ($j = 0; $j < 10; $j++) {
                                    if ($userAnswer[$j] == $questions[$j]["correctAnswer"]) {
                                        $message[$j] = '';
                                        $tick[$j] = '&#x2714;';
                                        $score++;
                                    } else {
                                        $message[$j] = '&#x2718;';
                                        $tick[$j] = '';
                                    }
                                }

                                // output all the quiz questions and the answers that users made
                                echo '
                                  <div class="panel-group" >
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                 <a data-toggle="collapse" href="#collapse' . $i . '">
                                                    <div class="col-md-3 col-sm-6 col-xs-12 collapseTitle"><span>&nbsp;Quiz Type:</span><br/>' . $histories[$i]['nationality'] . '</div>
                                                    <div class="col-md-3 col-sm-6 col-xs-12 collapseTitle"><span>Set No:</span><br/>' . $histories[$i]['quizID'] . '</div>
                                                    <div class="col-md-3 col-sm-6 col-xs-12 collapseTitle"><span>Date Completed:</span><br/>' . substr($histories[$i]["date"], 0, 10) . '</div>
                                                    <div class="col-md-3 col-sm-6 col-xs-12 collapseTitle"><span>Time Completed:</span><br/>' . substr($histories[$i]["date"], 10) . '</div>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id = "collapse' . $i . '" class = "panel-collapse collapse">
                                             <div class = "panel-body">
                                                <h4>Your Score:  ' . $histories[$i]['score'] . '</h4>';

                                //the question 1 details
                                echo '<div class="row review" style="margin-bottom:-5px;">
                                    <div class="col-lg-1 col-xs-11 text-center">
                                       <div id="diamond"><span class="qTitle"> Q&nbsp;1</span></div>
                                    </div>
                                    <div class="col-lg-10 col-xs-11 question">';
                                print_r($questions[0]["questionDetail"]);
                                echo '<br/><span class="review">Your answer: ' . $userAnswer[0] . '
                                        <br/>Correct answer: ';
                                print_r($questions[0]["correctAnswer"]);
                                echo '</span>
                                    </div>
                                    <div class="col-lg-1 col-xs-11 feedback text-center">
                                        <span class="cross">';
                                print_r($message[0]);
                                echo '</span>
                                        <span class="tick">';
                                print_r($tick[0]);
                                echo '</span>
                            </div>
                                </div><br/>
                        <div class="explaination">
                            <h4>Explanation:</h4>';
                                print_r($questions[0]["explanation"]);
                                echo '
                        </div>';

                                //the question 2 details
                                echo '<div class="row review" style="margin-bottom:-10px;">
                                    <div class="col-lg-1 col-xs-11 text-center">
                                       <div id="diamond"><span class="qTitle">Q&nbsp;2</span></div>
                                    </div>
                                    <div class="col-lg-10 col-xs-11 question">';
                                print_r($questions[1]["questionDetail"]);
                                echo '<h5>Your answer: ' . $userAnswer[1] . '<br/>
                                        Correct answer: ';
                                print_r($questions[1]["correctAnswer"]);
                                echo '</h5>
                                    </div>
                                    <div class="col-lg-1 col-xs-11 feedback text-center">
                                        <span style="color: red;">';
                                print_r($message[1]);
                                echo '</span>
                                        <span style="color: #01DF01;">';
                                print_r($tick[1]);
                                echo '</span>
                            </div>
                        </div><br/>
                        <div class="explaination">
                            <h4>Explanation:</h4>';
                                print_r($questions[1]["explanation"]);
                                echo '
                        </div>';

                                //the question 3 details
                                echo '<div class="row review" style="margin-bottom:-10px;">
                                    <div class="col-lg-1 col-xs-11 text-center">
                                       <div id="diamond"><span class="qTitle">Q&nbsp;3</span></div>
                                    </div>
                                    <div class="col-lg-10 col-xs-11 question">';
                                print_r($questions[2]["questionDetail"]);
                                echo '<h5>Your answer: ' . $userAnswer[2] . '<br/>
                                        Correct answer: ';
                                print_r($questions[2]["correctAnswer"]);
                                echo '</h5>
                                    </div>
                                    <div class="col-lg-1 col-xs-11 feedback text-center">
                                        <span style="color: red;">';
                                print_r($message[2]);
                                echo '</span>
                                        <span style="color: #01DF01;">';
                                print_r($tick[2]);
                                echo '</span>
                            </div>
                        </div><br/>
                        <div class="explaination">
                            <h4>Explanation:</h4>';
                                print_r($questions[2]["explanation"]);
                                echo '
                        </div>';

                                //the question 4 details
                                echo '<div class="row review" style="margin-bottom:-10px;">
                                    <div class="col-lg-1 col-xs-11 text-center">
                                       <div id="diamond"><span class="qTitle">Q&nbsp;4</span></div>
                                    </div>
                                    <div class="col-lg-10 col-xs-11 question">';
                                print_r($questions[3]["questionDetail"]);
                                echo '<h5>Your answer: ' . $userAnswer[3] . '<br/>
                                        Correct answer: ';
                                print_r($questions[3]["correctAnswer"]);
                                echo '</h5>
                                    </div>
                                    <div class="col-lg-1 col-xs-11 feedback text-center">
                                        <span style="color: red;">';
                                print_r($message[3]);
                                echo '</span>
                                        <span style="color: #01DF01;">';
                                print_r($tick[3]);
                                echo '</span>
                            </div>
                        </div><br/>
                        <div class="explaination">
                            <h4>Explanation:</h4>';
                                print_r($questions[3]["explanation"]);
                                echo '
                        </div>';

                                //the question 5 details
                                echo '<div class="row review" style="margin-bottom:-10px;">
                                    <div class="col-lg-1 col-xs-11 text-center">
                                       <div id="diamond"><span class="qTitle">Q&nbsp;5</span></div>
                                    </div>
                                    <div class="col-lg-10 col-xs-11 question">';
                                print_r($questions[4]["questionDetail"]);
                                echo '<h5>Your answer: ' . $userAnswer[4] . '<br/>
                                        Correct answer: ';
                                print_r($questions[4]["correctAnswer"]);
                                echo '</h5>
                                    </div>
                                    <div class="col-lg-1 col-xs-11 feedback text-center">
                                        <span style="color: red;">';
                                print_r($message[4]);
                                echo '</span>
                                        <span style="color: #01DF01;">';
                                print_r($tick[4]);
                                echo '</span>
                            </div>
                        </div><br/>
                        <div class="explaination">
                            <h4>Explanation:</h4>';
                                print_r($questions[4]["explanation"]);
                                echo '
                        </div>';

                                //the question 6 details
                                echo '<div class="row review" style="margin-bottom:-10px;">
                                    <div class="col-lg-1 col-xs-11 text-center">
                                       <div id="diamond"><span class="qTitle"> Q&nbsp;6</span></div>
                                    </div>
                                    <div class="col-lg-10 col-xs-11 question">';
                                print_r($questions[5]["questionDetail"]);
                                echo '<h5>Your answer: ' . $userAnswer[5] . '<br/>
                                        Correct answer: ';
                                print_r($questions[5]["correctAnswer"]);
                                echo '</h5>
                                    </div>
                                    <div class="col-lg-1 col-xs-11 feedback text-center">
                                        <span style="color: red;">';
                                print_r($message[5]);
                                echo '</span>
                                        <span style="color: #01DF01;">';
                                print_r($tick[5]);
                                echo '</span>
                            </div>
                        </div><br/>
                        <div class="explaination">
                            <h4>Explanation:</h4>';
                                print_r($questions[5]["explanation"]);
                                echo '
                        </div>';

                                //the question 7 details
                                echo '<div class="row review" style="margin-bottom:-10px;">
                                    <div class="col-lg-1 col-xs-11 text-center">
                                       <div id="diamond"><span class="qTitle"> Q&nbsp;7</span></div>
                                    </div>
                                    <div class="col-lg-10 col-xs-11 question">';
                                print_r($questions[6]["questionDetail"]);
                                echo '<h5>Your answer: ' . $userAnswer[6] . '<br/>
                                        Correct answer: ';
                                print_r($questions[6]["correctAnswer"]);
                                echo '</h5>
                                    </div>
                                    <div class="col-lg-1 col-xs-11 feedback text-center">
                                        <span style="color: red;">';
                                print_r($message[6]);
                                echo '</span>
                                        <span style="color: #01DF01;">';
                                print_r($tick[6]);
                                echo '</span>
                            </div>
                        </div><br/>
                        <div class="explaination">
                            <h4>Explanation:</h4>';
                                print_r($questions[6]["explanation"]);
                                echo '
                        </div>';

                                //the question 8 details
                                echo '<div class="row review" style="margin-bottom:-10px;">
                                    <div class="col-lg-1 col-xs-11 text-center">
                                       <div id="diamond"><span class="qTitle"> Q&nbsp;8</span></div>
                                    </div>
                                    <div class="col-lg-10 col-xs-11 question">';
                                print_r($questions[7]["questionDetail"]);
                                echo '<h5>Your answer: ' . $userAnswer[7] . '<br/>
                                        Correct answer: ';
                                print_r($questions[7]["correctAnswer"]);
                                echo '</h5>
                                    </div>
                                    <div class="col-lg-1 col-xs-11 feedback text-center">
                                        <span style="color: red;">';
                                print_r($message[7]);
                                echo '</span>
                                        <span style="color: #01DF01;">';
                                print_r($tick[7]);
                                echo '</span>
                            </div>
                        </div><br/>
                        <div class="explaination">
                            <h4>Explanation:</h4>';
                                print_r($questions[7]["explanation"]);
                                echo '
                        </div>';

                                //the question 9 details
                                echo '<div class="row review" style="margin-bottom:-10px;">
                                    <div class="col-lg-1 col-xs-11 text-center">
                                       <div id="diamond"><span class="qTitle"> Q&nbsp;9</span></div>
                                    </div>
                                    <div class="col-lg-10 col-xs-11 question">';
                                print_r($questions[8]["questionDetail"]);
                                echo '<h5>Your answer: ' . $userAnswer[8] . '<br/>
                                        Correct answer: ';
                                print_r($questions[8]["correctAnswer"]);
                                echo '</h5>
                                    </div>
                                    <div class="col-lg-1 col-xs-11 feedback text-center">
                                        <span style="color: red;">';
                                print_r($message[8]);
                                echo '</span>
                                        <span style="color: #01DF01;">';
                                print_r($tick[8]);
                                echo '</span>
                            </div>
                        </div><br/>
                        <div class="explaination">
                            <h4>Explanation:</h4>';
                                print_r($questions[8]["explanation"]);
                                echo '
                        </div>';

                                //the question 10 details
                                echo '<div class="row review" style="margin-bottom:-10px;">
                                    <div class="col-lg-1 col-xs-11 text-center">
                                       <div id="diamond"><span class="qTitle"> Q&nbsp;10</span></div>
                                    </div>
                                    <div class="col-lg-10 col-xs-11 question">';
                                print_r($questions[9]["questionDetail"]);
                                echo '<h5>Your answer: ' . $userAnswer[9] . '<br/>
                                        Correct answer: ';
                                print_r($questions[9]["correctAnswer"]);
                                echo '</h5>
                                    </div>
                                    <div class="col-lg-1 col-xs-11 feedback text-center">
                                        <span style="color: red;">';
                                print_r($message[9]);
                                echo '</span>
                                        <span style="color: #01DF01;">';
                                print_r($tick[9]);
                                echo '</span>
                            </div>
                        </div><br/>
                        <div class="explaination">
                            <h4>Explanation:</h4>';
                                print_r($questions[9]["explanation"]);
                                echo '
                        </div>';
                                echo '</div></div></div></div>';
                            }

                            //close the connection
                            mysqli_close($conn);
                            ?>
                        </div>
                        <!-- expandable panel end -->
                        <!-- ================ -->
                    </div>
                </div>
            </section>


        </div><!-- #primary -->
        <?php if ($layout != 'no-sidebar') { ?>
            <?php get_sidebar(); ?>
        <?php } ?>

    </div><!-- #content inside -->
</div><!-- #content -->
<?php get_footer(); ?>