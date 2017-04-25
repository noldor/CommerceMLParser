<?php

namespace Noldors\CommerceMLParser\Models\ComplexTypes;

/**
 * Тип значение реквизита.
 *
 * @package Noldors\CommerceMLParser\Models\ComplexTypes
 */
class RequisiteValue
{
    /**
     * Наименование.
     *
     * @var string
     */
    protected $name;

    /**
     * Значение.
     *
     * @var string
     */
    protected $value;

    /**
     * RequisiteValue constructor.
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (is_null($xml)) {
            return;
        }

        $this->name = (string)$xml->Наименование;
        $this->value = (string)$xml->Значение;
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
     * Получить значение.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}