<?php

namespace Noldors\CommerceMLParser\Models\ComplexTypes;

/**
 * Тип значение свойства.
 *
 * @package Noldors\CommerceMLParser\Models\ComplexTypes
 */
class PropertyValue
{
    /**
     * Xml id значения свойства.
     *
     * @var string
     */
    protected $id;

    /**
     * Наименование свойства.
     *
     * @var string
     */
    protected $name;

    /**
     * Значение свойства.
     *
     * @var string
     */
    protected $value;

    /**
     * PropertyValue constructor.
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
     * Получить xml id свойства.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Получить название свойства.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Получить значение свойства.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}