<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\Exception;

class CommandQueryValidatorException extends \InvalidArgumentException
{
    public function __construct(private readonly array $errors)
    {
        parent::__construct(array_values($this->errors)[0], 400);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
