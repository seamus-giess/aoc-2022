<?php

namespace App\Services;

use App\PuzzleSolvers\Abstracts\Solver;

class PuzzleService
{
    const PUZZLE_BASE = 'App\PuzzleSolvers';

    public static function getSolver(string $className): Solver|null
    {
        if (!is_subclass_of($className, Solver::class)) {
            return null;
        }

        if ($className === Solver::class) {
            return null;
        }

        $solverClass = self::PUZZLE_BASE."\\$className";
        return new $solverClass();
    }
}