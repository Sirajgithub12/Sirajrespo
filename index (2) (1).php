<?php
    include("./functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collatz Conjecture Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        h2 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="number"] {
            width: 150px;
            padding: 8px;
            margin-right: 10px;
        }

        input[type="submit"] {
            padding: 8px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
<h2>Collatz Conjecture Calculator</h2>
<form action="./" method="GET">
    Enter a number to start the sequence: <input type="number" name="start_number" required />
    <input type="submit" name="calculate" value="Calculate" />
</form>

<?php
    if(isset($_GET["calculate"])){
        $start_number = abs($_GET["start_number"]);
        
        $sequence = collatz($start_number);
        $iteration = count($sequence) - 1;
        $max_number = max($sequence);
        
        echo "<p>The Iteration is $iteration and The Maximum Number is ".$max_number."</p>";
        echo "<p>The Collatz Sequence for ".$start_number." is: ";
        foreach($sequence as $number){
            echo $number.", ";
        }
        echo "</p>";
    }
?>

<br><br>

<h2>Collatz Conjecture Calculator</h2>
<form action="./" method="GET">
    Enter a start number: <input type="number" name="num_1" required />
    Enter an end number: <input type="number" name="num_2" required />
    <input type="submit" name="calc_range" value="Calculate" />
</form>

<?php
    if(isset($_GET["calc_range"])){
        $num_1 = abs($_GET["num_1"]);
        $num_2 = abs($_GET["num_2"]);
        
        if($num_2 > $num_1){
            $range_sequence = collatzSequenceInRange($num_1, $num_2);
            
            $max_iteration = 0;
            foreach($range_sequence as $item){
                $iteration_val = $item["iteration"];
                if($iteration_val > $max_iteration){ $max_iteration = $iteration_val; } //finding the maximum iteration
                echo "<p>Number: ".$item["number"]." | Max. Number: ".$item["highest_number"]." | Iteration: ".$item["iteration"]."</p>";
            }
            
            $min_iteration = $max_iteration;
            echo "<br><p>Maximum Iteration:</p>";
            foreach($range_sequence as $item){
                $iteration_val = $item["iteration"];
                if($iteration_val < $min_iteration){ $min_iteration = $iteration_val; } //finding the minimum iteration
                if($iteration_val == $max_iteration){
                    echo "<p>Number: ".$item["number"]." | Max. Number: ".$item["highest_number"]." | Iteration: ".$item["iteration"]."</p>";
                }
            }
            
            echo "<br><p>Minimum Iteration:</p>";
            foreach($range_sequence as $item){
                $iteration_val = $item["iteration"];
                if($iteration_val == $min_iteration){
                    echo "<p>Number: ".$item["number"]." | Max. Number: ".$item["highest_number"]." | Iteration: ".$item["iteration"]."</p>";
                }
            }
        } else {
            echo "Please enter the correct numbers!";
        }
    }
?>
</body>
</html>
