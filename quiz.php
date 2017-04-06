<!doctype html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>Quiz</title>
	<link rel="stylesheet" type="text/css" href="css/common.css" />
        <link rel="stylesheet" href="css/quizStyle.css" media="screen" />
        <!-- Plugins -->
        <link href="css/HPanimations.css" rel="stylesheet">
        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/NavigationFooter.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="js/Timeline.jquery.js"></script>
	<script>
		$(function(){
			$().timelinr({
				arrowKeys: 'true'
			})
		});
	</script>
   
</head>

<body>
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
        $sql = "SELECT questionDetail, option1, option2, option3, option4 FROM QUIZQUESTION WHERE nationality='Chinese' AND quizID=1";
        $result = mysqli_query($con, $sql);
        while($row=mysqli_fetch_array($result))
        {
            $quiz[]=$row;
        }
        mysqli_free_result($result);
        mysqli_close($con);
        ?>

        <section>
            <form method="post" action="quizResult.php">
            <div class="row text-center col-lg-12" style="background-image: url('img/quiz/bg-grid.jpg');">
                <div id="timeline" style="height:auto;">
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
			<li><a href="#2011">Q.10</a></li>
		</ul>
                <div class="timer">
                    <label id="minutes">00</label>:<label id="seconds">00</label>
                    <script type="text/javascript">
                        var minutesLabel = document.getElementById("minutes");
                        var secondsLabel = document.getElementById("seconds");
                        var totalSeconds = 0;
                        setInterval(setTime, 1000);

                        function setTime()
                        {
                            ++totalSeconds;
                            secondsLabel.innerHTML = pad(totalSeconds%60);
                            minutesLabel.innerHTML = pad(parseInt(totalSeconds/60));
                        }

                        function pad(val)
                        {
                            var valString = val + "";
                            if(valString.length < 2)
                            {
                                return "0" + valString;
                            }
                            else
                            {
                                return valString;
                            }
                        }
                </script>
                </div>
                    
                        <ul id="issues">                        
                            <li id="Q1">
                                    <h1>Question 1</h1>
                                    <p><?php print_r($quiz[0]["questionDetail"]); ?></p>
                                    <h4><input type="radio" name="question1" value="A">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[0]["option1"]); ?></label><br/>
                                        <input type="radio" name="question1" value="B">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[0]["option2"]); ?></label><br/>
                                        <input type="radio" name="question1" value="C">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[0]["option3"]); ?></label><br/>
                                        <input type="radio" name="question1" value="D">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[0]["option4"]); ?></label>
                                    </h4>
                            </li>
                            <li id="Q2">
                                    <h1>Question 2</h1>
                                    <p><?php print_r($quiz[1]["questionDetail"]); ?></p>
                                    <h4><input type="radio" name="question2" value="A">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[1]["option1"]); ?></label><br/>
                                        <input type="radio" name="question2" value="B">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[1]["option2"]); ?></label><br/>
                                        <input type="radio" name="question2" value="C">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[1]["option3"]); ?></label><br/>
                                        <input type="radio" name="question2" value="D">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[1]["option4"]); ?></label>
                                    </h4>
                            </li>
                            <li id="Q3">
                                    <h1>Question 3</h1>
                                    <p><?php print_r($quiz[2]["questionDetail"]); ?></p>
                                    <h4><input type="radio" name="question3" value="A">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[2]["option1"]); ?></label><br/>
                                        <input type="radio" name="question3" value="B">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[2]["option2"]); ?></label><br/>
                                        <input type="radio" name="question3" value="C">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[2]["option3"]); ?></label><br/>
                                        <input type="radio" name="question3" value="D">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[2]["option4"]); ?></label>
                                    </h4>
                            </li>
                            <li id="Q4">
                                    <h1>Question 4</h1>
                                    <p><?php print_r($quiz[3]["questionDetail"]); ?></p>
                                    <h4><input type="radio" name="question4" value="A" ">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[3]["option1"]); ?></label><br/>
                                        <input type="radio" name="question4" value="B" >
                                        <label style="margin:5px 30px;"><?php print_r($quiz[3]["option2"]); ?></label><br/>
                                        <input type="radio" name="question4" value="C" >
                                        <label style="margin:5px 30px;"><?php print_r($quiz[3]["option3"]); ?></label><br/>
                                        <input type="radio" name="question4" value="D" >
                                        <label style="margin:5px 30px;"><?php print_r($quiz[3]["option4"]); ?></label>
                                    </h4>
                            </li>
                            <li id="Q5">
                                    <h1>Question 5</h1>
                                    <p><?php print_r($quiz[4]["questionDetail"]); ?></p>
                                    <h4><input type="radio" name="question5" value="A">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[4]["option1"]); ?></label><br/>
                                        <input type="radio" name="question5" value="B">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[4]["option2"]); ?></label><br/>
                                        <input type="radio" name="question5" value="C">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[4]["option3"]); ?></label><br/>
                                        <input type="radio" name="question5" value="D">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[4]["option4"]); ?></label>
                                    </h4>
                            </li>
                            <li id="Q6">
                                    <h1>Question 6</h1>
                                    <p><?php print_r($quiz[5]["questionDetail"]); ?></p>
                                    <h4><input type="radio" name="question6" value="A" >
                                        <label style="margin:5px 30px;"><?php print_r($quiz[5]["option1"]); ?></label><br/>
                                        <input type="radio" name="question6" value="B" >
                                        <label style="margin:5px 30px;"><?php print_r($quiz[5]["option2"]); ?></label><br/>
                                        <input type="radio" name="question6" value="C" >
                                        <label style="margin:5px 30px;"><?php print_r($quiz[5]["option3"]); ?></label><br/>
                                        <input type="radio" name="question6" value="D" >
                                        <label style="margin:5px 30px;"><?php print_r($quiz[5]["option4"]); ?></label>
                                    </h4>
                            </li>
                            <li id="Q7">
                                    <h1>Question 7</h1>
                                    <p><?php print_r($quiz[6]["questionDetail"]); ?></p>
                                    <h4><input type="radio" name="question7" value="A">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[6]["option1"]); ?></label><br/>
                                        <input type="radio" name="question7" value="B">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[6]["option2"]); ?></label><br/>
                                        <input type="radio" name="question7" value="C">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[6]["option3"]); ?></label><br/>
                                        <input type="radio" name="question7" value="D">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[6]["option4"]); ?></label>
                                    </h4>
                            </li>
                            <li id="Q8">
                                    <h1>Question 8</h1>
                                    <p><?php print_r($quiz[7]["questionDetail"]); ?></p>
                                    <h4><input type="radio" name="question8" value="A">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[7]["option1"]); ?></label><br/>
                                        <input type="radio" name="question8" value="B" >
                                        <label style="margin:5px 30px;"><?php print_r($quiz[7]["option2"]); ?></label><br/>
                                        <input type="radio" name="question8" value="C" >
                                        <label style="margin:5px 30px;"><?php print_r($quiz[7]["option3"]); ?></label><br/>
                                        <input type="radio" name="question8" value="D">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[7]["option4"]); ?></label>
                                    </h4>
                            </li>
                            <li id="Q9">
                                    <h1>Question 9</h1>
                                    <p><?php print_r($quiz[8]["questionDetail"]); ?></p>
                                    <h4><input type="radio" name="question9" value="A" >
                                        <label style="margin:5px 30px;"><?php print_r($quiz[8]["option1"]); ?></label><br/>
                                        <input type="radio" name="question9" value="B" >
                                        <label style="margin:5px 30px;"><?php print_r($quiz[8]["option2"]); ?></label><br/>
                                        <input type="radio" name="question9" value="C" >
                                        <label style="margin:5px 30px;"><?php print_r($quiz[8]["option3"]); ?></label><br/>
                                        <input type="radio" name="question9" value="D" >
                                        <label style="margin:5px 30px;"><?php print_r($quiz[8]["option4"]); ?></label>
                                    </h4>
                            </li>
                            <li id="Q10">
                                    <h1>Question 10</h1>
                                    <p><?php print_r($quiz[9]["questionDetail"]); ?></p>
                                    <h4><input type="radio" name="question10" value="A">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[9]["option1"]); ?></label><br/>
                                        <input type="radio" name="question10" value="B" >
                                        <label style="margin:5px 30px;"><?php print_r($quiz[9]["option2"]); ?></label><br/>
                                        <input type="radio" name="question10" value="C">
                                        <label style="margin:5px 30px;"><?php print_r($quiz[9]["option3"]); ?></label><br/>
                                        <input type="radio" name="question10" value="D" >
                                        <label style="margin:5px 30px;"><?php print_r($quiz[9]["option4"]); ?></label>
                                    </h4>
                            </li>                                
                        </ul>
                        <a href="#" id="next">+</a>
                        <a href="#" id="prev">-</a>
                    </div>
                    <!-- Trigger/Open The Modal -->
                    <button type="button" id="back" class="btnWhite">Back to Quiz Home</button>
                    <button type="submit" id="save" onclick="location.href='quizResult.php'" class="btnNormal">Finish</button>
                <!-- The Modal -->
                <div id="myModal" class="modal fadeIn">

                  <!-- Modal content -->
                  <div class="modal-content">
                    <span class="close">&times;</span>
                    <p>Are you sure to leave this page?<br/>
                    Your process won't be saved before you have finished it.</p>
                    <button id="yes" type="button" class="btn-default">Yes</button>
                    <button id="cancel" type="button" class="btn-warning">Cancel</button>
                  </div>
                <script>
                // Get the modal
                var modal = document.getElementById('myModal');
                // Get the button that opens the modal
                var btn = document.getElementById("back");
                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];
                // Get the button that opens the modal
                var yes = document.getElementById("yes");
                // Get the button that opens the modal
                var cancel = document.getElementById("cancel");
                // When the user clicks the button, open the modal 
                btn.onclick = function() {
                    modal.style.display = "block";
                };
                yes.onclick = function() {
                    modal.style.display = "none";
                    location.href="quizHome.php";
                };
                // When the user clicks on <span> (x), close the modal
                span.onclick = function() {
                    modal.style.display = "none";
                };
                cancel.onclick = function() {
                    modal.style.display = "none";
                };
                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                };
                </script>
            </div>
        </div>
            </form>
            
        </section>
        <?php include 'footer.php';?>
</body>
</html>
