<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Quiz History</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/common.css" />
        <link rel="stylesheet" type="text/css" href="css/ResultHistory.css" />
        <!-- expand jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <!-- Bootstrap core CSS -->  
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/NavigationFooter.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body class="no-trans" >
        <!--import menu for this page-->
        <?php require 'menu.php'; ?>   
        <?php
        //    create connection to database
        $con = mysqli_connect("localhost", "id1242423_phpuser", "phpuserpw");
        if (!$con) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
        //set the default client character set 
        mysqli_set_charset($con, 'utf-8');

        mysqli_select_db($con, "id1242423_iel1");
        $username = $_GET['username'];
        
        //retrive data from UserHistory table in database
        $historySql = "SELECT quizID, useranswers, date, nationality, score FROM UserHistory WHERE username='" . $username . "'";
        $historyResult = mysqli_query($con, $historySql);
        while ($row = mysqli_fetch_array($historyResult)) {
            $histories[] = $row;
        }
        //get the number of history records 
        $historyNum = mysqli_num_rows($historyResult);
        //close the connection
        mysqli_free_result($historyResult);
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
                            <h2>Hi, <?php echo $username; ?>.</h2><br/>
                            <h3> Here is your common mistake quiz history</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner end -->

        <section>
            <div class="col-lg-12" style="background-color: lightgray; padding: 5px; size: auto">
                <div class="container">
                    <div style="width:86%;display:table;margin-left: auto;margin-right: auto;padding-left:20px;">

                        <!-- expandable panel start -->
                        <!-- output histories one by one -->
                        <?php
                        for ($i = 0; $i < $historyNum; $i++) {
                            //retrive data from QUIZQUESTION table in database
                            $nationality = $histories[$i]['nationality'];
                            $quizID = $histories[$i]['quizID'];
                            $questionSql = "SELECT questionDetail, option1, option2, option3, option4, explanation, correctAnswer FROM QUIZQUESTION WHERE quizID=".$quizID." AND nationality='".$nationality."'";

                            $questionResult[$i] = mysqli_query($con, $questionSql);

                            while ($row = mysqli_fetch_array($questionResult[$i])) {
                                $questions[] = $row;
                            }
                            mysqli_free_result($questionResult[$i]);
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
                            // output all the quiz questions and the answers that users made
                            echo '<div class="row" style="margin:10px 0 -4px 0;font-size:11px;color:grey;"><div class="col-lg-3">&nbsp;&nbsp;&nbsp;&nbsp;Language:</div><div class="col-lg-3">Set No:</div>
                                  <div class="col-lg-3">Complete Date:</div><div class="col-lg-3">Complete Time:</div></div>
                                  <div class="panel-group" style="margin:4px 0;" >
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a style="background-color:grey; color:#ffd966;"data-toggle="collapse" href="#collapse' . $i . '">
                                                    <div class="col-lg-3">' . $histories[$i]['nationality'] . '</div><div class="col-lg-3">' . $histories[$i]['quizID'] . '
                                                    </div><div class="col-lg-3">' . substr($histories[$i]["date"],0,10) . '</div><div class="col-lg-3">&nbsp;&nbsp;&nbsp;&nbsp;' . substr($histories[$i]["date"],10) . '</div>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id = "collapse' . $i . '" class = "panel-collapse collapse">
                                             <div class = "panel-body">
                                                <h4>Your Score:  ' .$histories[$i]['score']. '</h4>';
                            
                            //the question 1 details
                            echo '<div class="row review" style="margin-bottom:-10px;">
                                    <div class="col-lg-1 col-xs-11 text-center">
                                       <div id="diamond"><p class="qTitle"> Q&nbsp;1</p></div>
                                    </div>
                                    <div class="col-lg-10 col-xs-11 question">';
                                        print_r($questions[0]["questionDetail"]);
                                        echo  '<h5>Your answer: '. $userAnswer[0] .'<br/>
                                        Correct answer: '; print_r($questions[0]["correctAnswer"]); echo '</h5>
                                    </div>
                                    <div class="col-lg-1 col-xs-11 feedback text-center">
                                        <span style="color: red;">'; print_r($message[0]); echo '</span>
                                        <span style="color: #01DF01;">'; print_r($tick[0]); echo '</span>
                            </div>
                        </div><br/>
                        <div class="explaination">
                            <h4>Explanation:</h4>'; print_r($questions[0]["explanation"]); echo '
                        </div></div>';
                            
                            //the question 2 details
                            echo '<div style = "background-color: #595959; padding:8px 15px; size: auto; color: whitesmoke; margin: 10px 0;border-radius: 10px;">';
                            echo '<h4>Question 2<br/>';
                            print_r($questions[1]["questionDetail"]);
                            echo '</h4>';
                            echo '<h5>Your answer: ' . $userAnswer[1] . '<br/>Correct answer: ';
                            print_r($questions[1]["correctAnswer"]);
                            echo '<br/><br/>';
                            echo 'Explanation:<br/>';
                            print_r($questions[1]["explanation"]);
                            echo '</h5></div>';
                            
                            //the question 3 details
                            echo '<div style = "background-color: #595959; padding:8px 15px; size: auto; color: whitesmoke; margin: 10px 0;border-radius: 10px;">';
                            echo '<h4>Question 3<br/>';
                            print_r($questions[2]["questionDetail"]);
                            echo '</h4>';
                            echo '<h5>Your answer: ' . $userAnswer[2] . '<br/>Correct answer: ';
                            print_r($questions[2]["correctAnswer"]);
                            echo '<br/><br/>';
                            echo 'Explanation:<br/>';
                            print_r($questions[2]["explanation"]);
                            echo '</h5></div>';
                            
                            //the question 4 details
                            echo '<div style = "background-color: #595959; padding:8px 15px; size: auto; color: whitesmoke; margin: 10px 0;border-radius: 10px;">';
                            echo '<h4>Question 4<br/>';
                            print_r($questions[3]["questionDetail"]);
                            echo '</h4>';
                            echo '<h5>Your answer: ' . $userAnswer[3] . '<br/>Correct answer: ';
                            print_r($questions[3]["correctAnswer"]);
                            echo '<br/><br/>';
                            echo 'Explanation:<br/>';
                            print_r($questions[3]["explanation"]);
                            echo '</h5></div>';

                            //the question 5 details
                            echo '<div style = "background-color: #595959; padding:8px 15px; size: auto; color: whitesmoke; margin: 10px 0;border-radius: 10px;">';
                            echo '<h4>Question 5<br/>';
                            print_r($questions[4]["questionDetail"]);
                            echo '</h4>';
                            echo '<h5>Your answer: ' . $userAnswer[4] . '<br/>Correct answer: ';
                            print_r($questions[4]["correctAnswer"]);
                            echo '<br/><br/>';
                            echo 'Explanation:<br/>';
                            print_r($questions[4]["explanation"]);
                            echo '</h5></div>';

                            //the question 6 details
                            echo '<div style = "background-color: #595959; padding:8px 15px; size: auto; color: whitesmoke; margin: 10px 0;border-radius: 10px;">';
                            echo '<h4>Question 6<br/>';
                            print_r($questions[5]["questionDetail"]);
                            echo '</h4>';
                            echo '<h5>Your answer: ' . $userAnswer[5] . '<br/>Correct answer: ';
                            print_r($questions[5]["correctAnswer"]);
                            echo '<br/><br/>';
                            echo 'Explanation:<br/>';
                            print_r($questions[5]["explanation"]);
                            echo '</h5></div>';

                            //the question 7 details
                            echo '<div style = "background-color: #595959; padding:8px 15px; size: auto; color: whitesmoke; margin: 10px 0;border-radius: 10px;">';
                            echo '<h4>Question 7<br/>';
                            print_r($questions[6]["questionDetail"]);
                            echo '</h4>';
                            echo '<h5>Your answer: ' . $userAnswer[6] . '<br/>Correct answer: ';
                            print_r($questions[6]["correctAnswer"]);
                            echo '<br/><br/>';
                            echo 'Explanation:<br/>';
                            print_r($questions[6]["explanation"]);
                            echo '</h5></div>';

                            //the question 8 details
                            echo '<div style = "background-color: #595959; padding:8px 15px; size: auto; color: whitesmoke; margin: 10px 0;border-radius: 10px;">';
                            echo '<h4>Question 8<br/>';
                            print_r($questions[7]["questionDetail"]);
                            echo '</h4>';
                            echo '<h5>Your answer: ' . $userAnswer[7] . '<br/>Correct answer: ';
                            print_r($questions[7]["correctAnswer"]);
                            echo '<br/><br/>';
                            echo 'Explanation:<br/>';
                            print_r($questions[7]["explanation"]);
                            echo '</h5></div>';

                            //the question 9 details
                            echo '<div style = "background-color: #595959; padding:8px 15px; size: auto; color: whitesmoke; margin: 10px 0;border-radius: 10px;">';
                            echo '<h4>Question 9<br/>';
                            print_r($questions[8]["questionDetail"]);
                            echo '</h4>';
                            echo '<h5>Your answer: ' . $userAnswer[8] . '<br/>Correct answer: ';
                            print_r($questions[8]["correctAnswer"]);
                            echo '<br/><br/>';
                            echo 'Explanation:<br/>';
                            print_r($questions[8]["explanation"]);
                            echo '</h5></div>';

                            //the question 10 details
                            echo '<div style = "background-color: #595959; padding:8px 15px; size: auto; color: whitesmoke; margin: 10px 0;border-radius: 10px;">';
                            echo '<h4>Question 10<br/>';
                            print_r($questions[9]["questionDetail"]);
                            echo '</h4>';
                            echo '<h5>Your answer: ' . $userAnswer[9] . '<br/>Correct answer: ';
                            print_r($questions[9]["correctAnswer"]);
                            echo '<br/><br/>';
                            echo 'Explanation:<br/>';
                            print_r($questions[9]["explanation"]);
                            echo '</h5></div>';

                            echo '</div></div></div>';
                            
                        }
                        
                        //close the connection
                        mysqli_close($con);
                        ?>
                    </div>
                    <!-- expandable panel end -->
                    <!-- ================ -->
                </div>
            </div>
        </section>
        <!--        import footer for this page-->
        <?php include 'footer.php'; ?>
    </body>
</html>