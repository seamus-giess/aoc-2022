<?php

namespace App\PuzzleSolvers\Abstracts;

use ReflectionClass;
use Solvable;

abstract class Solver implements Solvable
{
    const INPUT_BASE_DIR = __DIR__.'/Resources';

    protected string $shortName;

    public function __construct()
    {
        $this->shortName = (new ReflectionClass(self::class))->getShortName();
    }

    abstract protected function processInput(string $inputPath): ?array;
}