<?php

namespace App\PuzzleSolvers;

use App\PuzzleSolvers\Abstracts\AdventSolver;

class DayOne extends AdventSolver
{
    public function partOne(): string
    {
        return '';
    }

    public function partTwo(): string
    {
        return '';
    }

    public function decodeInput(string $stringInput): array
    {
        // TODO: Implement serializeInput() method.
        return [];
    }
}

$input = file_get_contents('./input/data.txt');

$elvesItems = explode(PHP_EOL . PHP_EOL, $input);
$elvesItems = array_map(
    function ($itemsString) {
        $items = explode(PHP_EOL, $itemsString);

        return array_map(fn($item) => (int)$item, $items);
    },
    $elvesItems
);

$calorieTotals = array_map(fn($elfItems) => array_sum($elfItems), $elvesItems);

$array = [];
for ($i = 1; $i <= 3; $i++) {
    $max        = max($calorieTotals);
    $array[]    = $max;
    $highestElf = array_keys($calorieTotals, $max)[0];
    unset($calorieTotals[$highestElf]);
}


echo array_sum($array) . PHP_EOL;