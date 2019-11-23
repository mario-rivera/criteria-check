<?php
namespace Umbra\Symfony\Http\Authorization;

use Symfony\Component\HttpKernel\Event\ControllerEvent;

use Umbra\Symfony\Exception\AccessDeniedHttpException;

interface AuthenticatedControllerFilterInterface
{
    /**
     * @throws AccessDeniedHttpException
     */
    public function filter(ControllerEvent $event);
}
