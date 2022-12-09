<?php

namespace App\PuzzleSolvers\Abstracts;

use ReflectionClass;

abstract class AdventSolver extends Solver
{
    const CLASS_TEMPLATE_FILE = __ROOT__.'/Resources/AdventSolver.php.template';
    const SOLVER_DIR = __ROOT__.'/src/PuzzleSolvers';

    const EXAMPLE_INPUTS_BASE = self::INPUT_BASE_DIR.'/ExampleInputs';
    const INPUTS_BASE = self::INPUT_BASE_DIR.'/Inputs';

    const EXAMPLE_DATA_REFERENCE = 'example';
    const GENERATED_DATA_REFERENCE = 'real';

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
        ?string $dataset = 'example',
    ): string
    {
        $this->data = match ($dataset) {
            static::GENERATED_DATA_REFERENCE => $this->inputData ?? [],
            default => $this->exampleInputData ?? [],
        };

        return $this->partOne() . PHP_EOL . $this->partTwo();
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

    abstract public function processInputString(string $inputPath): ?array;

    public static function makeNew(string $className): string
    {
        $newClassFile = file_get_contents(self::CLASS_TEMPLATE_FILE);
        $newClassFile = str_replace('CLASS_NAME', $className, $newClassFile);
        $newClassFile = str_replace('NEW_TODO', 'TODO', $newClassFile);

        $filesCreated = file_put_contents(self::SOLVER_DIR."/{$className}.php", $newClassFile);
        $filesCreated &= touch(self::EXAMPLE_INPUTS_BASE."/{$className}.txt");
        $filesCreated &= touch(self::INPUTS_BASE."/{$className}.txt");
        return $filesCreated
            ? "Created new AdventSolver: $className"
            : "Failed to create new AdventSolver: {$className}";
    }
}