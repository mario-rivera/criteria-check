<?php
namespace Umbra\Symfony\Exception;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException as ParentException;

use Umbra\Exception\PublicExceptionInterface;

class AccessDeniedHttpException extends ParentException implements
    PublicExceptionInterface
{

}
