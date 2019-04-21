<?php
namespace Umbra\Symfony\Http\Response;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Umbra\Exception\PublicExceptionInterface;
use Umbra\Exception\MultipleErrorsExceptionInterface;
use Umbra\Api\ErrorResponseData;

use Throwable;

class ExceptionResponseBuilder implements ExceptionResponseBuilderInterface
{
    /**
     * @var Throwable
     */
    private $exception;

    /**
     * @var bool
     */
    private $debug = false;

    /**
     * @var string
     */
    private static $defaultMessage = 'Something went wrong.';

    /**
     * @var int
     */
    private static $defaultCode = Response::HTTP_INTERNAL_SERVER_ERROR;

    public function setException(Throwable $e): object
    {
        $this->exception = $e;
        return $this;
    }

    public function setDebug(bool $debug): object
    {
        $this->debug = $debug;
        return $this;
    }

    public function getResponse(): Response
    {
        $data = new ErrorResponseData($this->getMessage());

        if ($this->debug) {
            $data->setDebugData($this->exception);
        }

        return new JsonResponse($data, $this->getStatusCode());
    }

    private function getMessage()
    {
        $exception = $this->exception;
        $message = self::$defaultMessage;

        if ($exception instanceof PublicExceptionInterface || $this->debug) {
            $message = $exception->getMessage();
        }
        if ($exception instanceof MultipleErrorsExceptionInterface) {
            $message = $exception->getErrors();
        }

        return $message;
    }

    private function getStatusCode()
    {
        if (!$this->exception instanceof HttpExceptionInterface) {
            return self::$defaultCode;
        }

        return $this->exception->getStatusCode();
    }
}
