<?php

namespace Noldors\CommerceMLParser\Models\Types;

use Noldors\Collections\Collection;

/**
 * Структурированный адрес.
 *
 * @package Noldors\CommerceMLParser\Models\Types
 */
class AddressType
{
    /**
     * Почтовый индекс.
     *
     * @var string
     */
    protected $postalCode;

    /**
     * Страна.
     *
     * @var string
     */
    protected $country;

    /**
     * Регион.
     *
     * @var string
     */
    protected $region;

    /**
     * Район.
     *
     * @var string
     */
    protected $area;

    /**
     * Населенный пункт.
     *
     * @var string
     */
    protected $locality;

    /**
     * Город.
     *
     * @var string
     */
    protected $city;

    /**
     * Улица.
     *
     * @var string
     */
    protected $street;

    /**
     * Дом.
     *
     * @var string
     */
    protected $build;

    /**
     * Корпус.
     *
     * @var string
     */
    protected $housing;

    /**
     * Квартира.
     *
     * @var string
     */
    protected $flat;

    /**
     * AddressType constructor.
     *
     * @param \SimpleXMLElement $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (empty($xml)) {
            return;
        }

        $this->setValues($xml);
    }

    /**
     * Заполняем переменные объекта.
     *
     * @param \SimpleXMLElement $xml
     */
    public function setValues(\SimpleXMLElement $xml = null)
    {
        /** @var \SimpleXMLElement $element */
        foreach ($xml->АдресноеПоле as $element) {
            if ((string)$element->Тип === 'Почтовый индекс') {
                $this->postalCode = (string)$element->Значение;
            } elseif ((string)$element->Тип === 'Страна') {
                $this->country = (string)$element->Значение;
            } elseif ((string)$element->Тип === 'Регион') {
                $this->region = (string)$element->Значение;
            } elseif ((string)$element->Тип === 'Район') {
                $this->area = (string)$element->Значение;
            } elseif ((string)$element->Тип === 'Населенный пункт') {
                $this->locality = (string)$element->Значение;
            } elseif ((string)$element->Тип === 'Город') {
                $this->city = (string)$element->Значение;
            } elseif ((string)$element->Тип === 'Улица') {
                $this->street = (string)$element->Значение;
            } elseif ((string)$element->Тип === 'Дом') {
                $this->build = (string)$element->Значение;
            } elseif ((string)$element->Тип === 'Корпус') {
                $this->housing = (string)$element->Значение;
            } elseif ((string)$element->Тип === 'Квартира') {
                $this->flat = (string)$element->Значение;
            }
        }
    }

    /**
     * Получить почтовый индекс.
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
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
     * Получить регион.
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Получить район.
     *
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Получить населенный пункт.
     *
     * @return string
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * Получить город.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Получить улицу.
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Получить дом.
     *
     * @return string
     */
    public function getBuild()
    {
        return $this->build;
    }

    /**
     * Получить корпус.
     *
     * @return string
     */
    public function getHousing()
    {
        return $this->housing;
    }

    /**
     * Получить квартиру.
     * @return string
     */
    public function getFlat()
    {
        return $this->flat;
    }

    /**
     * Получить полный адрес.
     *
     * @return string
     */
    public function getFullAddress()
    {
        $addressArray = new Collection(
            array(
                $this->postalCode,
                $this->country,
                $this->region,
                $this->area,
                $this->locality,
                $this->city,
                $this->street,
                $this->build,
                $this->housing,
                $this->flat
            )
        );

        $addressArray->removeNullItems();

        return implode(', ', $addressArray->toArray());
    }
}