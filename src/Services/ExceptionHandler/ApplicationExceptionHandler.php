<?php
namespace App\Services\ExceptionHandler;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpFoundation\Response;

use Umbra\Symfony\Exception\HttpException;

class ApplicationExceptionHandler
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    public function __construct(
        KernelInterface $kernel
    ) {
        $this->kernel = $kernel;
    }

    public function handleExceptionEvent(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        $debug = $this->kernel->isDebug();
        $message = $exception->getMessage();

        switch ($exception) {
            default:
        }
    }
}
