<?php
namespace Service\OpenWeather\Result;

class CityWeatherResult implements
    CityWeather
{
    use HasDataTrait;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->getData('name', $this->data);
    }

    /**
     * @return float|null
     */
    public function getTemperature(): ?float
    {
        $temp = null;
        $main = $this->getData('main', $this->data);
        if (!is_null($main)) {
            $temp = $this->getData('temp', $main);
        }

        return $temp;
    }

    /**
     * @return int|null
     */
    public function getSunrise(): ?int
    {
        $time = null;
        $sys = $this->getData('sys', $this->data);
        if (!is_null($sys)) {
            $time = $this->getData('sunrise', $sys);
        }

        return $time;
    }

    /**
     * @return int|null
     */
    public function getSunset(): ?int
    {
        $time = null;
        $sys = $this->getData('sys', $this->data);
        if (!is_null($sys)) {
            $time = $this->getData('sunset', $sys);
        }

        return $time;
    }
}
