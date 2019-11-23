<?php
namespace App\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;

use Umbra\Symfony\ExceptionHandler\ExceptionLogger;
use Umbra\Symfony\ExceptionHandler\ExceptionResponseBuilder;

use App\Services\ExceptionHandler\ApplicationExceptionHandler;

class KernelExceptions implements EventSubscriberInterface
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var ExceptionLogger
     */
    private $exceptionLogger;
    
    /**
     * @var ExceptionResponseBuilder
     */
    private $responseBuilder;

    /**
     * @var ApplicationExceptionHandler
     */
    private $applicationExceptionHandler;

    public function __construct(
        KernelInterface $kernel,
        ExceptionResponseBuilder $responseBuilder,
        ExceptionLogger $exceptionLogger,
        ApplicationExceptionHandler $applicationExceptionHandler
    ) {
        $this->kernel = $kernel;
        $this->responseBuilder = $responseBuilder;
        $this->exceptionLogger = $exceptionLogger;
        $this->applicationExceptionHandler = $applicationExceptionHandler;
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::EXCEPTION => [
                ['logException', 10],
                ['filterException', 9],
                ['setExceptionResponse', -10]
            ],
        );
    }

    public function logException(ExceptionEvent $event)
    {
        // log exception before manipulating it
        $this->exceptionLogger->logException($event->getThrowable());
    }

    public function filterException(ExceptionEvent $event)
    {
        // replace event exception if needed
        $this->applicationExceptionHandler->handleExceptionEvent($event);
    }

    public function setExceptionResponse(ExceptionEvent $event)
    {
        // You get the exception object from the received event
        $response = $this->responseBuilder->getResponse($event->getThrowable(), $this->kernel->isDebug());
        $event->setResponse($response);
    }
}
