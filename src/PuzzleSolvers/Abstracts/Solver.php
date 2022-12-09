<?php

namespace App\PuzzleSolvers\Abstracts;

use App\Interfaces\Solvable;
use ReflectionClass;

abstract class Solver implements Solvable
{
    const INPUT_BASE_DIR = __ROOT__.'/Resources';

    protected string $shortName;

    public function __construct()
    {
        $this->shortName = (new ReflectionClass(static::class))->getShortName();
    }

    abstract protected function processInputString(string $inputPath): ?array;
}