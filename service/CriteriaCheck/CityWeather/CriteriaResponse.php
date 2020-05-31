<?php
namespace Service\CriteriaCheck\CityWeather;

use Service\OpenWeather\Result\CityWeather;
use JsonSerializable;

class CriteriaResponse implements
    JsonSerializable
{
    /**
     * @var array
     */
    private $criteria = [];

    /**
     * @var array
     */
    private $and = [];

    /**
     * @var array
     */
    private $or = [];

    /**
     * @param WeatherCriterionInterface $criterion
     * @param int $index
     * @param CityWeather $cityWeather
     */
    public function walkCriterion(WeatherCriterionInterface $criterion, $index, CityWeather $cityWeather)
    {
        $check = $criterion->check($cityWeather);

        $this->criteria[$criterion->getAlias()] = $check;

        switch (strtolower($criterion->getLogicalOperator())) {

            case 'or':
                $this->addOrCheck($check);
                break;
            default:
                $this->addAndCheck($check);
        }
    }

    /**
     * @param bool $check
     * @return void
     */
    public function addAndCheck(bool $check): void
    {
        $this->and[] = $check;
    }

    /**
     * @param bool $check
     * @return void
     */
    public function addOrCheck(bool $check): void
    {
        $this->or[] = $check;
    }

    /**
     * @return bool
     */
    public function calculateCheck(): bool
    {
        $and = true;
        $or = true;

        foreach ($this->and as $check) {
            if (!$check) {
                $and = $check;
                break;
            }
        }

        foreach ($this->or as $check) {
            $or = $check;
            if ($or) {
                break;
            }
        }

        return ($and and $or);
    }

    public function jsonSerialize()
    {
        $checkKey = ($this->calculateCheck()) ? 'check' : 'error';

        return [
            $checkKey => true,
            'criteria' => $this->criteria
        ];
    }
}
