<?php
namespace Service\OpenWeather\Client;

use GuzzleHttp\Psr7\Uri;

class OpenWeatherClientFactory
{
    /**
     * @param array $options
     * @return OpenWeatherClientInterface
     */
    public function create(array $options): OpenWeatherClientInterface
    {
        $baseUrl = new Uri($options['base_uri']);

        $client = new OpenWeatherClient([
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);

        $client
        ->setUrl($baseUrl)
        ->setApiToken($options['api_token']);

        return $client;
    }
}
