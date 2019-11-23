<?php
namespace App\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;

use Umbra\Symfony\Http\Response\ExceptionResponseBuilderInterface;

class KernelExceptions implements EventSubscriberInterface
{
    /**
     * @var KernelInterface
     */
    private $kernel;
    
    /**
     * @var ExceptionResponseBuilderInterface
     */
    private $responseBuilder;

    public function __construct(
        KernelInterface $kernel,
        ExceptionResponseBuilderInterface $responseBuilder
    ) {
        $this->kernel = $kernel;
        $this->responseBuilder = $responseBuilder;
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::EXCEPTION => 'onKernelException',
        );
    }

    public function onKernelException(ExceptionEvent $event)
    {
        // You get the exception object from the received event
        $this->responseBuilder->setException($event->getThrowable());
        $this->responseBuilder->setDebug($this->kernel->isDebug());

        $event->setResponse($this->responseBuilder->getResponse());
    }
}
