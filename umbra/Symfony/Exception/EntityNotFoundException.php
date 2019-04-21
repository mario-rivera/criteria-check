<?php
namespace Umbra\Symfony\Exception;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Umbra\Exception\PublicExceptionInterface;

class EntityNotFoundException extends NotFoundHttpException implements
    PublicExceptionInterface
{

}
