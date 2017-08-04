<!DOCTYPE html>
<html>

<head>
	<!-- Favicon -->
    <link rel="icon" type="image/gif" href="img/fx-favicon.ico">

    <!-- Meta Data -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>Cafe Quiz</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>

    <?php
        require "inc/usertest.php";
        date_default_timezone_set('America/Chicago');
        $user = strtolower($user);

        echo '<h2>Hello, ' . $user . '!</h2>';
    ?>

	<div id="page-wrap">

		<h1>Cafe Quiz</h1>

        <hr />
		
		<form action="grade.php" method="post" id="quizie">
		
            <ol>
            
                <li>
                
                    <h3>If a demand download of URSA does not resolve the URSA Is Expired error message, what kb should be referenced to resolve the issue?</h3>
                    
                    <div>
                        <input type="radio" name="q1-answers" id="q1-answers-A" value="A" />
                        <label for="q1-answers-A">KB: 2162</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q1-answers" id="q1-answers-B" value="B" />
                        <label for="q1-answers-B">KB: 14018</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q1-answers" id="q1-answers-C" value="C" />
                        <label for="q1-answers-C">KB: 14229</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q1-answers" id="q1-answers-D" value="D" />
                        <label for="q1-answers-D">None of the above</label>
                    </div>
                
                </li>
                
               <li>
                
                    <h3>What step from KB 14229 will most likely resolve an URSA Is Expired error message?</h3>
                    
                    <div>
                        <input type="radio" name="q2-answers" id="q2-answers-A" value="A" />
                        <label for="q2-answers-A">Step 9</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q2-answers" id="q2-answers-B" value="B" />
                        <label for="q2-answers-B">Step 11</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q2-answers" id="q2-answers-C" value="C" />
                        <label for="q2-answers-C">Step 7</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q2-answers" id="q2-answers-D" value="D" />
                        <label for="q2-answers-D">Step 13</label>
                    </div>
                
                </li>

                <li>
                
                    <h3>If a customer is requesting a product key for Fedex Ship Manager Software, what kb should you reference for proper account security validation?</h3>
                    
                    <div>
                        <input type="radio" name="q3-answers" id="q3-answers-A" value="A" />
                        <label for="q3-answers-A">KB: 16528</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q3-answers" id="q3-answers-B" value="B" />
                        <label for="q3-answers-B">KB: 14422</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q3-answers" id="q3-answers-C" value="C" />
                        <label for="q3-answers-C">KB: 8285</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q3-answers" id="q3-answers-D" value="D" />
                        <label for="q3-answers-D">KB: 8582</label>
                    </div>
                
                </li>

                <li>
                
                    <h3>After you have validated a customer via kb 8582, what kb should you use to generate a product key for them?</h3>
                    
                    <div>
                        <input type="radio" name="q4-answers" id="q4-answers-A" value="A" />
                        <label for="q4-answers-A">KB: 14422</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q4-answers" id="q4-answers-B" value="B" />
                        <label for="q4-answers-B">KB: 14573</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q4-answers" id="q4-answers-C" value="C" />
                        <label for="q4-answers-C">KB: 16528</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q4-answers" id="q4-answers-D" value="D" />
                        <label for="q4-answers-D">None of the above</label>
                    </div>
                
                </li>

                <li>
                
                    <h3>Where can you find a list of Hardware components provided to FedEx Ship Manager customers?</h3>
                    
                    <div>
                        <input type="radio" name="q5-answers" id="q5-answers-A" value="A" />
                        <label for="q5-answers-A">KB: 1990</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q5-answers" id="q5-answers-B" value="B" />
                        <label for="q5-answers-B">KB: 4873</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q5-answers" id="q5-answers-C" value="C" />
                        <label for="q5-answers-C">KB: 6589</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q5-answers" id="q5-answers-D" value="D" />
                        <label for="q5-answers-D">None of the above</label>
                    </div>
                
                </li>

                <li>
                
                    <h3>What ways can you determine if a customer is using FXI other than the System type in Nexus?</h3>
                    
                    <div>
                        <input type="radio" name="q6-answers" id="q6-answers-A" value="A" />
                        <label for="q6-answers-A">The Integration menu will be greyed out</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q6-answers" id="q6-answers-B" value="B" />
                        <label for="q6-answers-B">There will be a "-i" after the software version across the top of the screen</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q6-answers" id="q6-answers-C" value="C" />
                        <label for="q6-answers-C">Both A & B</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q6-answers" id="q6-answers-D" value="D" />
                        <label for="q6-answers-D">None of the above</label>
                    </div>
                
                </li>

                <li>
                
                    <h3>What KB should you reference to begin troubleshooting an fxi issue?</h3>
                    
                    <div>
                        <input type="radio" name="q7-answers" id="q7-answers-A" value="A" />
                        <label for="q7-answers-A">KB: 15907</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q7-answers" id="q7-answers-B" value="B" />
                        <label for="q7-answers-B">KB: 4953</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q7-answers" id="q7-answers-C" value="C" />
                        <label for="q7-answers-C">KB: 10257</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q7-answers" id="q7-answers-D" value="D" />
                        <label for="q7-answers-D">None of the above</label>
                    </div>
                
                </li>

                <li>
                
                    <h3>Occasionally FSM and FXI will get out of sync with each other causing the FXI integrator to not work as expected or some of its functionality to stop working. What should you do if this happens?</h3>
                    
                    <div>
                        <input type="radio" name="q8-answers" id="q8-answers-A" value="A" />
                        <label for="q8-answers-A">Ignore, FXI project will slowly start loading in the background</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q8-answers" id="q8-answers-B" value="B" />
                        <label for="q8-answers-B">Rebooting the computer will be the ONLY fix</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q8-answers" id="q8-answers-C" value="C" />
                        <label for="q8-answers-C">Stop and start FXI project</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q8-answers" id="q8-answers-D" value="D" />
                        <label for="q8-answers-D">Running FedExSvcManager /SEE from the run command will re-establish this connection between the two applications</label>
                    </div>
                
                </li>

                <li>
                
                    <h3>What KB lists some of the differences between FXIA and FXI?</h3>
                    
                    <div>
                        <input type="radio" name="q9-answers" id="q9-answers-A" value="A" />
                        <label for="q9-answers-A">KB: 7870</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q9-answers" id="q9-answers-B" value="B" />
                        <label for="q9-answers-B">KB: 10457</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q9-answers" id="q9-answers-C" value="C" />
                        <label for="q9-answers-C">KB: 17342</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q9-answers" id="q9-answers-D" value="D" />
                        <label for="q9-answers-D">None of the above</label>
                    </div>
                
                </li>

                <li>
                
                    <h3>When importing from a .csv file some of the zip codes drop the leading 0. How can you keep this from happening?</h3>
                    
                    <div>
                        <input type="radio" name="q10-answers" id="q10-answers-A" value="A" />
                        <label for="q10-answers-A">Open .csv file using OpenOffice.</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q10-answers" id="q10-answers-B" value="B" />
                        <label for="q10-answers-B">Open .csv file using Excel.</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q10-answers" id="q10-answers-C" value="C" />
                        <label for="q10-answers-C">Trick question, leading 0's are not an issue.</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="q10-answers" id="q10-answers-D" value="D" />
                        <label for="q10-answers-D">When opening a .csv files for any reason, do not use Excel. Use Notepad instead.</label>
                    </div>
                
                </li>
            
            </ol>
            
            <input id="submitAnswers" type="submit" value="Submit Quiz" />
		
		</form>
	
	</div>



</body>

</html>