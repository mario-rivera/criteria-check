<?php
namespace Umbra\Symfony\ExceptionHandler;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Psr\Log\LoggerInterface;
use Monolog\Logger;

use Umbra\Symfony\Exception\MultipleErrorsExceptionInterface;

use Throwable;


class ExceptionLogger
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function handleExceptionEvent(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $this->logException($exception);
    }

    public function logException(Throwable $exception)
    {
        $level = Logger::ERROR;

        $context = ['trace' => $exception->getTrace()];
        if ($exception instanceof MultipleErrorsExceptionInterface) {
            $context['errors'] = $exception->getErrors();
        }
        // sort the keys of the context array
        ksort($context);

        $this->logger->log($level, $exception->getMessage(), $context);
    }
}
