<?php

namespace App\PuzzleControllers\Abstracts;

use ReflectionClass;

abstract class AbstractDay
{
    const INPUT_BASE_DIR = __DIR__.'/Resources';

    private string $shortName;
    private string $fileType = 'txt';

    private ?array $testData;
    private ?array $data;

    abstract public function partOne(array $data): string;
    abstract public function partTwo(array $data): string;

    public function __construct()
    {
        $this->shortName = (new ReflectionClass(self::class))->getShortName();

        $testInputPath = self::INPUT_BASE_DIR."/ExampleInputs/{$this->shortName}.{$this->fileType}";
        $this->testData = self::processInput($testInputPath);

        $inputPath = self::INPUT_BASE_DIR."/Inputs/{$this->shortName}.{$this->fileType}";
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