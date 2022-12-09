<?php

namespace App\PuzzleSolvers;

use App\PuzzleSolvers\Abstracts\AdventSolver;

class DayTwo extends AdventSolver
{
    const THROWN = 'thrown';
    const MINE = 'mine';

    const ROCK = 'A';
    const PAPER = 'B';
    const SCISSORS = 'C';

    const WIN = 'win';
    const LOST = 'lost';
    const DRAW = 'draw';

    const OUTCOMES = [
        self::ROCK => [
            self::ROCK => self::DRAW,
            self::PAPER => self::LOST,
            self::SCISSORS => self::WIN,
        ],
        self::PAPER => [
            self::ROCK => self::WIN,
            self::PAPER => self::DRAW,
            self::SCISSORS => self::LOST,
        ],
        self::SCISSORS => [
            self::ROCK => self::LOST,
            self::PAPER => self::WIN,
            self::SCISSORS => self::DRAW,
        ],
    ];

    const WORTH = [
        self::ROCK => 1,
        self::PAPER => 2,
        self::SCISSORS => 3,
    ];

    const OUTCOMES_WORTH = [
        self::WIN => 6,
        self::LOST => 0,
        self::DRAW => 3,
    ];

    private array $guideKey;

    public function partOne(): string
    {
        $this->guideKey = [
            self::ROCK => self::PAPER,
            self::PAPER => self::ROCK,
            self::SCISSORS => self::SCISSORS,
        ];

        $total = 0;
        foreach ($this->data as $match) {
            $thrown = $match[self::THROWN];
            $mine = $this->guideKey[$thrown];

            $outcome = self::OUTCOMES[$mine][$thrown];
            $total += self::OUTCOMES_WORTH[$outcome] + self::WORTH[$mine];
        }
        return 'Day One - Total: '.$total;
    }

    public function partTwo(): string
    {
        return 'Day Two - NOT SOLVED';
    }

    public function processInputString(string $inputPath): ?array
    {
        if ($inputPath === '') {
            return null;
        }

        $rows = explode(PHP_EOL, $inputPath);
        $pairs = [];
        foreach ($rows as $row) {
            [
                $thrown,
                $mine
            ] = explode(' ', $row);
            $pairs[] = [self::THROWN => $thrown, self::MINE => $mine];
        }

        $this->guideKey = self::makeGuideKey($pairs);
        return $pairs;
    }

    private function makeGuideKey(array $guide): array
    {
        return [
            'Y' => self::PAPER,
            'X' => self::ROCK,
            'Z' => self::SCISSORS,
        ];
    }
}
