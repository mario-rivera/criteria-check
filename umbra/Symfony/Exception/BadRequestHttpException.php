<?php
namespace Umbra\Symfony\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException as ParentException;
use Umbra\Exception\PublicExceptionInterface;

class BadRequestHttpException extends ParentException implements
    PublicExceptionInterface
{

}
