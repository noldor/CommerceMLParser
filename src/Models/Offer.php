<?php
declare(strict_types=1);

namespace Noldors\CommerceMLParser\Models;

use Noldors\Collections\Collection;
use Noldors\CommerceMLParser\Models\ComplexTypes\Price;
use Noldors\CommerceMLParser\Models\ComplexTypes\StockBalance;

class Offer extends Product
{
    /**
     * @var Collection
     */
    protected $prices;

    /**
     * @var float
     */
    protected $quantity;

    /**
     * @var Collection
     */
    protected $stockBalances;

    public function __construct($xml)
    {
        parent::__construct($xml);

        $this->prices = new Collection();
        $this->stockBalances = new Collection();

        if ($xml->Цены) {
            foreach ($xml->Цены->Цена as $price) {
                $this->prices->push(new Price($price));
            }
        }

        $this->quantity = (string)$xml->Количество;

        if ($xml->Склад) {
            foreach ($xml->Склад as $stock) {
                $this->stockBalances->push(new StockBalance($stock));
            }
        }
    }

    /**
     * @return Collection
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return Collection
     */
    public function getStockBalances()
    {
        return $this->stockBalances;
    }
}