<?php
namespace Umbra\Symfony\ExceptionHandler\ErrorSchema;

use Exception;

interface ErrorAbstractionInterface
{
    public function __construct(Exception $previous, $message = null);
    public function getOriginalTrace(): array;
}
