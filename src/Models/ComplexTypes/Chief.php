<?php

namespace Noldors\CommerceMLParser\Models\ComplexTypes;

use Noldors\CommerceMLParser\Models\Types\Credential;

/**
 * Тип руководитель.
 *
 * @package Noldors\CommerceMLParser\Models\ComplexTypes
 */
class Chief
{
    /**
     * Фамилия.
     *
     * @var string
     */
    protected $secondName;

    /**
     * Имя.
     *
     * @var string
     */
    protected $firstName;

    /**
     * Отчество.
     *
     * @var string
     */
    protected $middleName;

    /**
     * Удостоверение личности.
     *
     * @var \Noldors\CommerceMLParser\Models\Types\Credential
     */
    protected $credential;

    /**
     * Арес регистрации.
     *
     * @var \Noldors\CommerceMLParser\Models\ComplexTypes\Address
     */
    protected $registrationAddress;

    /**
     * Должность.
     *
     * @var string
     */
    protected $position;

    /**
     * Контакты.
     *
     * @var \Noldors\CommerceMLParser\Models\ComplexTypes\Contact
     */
    protected $contacts;

    /**
     * Chief constructor.
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (is_null($xml)) {
            return;
        }

        $this->secondName = (string)$xml->Фамилия;
        $this->firstName = (string)$xml->Имя;
        $this->middleName = (string)$xml->Отчество;

        if ($xml->УдостоверениеЛичности) {
            $this->credential = new Credential($xml->УдостоверениеЛичности);
        }

        if ($xml->АдресРегистрации) {
            $this->registrationAddress = new Address($xml->АдресРегистрации);
        }

        $this->position = (string)$xml->Должность;
        if ($xml->Контакты) {
            $this->contacts = new Contact($xml->Контакты);
        }
    }

    /**
     * Получить фамилию.
     *
     * @return string
     */
    public function getSecondName()
    {
        return $this->secondName;
    }

    /**
     * Получить имя.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Получить отчество.
     *
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * Получить удостоверение личности.
     *
     * @return \Noldors\CommerceMLParser\Models\Types\Credential
     */
    public function getCredential()
    {
        return $this->credential;
    }

    /**
     * Получить адрес регистрации.
     *
     * @return \Noldors\CommerceMLParser\Models\ComplexTypes\Address
     */
    public function getRegistrationAddress()
    {
        return $this->registrationAddress;
    }

    /**
     * Получить должность.
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
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