<?php

namespace App\PuzzleSolvers;

use App\PuzzleSolvers\Abstracts\AdventSolver;

class DayTwo extends AdventSolver
{
    public function partOne(): string
    {
        return 'Day One - NOT SOLVED';
    }

    public function partTwo(): string
    {
        return 'Day Two - NOT SOLVED';
    }

    public function processInputString(string $inputPath): ?array
    {
        if ($stringInput === '') {
            return null;
        }
        // TODO update input processor
        $groupedRows = explode(PHP_EOL . PHP_EOL, $stringInput);

        return array_map(
            fn ($groupedItemsString) => array_map(
                fn($item) => (int)$item,
                explode(PHP_EOL, $groupedItemsString)
            ),
            $groupedRows
        );
    }
}
