<?php
namespace App\Tests\Service\CriteriaCheck\CityWeather\Criterion;

use Service\CriteriaCheck\CityWeather\Criterion\Naming;

use Service\OpenWeather\Result\CityWeather;

class NamingTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $testInstance;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $cityWeatherMock;

    public function setUp(): void
    {
        $this->cityWeatherMock = $this->createMock(CityWeather::class);

        $this->testInstance = $this->getMockBuilder(Naming::class)
        ->disableOriginalClone()
        ->setMethods(null)
        ->setConstructorArgs([])
        ->getMock();
    }

    public function testCheckReturnTrue(): void
    {
        $this->cityWeatherMock->expects($this->exactly(1))
        ->method('getName')
        ->willReturn('odd');

        $result = $this->testInstance->check($this->cityWeatherMock);

        $this->assertEquals(true, $result);
    }

    public function testCheckReturnFalse(): void
    {
        $this->cityWeatherMock->expects($this->exactly(1))
        ->method('getName')
        ->willReturn('even');

        $result = $this->testInstance->check($this->cityWeatherMock);

        $this->assertEquals(false, $result);
    }
}
