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

    public function __construct()
    {
        parent::__construct();

        $testInputPath = self::EXAMPLE_INPUTS_BASE."/{$this->shortName}.{$this->fileType}";
        $this->exampleInputData = self::processInput($testInputPath);

        $inputPath = self::INPUTS_BASE."/{$this->shortName}.{$this->fileType}";
        $this->inputData = self::processInput($inputPath);
    }

    public function __invoke(
        ?string $parts = 'both',
        ?string $dataset = 'example',
    ): string
    {
        $this->data = match ($dataset) {
            'real' => $this->inputData,
            default => $this->exampleInputData,
        };

        return match (strtolower($parts)) {
            'one' => $this->partOne(),
            'two' => $this->partTwo(),
            default => $this->partOne() && $this->partTwo(),
        };
    }

    abstract protected function partOne(): string;
    abstract protected function partTwo(): string;

    protected function processInput(string $inputPath): ?array
    {
        $fileContent = file_get_contents($inputPath);

        if (!$fileContent) {
            return null;
        }

        return $this->processInputString($fileContent);
    }

    abstract public function processInputString(string $stringInput): array;
}