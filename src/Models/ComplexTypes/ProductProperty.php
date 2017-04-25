<?php

namespace Noldors\CommerceMLParser\Models\ComplexTypes;

/**
 * Тип характеристика товара.
 *
 * @package Noldors\CommerceMLParser\Models\ComplexTypes
 */
class ProductProperty
{
    /**
     * Xml id.
     *
     * @var string
     */
    protected $id;

    /**
     * Название.
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
     * ProductProperty constructor.
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (is_null($xml)) {
            return;
        }

        $this->id = (string)$xml->Ид;
        $this->name = (string)$xml->Наименование;
        $this->value = (string)$xml->Значение;
    }

    /**
     * Получить Xml id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Получить название.
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