<?php
namespace App\Tests\Service\CriteriaCheck\CityWeather;

use Service\CriteriaCheck\CityWeather\CriteriaManager;

use Service\OpenWeather\Client\OpenWeatherClientInterface;
use Service\CriteriaCheck\CityWeather\CriteriaResponse;
use Service\CriteriaCheck\CityWeather\WeatherCriterionInterface;
use Service\OpenWeather\Result\CityWeather;
use Service\OpenWeather\Client\Exception\NotFoundException;
use Service\CriteriaCheck\Exception\CityNotFound;

class CriteriaManagerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $testInstance;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $openWeatherClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $criteriaResponseMock;
    
    public function setUp(): void
    {
        $this->openWeatherClientMock = $this->createMock(OpenWeatherClientInterface::class);

        $this->criteriaResponseMock = $this->createMock(CriteriaResponse::class);

        $this->testInstance = $this->getMockBuilder(CriteriaManager::class)
        ->disableOriginalClone()
        ->setMethods(null)
        ->setConstructorArgs([
            $this->openWeatherClientMock,
            $this->criteriaResponseMock
        ])
        ->getMock();
    }

    public function testCheck()
    {
        $criterionMock = $this->createMock(WeatherCriterionInterface::class);
        $cityWeatherMock = $this->createMock(CityWeather::class);

        $this->testInstance->setCriteria([$criterionMock, $criterionMock, $criterionMock]);

        $this->openWeatherClientMock->expects($this->once())
        ->method('queryCityWeather')
        ->with($this->isType('string'))
        ->willReturn($cityWeatherMock);

        $this->criteriaResponseMock->expects($this->exactly(3))
        ->method('walkCriterion')
        ->with(
            $this->isInstanceOf(WeatherCriterionInterface::class),
            $this->isType('int'),
            $this->equalTo($cityWeatherMock)
        );

        $result = $this->testInstance->check('foo');

        $this->assertInstanceOf(CriteriaResponse::class, $result);
    }

    public function testCheckLocationNotFound()
    {
        $psrResponse = $this->createMock(\Psr\Http\Message\ResponseInterface::class);

        $this->openWeatherClientMock->expects($this->once())
        ->method('queryCityWeather')
        ->with($this->isType('string'))
        ->will(
            $this->throwException(new NotFoundException('', $psrResponse))
        );

        $this->criteriaResponseMock->expects($this->exactly(0))
        ->method('walkCriterion');

        $this->expectException(CityNotFound::class);

        $this->testInstance->check('foo');
    }
}
