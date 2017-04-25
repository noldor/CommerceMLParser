<?php

namespace Noldors\CommerceMLParser\Models\ComplexTypes;

use Noldors\CommerceMLParser\Models\Types\AddressType;

/**
 * Тип адрес.
 * @package Noldors\CommerceMLParser\Models\ComplexTypes
 */
class Address
{
    /**
     * Строковое представление адреса.
     *
     * @var string
     */
    protected $name;

    /**
     * Произвольный комментарий.
     *
     * @var string
     */
    protected $comment;

    /**
     * Структурированный адрес.
     *
     * @var \Noldors\CommerceMLParser\Models\Types\AddressType
     */
    protected $address;

    /**
     * Address constructor.
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (is_null($xml)) {
            return;
        }

        $this->name = (string)$xml->Представление;
        $this->comment = (string)$xml->Комментарий;
        if ($xml->АдресноеПоле) {
            $this->address = new AddressType($xml);
        }
    }

    /**
     * Получить строковое представление адреса.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Получить комментарий.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Получить структурированный адрес.
     *
     * @return \Noldors\CommerceMLParser\Models\Types\AddressType
     */
    public function getAddress()
    {
        return $this->address;
    }
}