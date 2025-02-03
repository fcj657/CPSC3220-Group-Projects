<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Array Demo Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        h1, h2 {
            color: #333;
        }
        table {
            width: auto;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #999;
            padding: 8px 12px;
            text-align: center;
        }
        th {
            background-color: #ddd;
        }
        a {
            color: #333;
            text-decoration: none;
            background-color: #ddd;
            padding: 8px 12px;
            border-radius: 3px;
        }
        a:hover {
            background-color: #bbb;
        }
    </style>
</head>
<body>
    <h1>Array Demo Results</h1>

    <?php
    
        $rows = $_POST["rows"];// saving the row the user typed
           $columns = $_POST["columns"];// saving the columns the user typed
           $minValue = $_POST["minValue"];//saving the min value the user typed
           $maxValue = $_POST["maxValue"];//saving the max value the user typed
           $randNumberTable = array();// this is an array that will store all the numbers in for the table. first box being the row while second being column
   
   
           print("Your array size is {$rows} x {$columns}<br>"); //Just telling what the array size is
           print("Your minimum value number:  {$minValue}<br>"); //Just telling what the min value the user typed is
           print("Your maximum value number:  {$maxValue}<br>"); //Just telling what the max value the user typed is
   
            //this is to assign each value to a certain spot equal to the position of where it is at in the HTML table
            for ($i = 0; $i < $rows; $i++) { // this for loop should loop through the first box of the array of the 2D array (row)
               
                for($j = 0; $j < $columns; $j++){ // this for loop will loop through all the columns in the array
                   $randNumberTable[$i][$j] = rand($minValue, $maxValue); // takes the position we are in the array and gives it a random number between the min & max
                }
            }

            //start of code to print the HTML table with all the data in the correct spot
            print("<table border='3'");
            foreach($randNumberTable as $R){
                print("<tr>");

                foreach($R as $value){
                    print("<td>$value</td>");
                }
                print("</tr>");
            }
            print("</table>");

    ?>

    <a href="arrayDemo.html">Back to Input Form</a>
</body>
</html>
