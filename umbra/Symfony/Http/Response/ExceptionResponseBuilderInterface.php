<?php
namespace Umbra\Symfony\Http\Response;

use Symfony\Component\HttpFoundation\Response;
use Throwable;

interface ExceptionResponseBuilderInterface
{
    public function setException(Throwable $e): object;
    public function setDebug(bool $debug): object;
    
    public function getResponse(): Response;
}
