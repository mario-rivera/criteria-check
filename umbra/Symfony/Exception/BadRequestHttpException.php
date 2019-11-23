<?php
namespace Umbra\Symfony\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException as ParentException;

class BadRequestHttpException extends ParentException implements
    PublicExceptionInterface
{

}
