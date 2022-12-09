<?php

use App\Services\PuzzleService;

require __DIR__ . '/vendor/autoload.php';

const __ROOT__ = __DIR__;

@[
    $puzzle,
    $dataset,
] = explode(':', $argv[1]);

$solver = PuzzleService::getSolver($puzzle);

if (is_null($solver)) {
    echo "Puzzle class hasn't been initialised yet!";
    return;
}

echo $solver($dataset) . PHP_EOL;