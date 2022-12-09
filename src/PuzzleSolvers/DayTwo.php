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

    const WANTED_THROW = [
        self::WIN => [
            self::ROCK => self::PAPER,
            self::PAPER => self::SCISSORS,
            self::SCISSORS => self::ROCK,
        ],
        self::DRAW => [
            self::ROCK => self::ROCK,
            self::PAPER => self::PAPER,
            self::SCISSORS => self::SCISSORS,
        ],
        self::LOST => [
            self::ROCK => self::SCISSORS,
            self::PAPER => self::ROCK,
            self::SCISSORS => self::PAPER,
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

    const EXPECTED_OUTCOME = 'outcome';

    private array $guideKey;

    public function partOne(): string
    {
        $guideKey = [
            'Y' => self::PAPER,
            'X' => self::ROCK,
            'Z' => self::SCISSORS,
        ];

        $total = 0;
        foreach ($this->data as $match) {
            $thrown = $match[self::THROWN];
            $mine = $guideKey[$match[self::EXPECTED_OUTCOME]];

            $outcome = self::OUTCOMES[$mine][$thrown];

            $mineWorth = self::WORTH[$mine];
            $outcomeWorth = self::OUTCOMES_WORTH[$outcome];
            $matchWorth = $mineWorth + $outcomeWorth;
            $total += $matchWorth;
        }
        return 'Day One - Total: '.$total;
    }

    public function partTwo(): string
    {
        $guideKey = [
            'Y' => self::DRAW,
            'X' => self::LOST,
            'Z' => self::WIN,
        ];

        $total = 0;
        foreach ($this->data as $match) {
            $thrown = $match[self::THROWN];

            $desiredOutcome = $guideKey[$match[self::EXPECTED_OUTCOME]];

            $mine = self::WANTED_THROW[$desiredOutcome][$thrown];
            var_dump("Mine: $mine, Thrown: $thrown, DesiredOutcome: $desiredOutcome");

            $mineWorth = self::WORTH[$mine];
            $outcomeWorth = self::OUTCOMES_WORTH[$desiredOutcome];
            $matchWorth = $mineWorth + $outcomeWorth;
            var_dump("MineWorth: $mineWorth, OutcomeWorth: $outcomeWorth, Total: $matchWorth");
            $total += $matchWorth;
        }

        if ($total <= 13038 || $total >= 13404) {
            echo "Bad answer, out of range" . PHP_EOL;
            die;
        } else
        return 'Day Two - Total: '.$total;
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
                $outcome
            ] = explode(' ', $row);
            $pairs[] = [self::THROWN => $thrown, self::EXPECTED_OUTCOME => $outcome];
        }

        return $pairs;
    }
}
