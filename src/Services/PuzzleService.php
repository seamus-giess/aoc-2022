<?php

namespace App\Services;

use App\PuzzleSolvers\Abstracts\Solver;

class PuzzleService
{
    const PUZZLE_BASE = 'App\PuzzleSolvers';

    public static function getSolver(string $className): Solver|null
    {
        $solverClass = self::PUZZLE_BASE."\\$className";
        if (!is_subclass_of($solverClass, Solver::class)) {
            return null;
        }

        if ($solverClass === Solver::class) {
            return null;
        }

        return new $solverClass();
    }
}