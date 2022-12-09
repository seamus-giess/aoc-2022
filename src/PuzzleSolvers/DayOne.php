<?php

namespace App\PuzzleSolvers;

use App\PuzzleSolvers\Abstracts\AdventSolver;

class DayOne extends AdventSolver
{
    public function partOne(): string
    {
        $summedCalories = $this->sumCalories($this->data);

        return '';
    }

    public function partTwo(): string
    {
        return '';
    }

    public function processInputString(string $stringInput): array
    {
        $groupedRows = explode(PHP_EOL . PHP_EOL, $stringInput);

        return array_map(
            fn ($groupedItemsString) => array_map(
                fn($item) => (int)$item,
                explode(PHP_EOL, $groupedItemsString)
            ),
            $groupedRows
        );
    }

    public function sumCalories(array $items): array
    {
        return array_map(fn($elfItems) => array_sum($elfItems), $items);
    }
}
