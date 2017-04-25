<?php

namespace Noldors\CommerceMLParser\Models\ComplexTypes;

/**
 * Тип склад.
 *
 * @package Noldors\CommerceMLParser\Models\ComplexTypes
 */
class Stock
{
    /**
     * Xml id.
     *
     * @var string
     */
    protected $id;

    /**
     * Наименование.
     *
     * @var string
     */
    protected $name;

    /**
     * Комментарий.
     *
     * @var string
     */
    protected $comment;

    /**
     * Адрес.
     *
     * @var \Noldors\CommerceMLParser\Models\ComplexTypes\Address
     */
    protected $address;

    /**
     * Контакты.
     *
     * @var \Noldors\CommerceMLParser\Models\ComplexTypes\Contact
     */
    protected $contacts;

    /**
     * Stock constructor.
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (is_null($xml)) {
            return;
        }

        $this->id = (string)$xml->Ид;
        $this->name = (string)$xml->Наименование;
        $this->comment = (string)$xml->Комментарий;

        if ($xml->Адрес) {
            $this->address = new Address($xml->Адрес);
        }

        if ($xml->Контакты) {
            $this->contacts = new Contact($xml->Контакты);
        }
    }

    /**
     * Получить xml id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
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
     * Получить комментарий.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Получить адрес.
     *
     * @return \Noldors\CommerceMLParser\Models\ComplexTypes\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Получить контакты.
     *
     * @return \Noldors\CommerceMLParser\Models\ComplexTypes\Contact
     */
    public function getContacts()
    {
        return $this->contacts;
    }

}