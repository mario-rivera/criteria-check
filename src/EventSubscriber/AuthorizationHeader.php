<?php
namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ControllerEvent;

use Umbra\Symfony\Http\Authorization\AuthenticatedControllerFilter;

class AuthorizationHeader implements EventSubscriberInterface
{
    /**
     * @var AuthenticatedControllerFilter
     */
    private $controllerFilter;

    public function __construct(AuthenticatedControllerFilter $controllerFilter)
    {
        $this->controllerFilter = $controllerFilter;
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => 'onKernelController',
        );
    }

    public function onKernelController(ControllerEvent $event)
    {
        $this->controllerFilter->filter($event);
    }
}
