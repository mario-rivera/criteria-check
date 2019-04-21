<?php
namespace Umbra\Exception;

use Umbra\Exception\ErrorList;

interface MultipleErrorsExceptionInterface
{
    public function getErrors(): ErrorList;
}
