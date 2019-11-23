<?php
namespace Umbra\Symfony\Exception;

use Umbra\Component\HttpKernel\Exception\NotFoundHttpException;

class EntityNotFoundException extends NotFoundHttpException implements
    PublicExceptionInterface
{

}
