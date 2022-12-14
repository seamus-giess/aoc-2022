<?php

namespace App\PuzzleSolvers;

use App\PuzzleSolvers\Abstracts\AdventSolver;

class DayOne extends AdventSolver
{
    public function partOne(): string
    {
        $summedCalories = $this->sumCalories($this->data);

        return 'Day One - Max: '.max($summedCalories);
    }

    public function partTwo(): string
    {
        $summedCalories = $this->sumCalories($this->data);

        $array = [];
        for ($i = 1; $i <= 3; $i++) {
            $max        = max($summedCalories);
            $array[]    = $max;
            $highestElf = array_keys($summedCalories, $max)[0];
            unset($summedCalories[$highestElf]);
        }

        return 'Day Two - Max: ' . array_sum($array);
    }

    public function processInputString(string $inputPath): ?array
    {
        $groupedRows = explode(PHP_EOL . PHP_EOL, $inputPath);

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
