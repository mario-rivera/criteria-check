<?php
namespace Service\OpenWeather\Client\Exception;

use Psr\Http\Message\ResponseInterface;

class ApiException extends \RuntimeException
{
    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(
        $message = '', 
        ResponseInterface $response, 
        $code = 0, 
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }
}
