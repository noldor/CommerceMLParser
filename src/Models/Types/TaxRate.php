<?php

namespace Noldors\CommerceMLParser\Models\Types;

/**
 * Ставка налога.
 *
 * @package Noldors\CommerceMLParser\Models\Types
 */
class TaxRate
{
    /**
     * Наименование.
     *
     * @var string
     */
    protected $name;

    /**
     * Ставка.
     *
     * @var string
     */
    protected $rate;

    /**
     * TaxRate constructor.
     * @param \SimpleXMLElement $xml
     */
    public function __construct(\SimpleXMLElement $xml)
    {
        $this->name = (string)$xml->Наименование;
        $this->rate = (string)$xml->Ставка;
    }

    /**
     * Получить наименование.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Получить ставку.
     *
     * @return string
     */
    public function getRate()
    {
        return $this->rate;
    }

}