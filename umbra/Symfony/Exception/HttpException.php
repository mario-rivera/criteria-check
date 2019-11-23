<?php
namespace Umbra\Symfony\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException as SymfonyHttpException;

class HttpException extends SymfonyHttpException implements
    PublicExceptionInterface
{
    
}
