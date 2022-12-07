<?php

use App\Services\PuzzleService;

require __DIR__ . '/vendor/autoload.php';

[
    $puzzle,
    $parts,
    $data
] = explode(';', $argv[1]);

$solver = PuzzleService::getSolver($puzzle);

if (is_null($solver)) {
    echo "Puzzle class hasn't been initialised yet!";
    return;
}