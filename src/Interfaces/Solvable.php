<?php

namespace App\Interfaces;

interface Solvable
{
    public function __construct();

    public function __invoke(
        ?string $parts,
        ?string $dataset
    ): string;
}