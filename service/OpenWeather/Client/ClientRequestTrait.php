<?php
namespace Service\OpenWeather\Client;

use function GuzzleHttp\json_decode;

use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Exception\BadResponseException;

trait ClientRequestTrait
{
    public function send(RequestInterface $request, array $options = [])
    {
        try {
            $response = parent::send($request, $options);
        } catch(BadResponseException $e) {
            $response = $e->getResponse();

            $data = json_decode($response->getBody()->getContents(), true);
            $message = isset($data['message']) ? $data['message'] : 'Unknown error';

            switch ($response->getStatusCode()) {
                case 404:
                    throw new Exception\NotFoundException($message, $response);
                    break;

                default:
                    throw new Exception\ApiException($message, $response);
            }
        }

        return $response;
    }
}
