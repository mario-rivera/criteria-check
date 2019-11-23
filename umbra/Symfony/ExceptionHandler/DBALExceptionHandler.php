<?php
namespace Umbra\Symfony\ExceptionHandler;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Exception\ConnectionException;
use Doctrine\DBAL\Exception\DatabaseObjectNotFoundException;
use Doctrine\DBAL\Exception\TableNotFoundException;
use Doctrine\DBAL\Exception\InvalidFieldNameException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

use Umbra\Symfony\Exception\HttpException;

class DBALExceptionHandler
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
        if (!$exception instanceof DBALException) {
            return;
        }

        $debug = $this->kernel->isDebug();
        $message = $exception->getMessage();

        switch ($exception) {
            case $exception instanceof ConnectionException:
                $debug ?: $message = "Indicates problems with connection to the database.";
                $event->setThrowable(new HttpException(Response::HTTP_SERVICE_UNAVAILABLE, $message, $exception));
                break;

            case $exception instanceof InvalidFieldNameException:
            case $exception instanceof TableNotFoundException:
                $debug ?: $message = "Indicates problems with the database structure.";
                $event->setThrowable(new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $message, $exception));
                break;
            case $exception instanceof UniqueConstraintViolationException:
                $debug ?: $message = "One or more fields in the request already exist in the databse and should be unique.";
                $event->setThrowable(new HttpException(Response::HTTP_BAD_REQUEST, $message, $exception));
                break;
            default:
                $debug ?: $message = "Database operation failed. Unknown error type.";
                $event->setThrowable(new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $message, $exception));
        }
    }
}
