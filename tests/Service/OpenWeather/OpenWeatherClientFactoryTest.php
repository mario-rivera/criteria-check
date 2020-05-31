<?php
namespace App\Tests\Service\OpenWeather;

use Service\OpenWeather\Client\OpenWeatherClientFactory;

use Service\OpenWeather\Client\OpenWeatherClientInterface;

class OpenWeatherClientFactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $testInstance;

    public function setUp(): void
    {
        $this->testInstance = $this->getMockBuilder(OpenWeatherClientFactory::class)
        ->disableOriginalClone()
        ->setMethods(null)
        ->setConstructorArgs([])
        ->getMock();
    }

    public function testCreate(): void
    {
        $options = [
            'base_uri' => 'http://foo.bar',
            'api_token' => 'foobarbat'
        ];

        $result = $this->testInstance->create($options);

        $this->assertInstanceOf(OpenWeatherClientInterface::class, $result);
    }

    public function testCreateMissingParameters(): void
    {
        $options = [
            'api_token' => 'foobarbat'
        ];

        $this->expectException(\PHPUnit\Framework\Error\Notice::class);

        $this->testInstance->create($options);
    }
}

