<?php

use App\PuzzleSolvers\Abstracts\AdventSolver;
use App\Services\PuzzleService;

require __DIR__ . '/vendor/autoload.php';

const __ROOT__ = __DIR__;

@[
    $puzzle,
    $argument,
] = explode(':', $argv[1]);

if ($puzzle === 'make') {
    echo AdventSolver::makeNew($argument) . PHP_EOL;
    return;
}

$solver = PuzzleService::getSolver($puzzle);

if (is_null($solver)) {
    echo "Puzzle class hasn't been initialised yet!";
    return;
}

echo $solver($argument) . PHP_EOL;