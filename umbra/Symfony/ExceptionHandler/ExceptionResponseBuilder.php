<?php
namespace Umbra\Symfony\ExceptionHandler;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Umbra\Symfony\Exception\PublicExceptionInterface;
use Umbra\Symfony\Exception\MultipleErrorsExceptionInterface;
use Throwable;

class ExceptionResponseBuilder
{
    /**
     * @var int
     */
    private static $defaultCode = Response::HTTP_INTERNAL_SERVER_ERROR;

    /**
     * @var string
     */
    private static $defaultMessage = 'Something went wrong.';

    public function getResponse(Throwable $exception, bool $debug = false): Response
    {
        $data = new ErrorSchema\ErrorContainer($this->getMessage($exception, $debug));

        if ($debug) {
            $data->setDebugData($exception);
        }

        return new JsonResponse($data, $this->getStatusCode($exception));
    }

    private function getMessage(Throwable $exception, bool $debug)
    {
        $message = self::$defaultMessage;

        if ($exception instanceof PublicExceptionInterface || $debug) {
            $message = $exception->getMessage();
            
            if ($exception instanceof MultipleErrorsExceptionInterface) {
                $message = $exception->getErrors();
            }
        }

        return $message;
    }

    private function getStatusCode(Throwable $exception)
    {
        if (!$exception instanceof HttpExceptionInterface) {
            return self::$defaultCode;
        }

        return $exception->getStatusCode();
    }
}
