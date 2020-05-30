<?php
namespace Service\OpenWeather\Result;

interface CityWeather
{
    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @return float|null
     */
    public function getTemperature(): ?float;

    /**
     * @return int|null
     */
    public function getSunrise(): ?int;

    /**
     * @return int|null
     */
    public function getSunset(): ?int;
}
