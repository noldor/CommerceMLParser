<?php

namespace Noldors\CommerceMLParser\Models\ComplexTypes;

/**
 * Тип остаток на складе.
 *
 * @package Noldors\CommerceMLParser\Models\ComplexTypes
 */
class StockBalance
{
    /**
     * Xml id склада.
     *
     * @var string
     */
    protected $stockId;

    /**
     * Количество на складе.
     *
     * @var float
     */
    protected $quantity;

    /**
     * StockBalance constructor.
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (is_null($xml)) {
            return;
        }

        $this->stockId = (string)$xml->ИдСклада;
        $this->quantity = (float)$xml->КоличествоНаСкладе;
    }

    /**
     * Получить xml id склада.
     *
     * @return string
     */
    public function getStockId()
    {
        return $this->stockId;
    }

    /**
     * Получить количество на складе.
     *
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}