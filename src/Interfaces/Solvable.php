<?php

namespace App\Interfaces;

interface Solvable
{
    public function __construct();

    public function __invoke(
        ?string $dataset
    ): string;
}