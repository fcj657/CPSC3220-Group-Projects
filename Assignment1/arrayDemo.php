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


    <!-- <!DOCTYPE html>
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
    <h1>Your Array</h1>
    <?php
    function standard_deviation($arr) {
        $mean = array_sum($arr) / count($arr);
        $variance = array_sum(array_map(fn($x) => pow($x - $mean, 2), $arr)) / count($arr);
        return sqrt($variance);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $rows = $_POST["rows"];
        $columns = $_POST["columns"];
        $minValue = $_POST["minValue"];
        $maxValue = $_POST["maxValue"];

        echo "<p>Your array size is: $rows x $columns</p>";
        echo "<p>Your min. value is: $minValue</p>";
        echo "<p>Your max value is: $maxValue</p>";

        $array = [];
        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $columns; $j++) {
                $array[$i][$j] = rand($minValue, $maxValue);
            }
        }

        echo "<table border='1'>";
        foreach ($array as $row) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table>";

        echo "<h2>Row Calculations</h2>";
        echo "<table><tr><th>Row</th><th>Sum</th><th>Avg</th><th>Std Dev</th></tr>";
        foreach ($array as $index => $row) {
            $sum = array_sum($row);
            $avg = $sum / count($row);
            $std_dev = standard_deviation($row);
            echo "<tr><td>$index</td><td>$sum</td><td>" . number_format($avg, 3) . "</td><td>" . number_format($std_dev, 3) . "</td></tr>";
        }
        echo "</table>";

        echo "<h2>Value Categorization</h2>";
        echo "<table border='1'>";
        foreach ($array as $row) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>$value</td>";
            }
            echo "</tr><tr>";
            foreach ($row as $value) {
                $label = ($value > 0) ? "positive" : (($value < 0) ? "negative" : "zero");
                echo "<td>$label</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
    <a href="arrayDemo.html">Back to Input Form</a>
</body>
</html>    
    -->
</html>
