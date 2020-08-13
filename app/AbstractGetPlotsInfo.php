<?php


namespace App;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class AbstractGetPlotsInfo
 * @package App
 */
abstract class AbstractGetPlotsInfo
{
    /**
     * @var string
     */
    private $url = 'http://pkk.bigland.ru/api/test/plots';

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $plots
     * @return string
     */
    abstract public function getInfo(string $plots): Collection;
}
