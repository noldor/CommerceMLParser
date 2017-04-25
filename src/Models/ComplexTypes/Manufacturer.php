<?php

namespace Noldors\CommerceMLParser\Models\ComplexTypes;

/**
 * Производитель.
 *
 * @package Noldors\CommerceMLParser\Models
 */
class Manufacturer
{
    /**
     * Страна производителя.
     *
     * @var string
     */
    protected $country;

    /**
     * Торговая марка.
     *
     * @var string
     */
    protected $tradeMark;

    /**
     * Владелец торговой марки.
     *
     * @var \Noldors\CommerceMLParser\Models\Types\Partner
     */
    protected $tradeMarkOwner;

    /**
     * Изготовитель.
     *
     * @var \Noldors\CommerceMLParser\Models\Types\Partner
     */
    protected $manufacturer;

    /**
     * Manufacturer constructor.
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (is_null($xml)) {
            return;
        }

        $this->country = (string)$xml->Страна;
        $this->tradeMark = (string)$xml->ТорговаяМарка;

        if ($xml->ВладелецТорговойМарки) {
            $this->tradeMarkOwner = new Partner($xml->ВладелецТорговойМарки);
        }

        if ($xml->Изготовитель) {
            $this->manufacturer = new Partner($xml->Изготовитель);
        }
    }

    /**
     * Получить страну.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Получить торговую марку.
     *
     * @return string
     */
    public function getTradeMark()
    {
        return $this->tradeMark;
    }

    /**
     * Получить владельца торговой марки.
     *
     * @return \Noldors\CommerceMLParser\Models\Types\Partner
     */
    public function getTradeMarkOwner()
    {
        return $this->tradeMarkOwner;
    }

    /**
     * Получить изготовителя.
     *
     * @return \Noldors\CommerceMLParser\Models\Types\Partner
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }
}