<?php
namespace App\Tests\Service\OpenWeather;

use Service\OpenWeather\Client\OpenWeatherClient;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Service\OpenWeather\Result\CityWeatherResult;

class OpenWeatherClientTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $testInstance;
   
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $urlMock;

    public function setUp(): void
    {
        $this->urlMock = $this->createMock(Uri::class);

        $this->testInstance = $this->getMockBuilder(OpenWeatherClient::class)
        ->disableOriginalClone()
        ->setMethods([
            'send'
        ])
        ->setConstructorArgs([])
        ->getMock();

        $this->testInstance->setUrl($this->urlMock);
        $this->testInstance->setApiToken('foo');
    }

    public function testQueryCityWeather()
    {
        $location = 'bar';

        $responseMock = $this->createMock(ResponseInterface::class);
        $streamInterfaceMock = $this->createMock(StreamInterface::class);

        $responseMock->expects($this->exactly(1))
        ->method('getBody')
        ->willReturn($streamInterfaceMock);

        $streamInterfaceMock->expects($this->exactly(1))
        ->method('getContents')
        ->willReturn('[]');

        $this->urlMock->expects($this->exactly(1))
        ->method('withPath')
        ->with($this->isType('string'))
        ->willReturn($this->urlMock);

        $this->testInstance->expects($this->exactly(1))
        ->method('send')
        ->with($this->isInstanceOf(\Psr\Http\Message\RequestInterface::class))
        ->willReturn($responseMock);

        $result = $this->testInstance->queryCityWeather($location);

        $this->assertInstanceOf(CityWeatherResult::class, $result);
    }
}
