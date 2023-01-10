<?php
/**
* Student Name: Kaisen Wu
* Student Number: 300341261
* Lab Name: Lab 01 - Grade Calculator
*/

//Store the command of user.
$userCommand = "";
//Store the name of assessment.
$nameOfAssessment = "";
//Store the number of points for the assessment.
$userPoint = 0;
$accumulatePoints = 0;
//Store the absent status.
$ifAbsent = "";
//Store the score of the assessment.
$score = 0;
$accumulateScore = 0;
//Store the count of the input times.
$countInput = 0;
//Store the count of absent.
$countAbsent = 0;
//Store the score percentage.
$scorePercentage = 0;
//Store the acsent percentage.
$absentPercentage = 0;
//Store the outcome.
$outcome = "";
//Store all the information to report variable.
$report = "-----------------------------------------------------------------";

//Build a loop for asking the assessment information.
while(true) {
    //Prompt user to input command.
    echo "Please enter your command in the form of (a, r, q)";
    $userCommand = stream_get_line(STDIN,1024,PHP_EOL);

    switch($userCommand) {
        case "a":
            //Prompt user to enter the assessment name.
            echo "Please enter the name of the assessment:";
            $nameOfAssessment = stream_get_line(STDIN,1024,PHP_EOL);
            //Add the name to report, using sprintf function to format it.
            $report .=sprintf("\n%20s%40s","Assignment:", $nameOfAssessment);

            //Prompt user to enter number of points for the assessment.
            echo "Please enter the number of points for the assessment:";
            $userPoint = stream_get_line(STDIN,1024,PHP_EOL);
            //Accumulate the points.
            $accumulatePoints += $userPoint;
            //Add the points to report, using sprintf function to format it.
            $report .=sprintf("\n%20s%40.d","Total Points:", $userPoint);

            //Prompt user to enter absent status.
            echo "Was the student absent? (y/n)";
            $ifAbsent = stream_get_line(STDIN,1024,PHP_EOL);
            if($ifAbsent == "y") {
                //Count the times of absent.
                $countAbsent++;
                $score = 0;
            }
            else {
                //Prompt user to enter score.
                echo "Please enter the student's score for the assessment:";
                $score = stream_get_line(STDIN,1024,PHP_EOL);
            }
            //Accumulate the score.            
            $accumulateScore += $score;
            //Add the score and absent information to report, using sprintf function to format it.
            $report .=sprintf("\n%20s%40.d","Total Score:", $score);
            $report .=sprintf("\n%20s%40s","Missed:", $ifAbsent);
            $report .= "\n-----------------------------------------------------------------";
            $report .= "\n-----------------------------------------------------------------";
            //Count how many quizes have been input.
            $countInput++;
        break;
        
        case "r":
            if($countInput == 0) {
                //Propmt a reminder if user choose print without any input.
                echo "You didn't input any quiz information.\n";
            }
            else {
                //Calculate the weighted average.
                $scorePercentage = $accumulateScore/$accumulatePoints*100;
                //Calculate the missed percentage.
                $absentPercentage = $countAbsent/$countInput*100;
                //Add the title, weighted average and missed percentage to the report.
                $report .=sprintf("\n%35s","FINAL REPORT");
                $report .=sprintf("\n%20s%39.d%%","Weighted Average:", $scorePercentage);
                $report .=sprintf("\n%20s%39.d%%","Missed Percentage:", $absentPercentage);
                //Set the condition to determine outcome.
                if($scorePercentage<50 || $absentPercentage>30) {
                    $outcome = "UN";
                }
                else {
                    $outcome = "PASS";
                }
                //Add outcome to the report.
                $report .=sprintf("\n%20s%40s","Outcome:", $outcome);
                $report .= "\n-----------------------------------------------------------------";
                //Print the whole report.
                echo "$report\n";
            }            
        break;

        case "q":
            return;
        break;

        default:
        break;
    }
}
?>