<?php

/**
 * This script demonstrates the generation of the Fibonacci sequence.
 * The Fibonacci sequence is a series of numbers where each number
 * is the sum of the two preceding ones, usually starting with 0 and 1.
 */

/**
 * Generates the Fibonacci sequence up to a specified number of terms.
 *
 * This function uses an iterative approach to build the sequence,
 * which is efficient for a large number of terms.
 *
 * @param int $numberOfTerms The number of terms to generate in the sequence. Must be a positive integer.
 * @return array An array containing the Fibonacci sequence.
 */
function generateFibonacci(int $numberOfTerms): array {
    if ($numberOfTerms <= 0) {
        return [];
    }

    $sequence = [];
    $first = 0;
    $second = 1;

    if ($numberOfTerms >= 1) {
        $sequence[] = $first;
    }

    for ($i = 1; $i < $numberOfTerms; $i++) {
        if ($i === 1) {
            $sequence[] = $second;
        } else {
            $next = $first + $second;
            $first = $second;
            $second = $next;
            $sequence[] = $next;
        }
    }

    return $sequence;
}

/**
 * A recursive function to find the nth Fibonacci number.
 *
 * WARNING: This method is highly inefficient for larger numbers
 * due to repeated calculations and can lead to stack overflow.
 * It's included for demonstration purposes only.
 *
 * @param int $n The position in the Fibonacci sequence.
 * @return int The nth Fibonacci number.
 */
function recursiveFibonacci(int $n): int {
    if ($n <= 1) {
        return $n
    }
    return recursiveFibonacci($n - 1) + recursiveFibonacci($n - 2);
}

// --- Main execution ---

echo "--- Iterative Fibonacci Sequence ---\n";
$termsToGenerate = 15;
$fibonacciSequence = generateFibonacci($termsToGenerate);

echo "The first {$termsToGenerate} terms of the Fibonacci sequence are:\n";
echo implode(', ', $fibonacciSequence);
echo "\n\n";


echo "--- Recursive Fibonacci Calculation ---\n";
$nthTerm = 10;
echo "Calculating the {$nthTerm}th Fibonacci number using recursion...\n";
$nthValue = recursiveFibonacci($nthTerm);
echo "The {$nthTerm}th Fibonacci number is: {$nthValue}\n";

// Example of the inefficiency of the recursive approach.
// Anything above ~35-40 can be very slow.
// $slowTerm = 35;
// echo "\nCalculating the {$slowTerm}th Fibonacci number recursively (this might be slow)...\n";
// $slowValue = recursiveFibonacci($slowTerm);
// echo "The {$slowTerm}th Fibonacci number is: {$slowValue}\n";

?>
