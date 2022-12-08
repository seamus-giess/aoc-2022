<?php

namespace App\PuzzleSolvers\Abstracts;

use ReflectionClass;

abstract class AdventSolver extends Solver
{
    const EXAMPLE_INPUTS_BASE = self::INPUT_BASE_DIR.'/ExampleInputs';
    const INPUTS_BASE = self::INPUT_BASE_DIR.'/Inputs';

    private string $fileType = 'txt';

    protected ?array $exampleInputData;
    protected ?array $inputData;

    protected array $data;

    abstract protected function partOne(): string;
    abstract protected function partTwo(): string;

    public function __construct()
    {
        parent::__construct();

        $testInputPath = self::EXAMPLE_INPUTS_BASE."/{$this->shortName}.{$this->fileType}";
        $this->testData = self::processInput($testInputPath);

        $inputPath = self::INPUTS_BASE."/{$this->shortName}.{$this->fileType}";
        $this->data = self::processInput($inputPath);
    }

    protected function processInput(string $inputPath): ?array
    {
        $fileContent = file_get_contents($inputPath);

        if (!$fileContent) {
            return null;
        }

        return self::decodeInput($fileContent);
    }

    abstract public function decodeInput(string $stringInput): array;
}