<?php
namespace Service\OpenWeather\Client;

use GuzzleHttp\Client;

use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\Request;

use function GuzzleHttp\Psr7\stream_for;
use function GuzzleHttp\json_encode;
use function GuzzleHttp\json_decode;

use Service\OpenWeather\Result\CityWeather;
use Service\OpenWeather\Result\CityWeatherResult;

class OpenWeatherClient extends Client implements
    OpenWeatherClientInterface
{
    use ClientRequestTrait;

    /**
     * @var Uri
     */
    private $url;

    /**
     * @var string
     */
    private $apiToken;
    
    public function setUrl(Uri $url)
    {
        $this->url = $url;
        return $this;
    }

    public function setApiToken(?string $apiToken)
    {
        $this->apiToken = $apiToken;
        return $this;
    }

    /**
     * @param string $city
     * 
     * @throws Exception\NotFoundException
     * @throws Exception\ApiException
     * 
     * @return CityWeather
     */
    public function queryCityWeather(string $location): CityWeather
    {
        $url = $this->url->withPath("/data/2.5/weather");

        $url = Uri::withQueryValues($url, [
            'appid' => $this->apiToken,
            'q' => $location
        ]);

        $request = (new Request('GET', $url));

        $response = $this->send($request);
        $responseData = json_decode($response->getBody()->getContents(), true);

        return (new CityWeatherResult($responseData));
    }
}
