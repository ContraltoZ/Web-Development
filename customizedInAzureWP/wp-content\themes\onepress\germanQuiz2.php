<?php /* Template Name: GermanMistakeQuiz2 */ ?>
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
<div id="content" class="site-content quiz-content">

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
    $sql = "SELECT questionDetail, option1, option2, option3, option4 FROM QUIZQUESTION WHERE nationality='German' AND quizID=2";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $quiz[] = $row;
    }
    //close the connection
    mysqli_free_result($result);
    mysqli_close($con);
    ?>

    <form method="post" action="../quizresult?quizID=2&nationality=German">
        <div class="row text-center col-lg-12">
            <div id="timeline">
                <ul id="dates">
                    <li><a href="#1900">Q.1</a></li>
                    <li><a href="#1930">Q.2</a></li>
                    <li><a href="#1944">Q.3</a></li>
                    <li><a href="#1950">Q.4</a></li>
                    <li><a href="#1971">Q.5</a></li>
                    <li><a href="#1977">Q.6</a></li>
                    <li><a href="#1989">Q.7</a></li>
                    <li><a href="#1999">Q.8</a></li>
                    <li><a href="#2001">Q.9</a></li>
                    <li><a href="#2002">Q.10</a></li>
                    <li></li>
                </ul>
                <ul id="issues">                        
                    <li id="Q1">
                        <h1>Question 1</h1>
                        <p><?php print_r($quiz[0]["questionDetail"]); ?></p>
                        <h4><label style="margin:5px;"><input type="radio" name="question1" value="A">
                            <?php print_r($quiz[0]["option1"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question1" value="B">
                            <?php print_r($quiz[0]["option2"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question1" value="C">
                            <?php print_r($quiz[0]["option3"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question1" value="D">
                            <?php print_r($quiz[0]["option4"]); ?></label>
                        </h4>
                    </li>
                    <li id="Q2">
                        <h1>Question 2</h1>
                        <p><?php print_r($quiz[1]["questionDetail"]); ?></p>
                        <h4><label style="margin:5px;"><input type="radio" name="question2" value="A">
                            <?php print_r($quiz[1]["option1"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question2" value="B">
                            <?php print_r($quiz[1]["option2"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question2" value="C">
                            <?php print_r($quiz[1]["option3"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question2" value="D">
                            <?php print_r($quiz[1]["option4"]); ?></label>
                        </h4>
                    </li>
                    <li id="Q3">
                        <h1>Question 3</h1>
                        <p><?php print_r($quiz[2]["questionDetail"]); ?></p>
                        <h4><label style="margin:5px;"><input type="radio" name="question3" value="A">
                            <?php print_r($quiz[2]["option1"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question3" value="B">
                            <?php print_r($quiz[2]["option2"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question3" value="C">
                            <?php print_r($quiz[2]["option3"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question3" value="D">
                            <?php print_r($quiz[2]["option4"]); ?></label>
                        </h4>
                    </li>
                    <li id="Q4">
                        <h1>Question 4</h1>
                        <p><?php print_r($quiz[3]["questionDetail"]); ?></p>
                        <h4><label style="margin:5px;"><input type="radio" name="question4" value=<?php print_r($quiz[3]["option1"]); ?> >
                            <?php print_r($quiz[3]["option1"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question4" value="B" >
                            <?php print_r($quiz[3]["option2"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question4" value="C" >
                            <?php print_r($quiz[3]["option3"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question4" value="D" >
                            <?php print_r($quiz[3]["option4"]); ?></label>
                        </h4>
                    </li>
                    <li id="Q5">
                        <h1>Question 5</h1>
                        <p><?php print_r($quiz[4]["questionDetail"]); ?></p>
                        <h4><label style="margin:5px;"><input type="radio" name="question5" value="A">
                            <?php print_r($quiz[4]["option1"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question5" value="B">
                            <?php print_r($quiz[4]["option2"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question5" value="C">
                            <?php print_r($quiz[4]["option3"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question5" value="D">
                            <?php print_r($quiz[4]["option4"]); ?></label>
                        </h4>
                    </li>
                    <li id="Q6">
                        <h1>Question 6</h1>
                        <p><?php print_r($quiz[5]["questionDetail"]); ?></p>
                        <h4><label style="margin:5px;"><input type="radio" name="question6" value="A" >
                            <?php print_r($quiz[5]["option1"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question6" value="B" >
                            <?php print_r($quiz[5]["option2"]); ?></label>
                    </li>
                    <li id="Q7">
                        <h1>Question 7</h1>
                        <p><?php print_r($quiz[6]["questionDetail"]); ?></p>
                        <h4><label style="margin:5px;"><input type="radio" name="question7" value="A">
                            <?php print_r($quiz[6]["option1"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question7" value="B">
                            <?php print_r($quiz[6]["option2"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question7" value="C">
                            <?php print_r($quiz[6]["option3"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question7" value="D">
                            <?php print_r($quiz[6]["option4"]); ?></label>
                        </h4>
                    </li>
                    <li id="Q8">
                        <h1>Question 8</h1>
                        <p><?php print_r($quiz[7]["questionDetail"]); ?></p>
                        <h4><label style="margin:5px;"><input type="radio" name="question8" value="A">
                            <?php print_r($quiz[7]["option1"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question8" value="B" >
                            <?php print_r($quiz[7]["option2"]); ?></label>
                        </h4>
                    </li>
                    <li id="Q9">
                        <h1>Question 9</h1>
                        <p><?php print_r($quiz[8]["questionDetail"]); ?></p>
                        <h4><label style="margin:5px;"><input type="radio" name="question9" value="A" >
                            <?php print_r($quiz[8]["option1"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question9" value="B" >
                            <?php print_r($quiz[8]["option2"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question9" value="C" >
                            <?php print_r($quiz[8]["option3"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question9" value="D" >
                            <?php print_r($quiz[8]["option4"]); ?></label>
                        </h4>
                    </li>
                    <li id="Q10">
                        <h1>Question 10</h1>
                        <p><?php print_r($quiz[9]["questionDetail"]); ?></p>
                        <h4><label style="margin:5px;"><input type="radio" name="question10" value="A">
                            <?php print_r($quiz[9]["option1"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question10" value="B" >
                            <?php print_r($quiz[9]["option2"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question10" value="C">
                            <?php print_r($quiz[9]["option3"]); ?></label><br/>
                            <label style="margin:5px;"><input type="radio" name="question10" value="D" >
                            <?php print_r($quiz[9]["option4"]); ?></label>
                        </h4>
                    </li>
                    <li></li>
                </ul>
                <a href="#" id="next">+</a><a href="#" id="prev">-</a>
            </div>
            <!-- Trigger/Open The Modal -->
            <div>
                <button type="button" id="save"  class="btnNormal">Submit Quiz</button>
            </div>
            <div id="finishModel" class="modal fadeIn">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p id="reminder">Are you sure to finish the quiz?<br/>
                        Question 1, 2 and 3 haven't been completed.</p>
                    <button id="confirmFinish" type="submit" class="btn-default">Yes</button>
                    <button id="cancelFinish" type="button" class="btn-warning">Cancel</button>
                </div>
                <script>
                    // Get the modal
                    var modal = document.getElementById('finishModel');
                    // Get the button that opens the modal
                    var btn = document.getElementById("save");
                    // Get the <span> element that closes the modal
                    var span = document.getElementsByClassName("close")[0];
                    // Get the button that opens the modal
                    var confirmFinish = document.getElementById("confirmFinish");
                    // Get the button that opens the modal
                    var cancelFinish = document.getElementById("cancelFinish");
                    // When the user clicks the button, open the modal                 
                    btn.onclick = function () {
                        var empty = "";
                        for (j = 1; j <= 10; j++)
                        {
                            var elementName = "question" + j;
                            var questionObj = document.getElementsByName(elementName);
                            var bool = false;
                            var i = 0;
                            while (i < questionObj.length)
                            {
                                if (questionObj[i].checked)
                                    bool = true;
                                i++;
                            }
                            if (bool == false) {
                                if (empty.length == 0)
                                    empty = empty + j;
                                else
                                    empty = empty + ", " + j;
                            }
                        }
                        var reminderObj = document.getElementById("reminder");
                        if (empty.length == 0)
                            reminderObj.innerHTML = "You have answered all the questions.<br />Are you sure you want to finish the quiz?";
                        else
                            reminderObj.innerHTML = "Question " + empty + " haven't been completed." + "<br/>Are you sure you want to finish the quiz?";
                        modal.style.display = "block";
                    };
                    confirmFinish.onclick = function () {
                        modal.style.display = "none";
                    };
                    // When the user clicks on <span> (x), close the modal
                    span.onclick = function () {
                        modal.style.display = "none";
                    };
                    cancelFinish.onclick = function () {
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
        </div>
    </form>

    <?php if ($layout != 'no-sidebar') { ?>
        <?php get_sidebar(); ?>
    <?php } ?>

    <!--<div>#content-inside -->
</div><!-- #content -->

<?php get_footer(); ?>
