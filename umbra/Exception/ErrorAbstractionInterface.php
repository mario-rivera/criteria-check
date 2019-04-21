<?php
namespace Umbra\Exception;

use Exception;

interface ErrorAbstractionInterface
{
    public function __construct(Exception $previous, $message = null);
    public function getOriginalTrace(): array;
}
