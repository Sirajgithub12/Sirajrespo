<?php
include("./class.php");
$collatzProgram = new myCollatzProgram();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collatz Conjecture Calculator</title>
</head>

<body>
    <h2>Collatz Conjecture Calculator</h2>
    <form action="./" method="GET">
        Enter a number to start the sequence: <input type="number" name="start_number" required />
        <input type="submit" name="calculate" value="Calculate" />
    </form>

    <?php
    if (isset($_GET["calculate"])) {
        $inputNumber = abs($_GET["start_number"]);

        $sequenceArray = $collatzProgram->calculateCollatz($inputNumber);
        $iterationCount = count($sequenceArray) - 1;
        $maxArrayNumber = max($sequenceArray);

        echo "<p>The Iteration is $iterationCount and The Maximum Number is " . $maxArrayNumber . "</p>";
        echo "<p>The Collatz Sequence for " . $inputNumber . " is: ";
        foreach ($sequenceArray as $arrayElement) {
            echo $arrayElement . ", ";
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
    if (isset($_GET["calc_range"])) {
        $num_1 = abs($_GET["num_1"]);
        $num_2 = abs($_GET["num_2"]);

        if ($num_2 > $num_1) {
            $collatzRangeArray = $collatzProgram->collatzSequenceInRange($num_1, $num_2);

            echo "<h2>Collatz Sequence Range</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Number</th><th>Max Number</th><th>Iteration</th></tr>";

            foreach ($collatzRangeArray as $entry) {
                echo "<tr>";
                echo "<td>" . $entry["number"] . "</td>";
                echo "<td>" . $entry["highest_number"] . "</td>";
                echo "<td>" . $entry["iteration"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";

            $maxVal = max(array_column($collatzRangeArray, 'iteration'));
            $minVal = min(array_column($collatzRangeArray, 'iteration'));

            echo "<br><p>Maximum Iteration:</p>";
            echo "<table border='1'>";
            echo "<tr><th>Number</th><th>Max Number</th><th>Iteration</th></tr>";

            foreach ($collatzRangeArray as $entry) {
                if ($entry["iteration"] == $maxVal) {
                    echo "<tr>";
                    echo "<td>" . $entry["number"] . "</td>";
                    echo "<td>" . $entry["highest_number"] . "</td>";
                    echo "<td>" . $entry["iteration"] . "</td>";
                    echo "</tr>";
                }
            }

            echo "</table>";

            echo "<br><p>Minimum Iteration:</p>";
            echo "<table border='1'>";
            echo "<tr><th>Number</th><th>Max Number</th><th>Iteration</th></tr>";

            foreach ($collatzRangeArray as $entry) {
                if ($entry["iteration"] == $minVal) {
                    echo "<tr>";
                    echo "<td>" . $entry["number"] . "</td>";
                    echo "<td>" . $entry["highest_number"] . "</td>";
                    echo "<td>" . $entry["iteration"] . "</td>";
                    echo "</tr>";
                }
            }

            echo "</table>";
        } else {
            echo "Please enter the correct number!";
        }
    }
    ?>

</body>

</html>
