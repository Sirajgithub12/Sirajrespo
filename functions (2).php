<?php
function collatz($startNumber) {
    $sequence = array($startNumber); // Start the sequence with the initial value of $startNumber

    while ($startNumber != 1) {
        if ($startNumber % 2 == 0) {
            $startNumber = $startNumber / 2;
        } else {
            $startNumber = 3 * $startNumber + 1;
        }
        $sequence[] = $startNumber; // Add the new value of $startNumber to the sequence
    }

    return $sequence;
}

function collatzSequenceInRange($start, $end) {
    $sequences = array();

    for ($i = $start; $i <= $end; $i++) {
        $sequence = array();
        $number = $i;

        while ($number != 1) {
            $sequence[] = $number;
            if ($number % 2 == 0) {
                $number = $number / 2;
            } else {
                $number = 3 * $number + 1;
            }
        }
        $sequence[] = 1; // Add 1 to the end of the sequence
        $sequences[] = array(
            'number' => $i,
            'highest_number' => max($sequence),
            'iteration' => count($sequence) - 1
        );
    }

    return $sequences;
}
?>
