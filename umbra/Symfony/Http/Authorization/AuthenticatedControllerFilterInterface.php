<?php
namespace Umbra\Symfony\Http\Authorization;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Umbra\Symfony\Exception\AccessDeniedHttpException;

interface AuthenticatedControllerFilterInterface
{
    /**
     * @throws AccessDeniedHttpException
     */
    public function filter(FilterControllerEvent $event);
}
