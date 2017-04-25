<?php
declare(strict_types=1);

namespace Noldors\CommerceMLParser\Models;

use Noldors\Collections\Collection;
use Noldors\CommerceMLParser\Models\ComplexTypes\PriceType;

/**
 * Типы цен.
 *
 * @package Noldors\CommerceMLParser\Models
 */
class Prices
{
    /**
     * Коллекция типов цен.
     *
     * @var \Noldors\Collections\Collection
     */
    protected $prices;

    /**
     * Prices constructor.
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (is_null($xml)) {
            return;
        }

        $this->prices = new Collection();

        foreach ($xml->ТипЦены as $price) {
            $this->prices->push(new PriceType($price));
        }
    }

    /**
     * Получить коллекцию всех типов цен.
     *
     * @return \Noldors\Collections\Collection
     */
    public function getPrices()
    {
        return $this->prices;
    }
}