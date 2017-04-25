<?php

namespace Noldors\CommerceMLParser\Models\ComplexTypes;

use Noldors\CommerceMLParser\Models\Types\Unit;

/**
 * Тип цена.
 *
 * @package Noldors\CommerceMLParser\Models\ComplexTypes
 */
class Price
{
    /**
     * Представление цены.
     *
     * @var string
     */
    protected $view;

    /**
     * Код валюты.
     *
     * @var string
     */
    protected $priceTypeId;

    /**
     * Цена за единицу.
     *
     * @var float
     */
    protected $pricePerUnit;

    /**
     * Валюта.
     *
     * @var string
     */
    protected $currency;

    /**
     * Единица измерения.
     *
     * @var string
     */
    protected $unit;

    /**
     * Минимальное количество.
     *
     * @var int
     */
    protected $minQuantity;

    /**
     * Xml id каталога.
     *
     * @var string
     */
    protected $catalogId;

    /**
     * Price constructor.
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (is_null($xml)) {
            return;
        }

        $this->view = (string)$xml->Представление;
        $this->priceTypeId = (string)$xml->ИдТипаЦены;
        $this->pricePerUnit = (string)$xml->ЦенаЗаЕдиницу;
        $this->currency = (string)$xml->Валюта;
        if ($xml->ЕдиницаИзмерения) {
            $this->unit = new Unit($xml->ЕдиницаИзмерения);
        }
        $this->minQuantity = (string)$xml->МинКоличество;
        $this->catalogId = (string)$xml->ИдКаталога;
    }

    /**
     * Получить предстваление цены.
     *
     * @return string
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Получить код валюты.
     *
     * @return string
     */
    public function getPriceTypeId()
    {
        return $this->priceTypeId;
    }

    /**
     * Получить цену за единицу товара.
     *
     * @return float
     */
    public function getPricePerUnit()
    {
        return $this->pricePerUnit;
    }

    /**
     * Получить валюту.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Получить хз
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Получить минимальное количество.
     *
     * @return int
     */
    public function getMinQuantity()
    {
        return $this->minQuantity;
    }

    /**
     * Получить xml id каталога.
     *
     * @return string
     */
    public function getCatalogId()
    {
        return $this->catalogId;
    }
}