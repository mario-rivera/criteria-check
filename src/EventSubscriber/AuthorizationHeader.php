<?php
namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

use Umbra\Symfony\Http\Authorization\AuthenticatedControllerFilterInterface;

class AuthorizationHeader implements EventSubscriberInterface
{
    /**
     * @var AuthenticatedControllerFilterInterface
     */
    private $controllerFilter;

    public function __construct(AuthenticatedControllerFilterInterface $controllerFilter)
    {
        $this->controllerFilter = $controllerFilter;
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => 'onKernelController',
        );
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $this->controllerFilter->filter($event);
    }
}
