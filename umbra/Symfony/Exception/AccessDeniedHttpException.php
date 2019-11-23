<?php
namespace Umbra\Symfony\Exception;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException as ParentException;

class AccessDeniedHttpException extends ParentException implements
    PublicExceptionInterface
{

}
