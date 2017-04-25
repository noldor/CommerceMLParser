<?php

namespace Noldors\CommerceMLParser\Models\ComplexTypes;

/**
 * Тип банк.
 *
 * @package Noldors\CommerceMLParser\Models\ComplexTypes
 */
class Bank
{
    /**
     * Корреспондентский счет.
     *
     * @var string
     */
    protected $correspondentAccount;

    /**
     * Название банка.
     *
     * @var string
     */
    protected $name;

    /**
     * Адрес банка.
     *
     * @var \Noldors\CommerceMLParser\Models\ComplexTypes\Address
     */
    protected $address;

    /**
     * Контакты банка.
     *
     * @var \Noldors\CommerceMLParser\Models\ComplexTypes\Contact
     */
    protected $contacts;

    /**
     * Бик банка.
     *
     * @var string
     */
    protected $bik;

    /**
     * Swift банка.
     *
     * @var string
     */
    protected $swift;

    /**
     * Bank constructor.
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (is_null($xml)) {
            return;
        }

        $this->correspondentAccount = (string)$xml->СчетКорреспондентский;
        $this->name = (string)$xml->Наименование;
        if ($xml->Адрес) {
            $this->address = new Address($xml->Адрес);
        }

        if ($xml->Контакты) {
            $this->contacts = new Contact($xml->Контакты);
        }

        $this->bik = (string)$xml->БИК;
        $this->swift = (string)$xml->SWIFT;
    }

    /**
     * Получить корреспонденсткий счет.
     *
     * @return string
     */
    public function getCorrespondentAccount()
    {
        return $this->correspondentAccount;
    }

    /**
     * Получить название банка.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Получить адрес банка.
     *
     * @return \Noldors\CommerceMLParser\Models\ComplexTypes\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Получить контакты банка.
     *
     * @return \Noldors\CommerceMLParser\Models\ComplexTypes\Contact
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Получить бик банка.
     *
     * @return string
     */
    public function getBik()
    {
        return $this->bik;
    }

    /**
     * Получить swift код банка.
     *
     * @return string
     */
    public function getSwift()
    {
        return $this->swift;
    }
}