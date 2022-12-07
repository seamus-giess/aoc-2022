<?php
require __DIR__ . '/vendor/autoload.php';

use App\PuzzleControllers\DayOne;

const PUZZLE_BASE = 'App\PuzzleControllers';

$puzzleClass = PUZZLE_BASE."\\$argv[1]";

if (class_exists($puzzleClass)) {
    echo "Puzzle class hasn't been initialised yet!";
    return;
}

$puzzleController = new $puzzleClass();