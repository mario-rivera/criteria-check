<?php
namespace App\Tests\Service\CriteriaCheck\CityWeather\Criterion;

use Service\CriteriaCheck\CityWeather\Criterion\Rival;

use Service\OpenWeather\Result\CityWeather;
use Service\OpenWeather\Client\OpenWeatherClientInterface;

class RivalTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $testInstance;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $cityWeatherMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $openWeatherClientMock;

    public function setUp(): void
    {
        $this->cityWeatherMock = $this->createMock(CityWeather::class);

        $this->openWeatherClientMock = $this->createMock(OpenWeatherClientInterface::class);

        $this->testInstance = $this->getMockBuilder(Rival::class)
        ->disableOriginalClone()
        ->setMethods(null)
        ->setConstructorArgs([
            $this->openWeatherClientMock,
        ])
        ->getMock();
    }

    public function testCriteriaPass(): void
    {
        $rivalWeatherMock = $this->createMock(CityWeather::class);

        $this->openWeatherClientMock->expects($this->once())
        ->method('queryCityWeather')
        ->with($this->isType('string'))
        ->willReturn($rivalWeatherMock);

        $this->cityWeatherMock->expects($this->exactly(1))
        ->method('getTemperature')
        ->willReturn(2);

        $rivalWeatherMock->expects($this->exactly(1))
        ->method('getTemperature')
        ->willReturn(1);

        $result = $this->testInstance->check($this->cityWeatherMock);

        $this->assertEquals(true, $result);
    }

    public function testCriteriaFail(): void
    {
        $rivalWeatherMock = $this->createMock(CityWeather::class);

        $this->openWeatherClientMock->expects($this->once())
        ->method('queryCityWeather')
        ->with($this->isType('string'))
        ->willReturn($rivalWeatherMock);

        $this->cityWeatherMock->expects($this->exactly(1))
        ->method('getTemperature')
        ->willReturn(1);

        $rivalWeatherMock->expects($this->exactly(1))
        ->method('getTemperature')
        ->willReturn(2);

        $result = $this->testInstance->check($this->cityWeatherMock);

        $this->assertEquals(false, $result);
    }
}
