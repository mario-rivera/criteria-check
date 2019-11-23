<?php
namespace Umbra\Symfony\Exception;

interface MultipleErrorsExceptionInterface
{
    public function getErrors(): array;
}
