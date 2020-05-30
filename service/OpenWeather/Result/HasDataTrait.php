<?php
namespace Service\OpenWeather\Result;

trait HasDataTrait
{
    /**
     * @var array $data
     */
    private $data;

    /**
     * @param string $key
     * @param array $source
     */
    public function getData(string $key, array $source = [])
    {
        return array_key_exists($key, $source) ? $source[$key] : null;
    }
}
