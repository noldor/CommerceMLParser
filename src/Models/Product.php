<?php

namespace Noldors\CommerceMLParser\Models;

use Noldors\Collections\Collection;
use Noldors\CommerceMLParser\Models\ComplexTypes\Partner;
use Noldors\CommerceMLParser\Models\ComplexTypes\ProductProperty;
use Noldors\CommerceMLParser\Models\ComplexTypes\PropertyValue;
use Noldors\CommerceMLParser\Models\ComplexTypes\RequisiteValue;
use Noldors\CommerceMLParser\Models\ComplexTypes\Tax;
use Noldors\CommerceMLParser\Models\Types\BaseUnit;
use Noldors\CommerceMLParser\Models\Types\TaxRate;

class Product
{
    /**
     * Product xml id.
     *
     * @var string
     */
    protected $id;

    /**
     * Product name.
     *
     * @var string
     */
    protected $name;

    /**
     * Базовая единица.
     *
     * @var \Noldors\CommerceMLParser\Models\Types\BaseUnit
     */
    protected $baseUnit;

    /**
     * Id товара у контрагента.
     *
     * @var string
     */
    protected $partnerId;

    /**
     * Группы товара.
     *
     * @var \Noldors\Collections\Collection
     */
    protected $categories;

    /**
     * Описание.
     *
     * @var string
     */
    protected $description;

    /**
     * Изображения.
     *
     * @var \Noldors\Collections\Collection
     */
    protected $images;

    /**
     * Производитель.
     *
     * @var \Noldors\CommerceMLParser\Models\ComplexTypes\Partner
     */
    protected $manufacturer;

    /**
     * Значения свойств.
     *
     * @var \Noldors\Collections\Collection
     */
    protected $properties;

    /**
     * Ставки налогов.
     *
     * @var \Noldors\Collections\Collection
     */
    protected $taxes;

    /**
     * Акцизы. TODO сделать потом.
     * @var \Noldors\Collections\Collection
     */
    protected $excises;

    /**
     * Комплектующие. TODO сделать потом.
     *
     * @var \Noldors\Collections\Collection
     */
    protected $accessories;

    /**
     * Аналоги. TODO сделать потом.
     *
     * @var \Noldors\Collections\Collection
     */
    protected $analogues;

    /**
     * Характеристики товара.
     *
     * @var \Noldors\Collections\Collection
     */
    protected $attributes;

    /**
     * Реквизиты.
     *
     * @var \Noldors\Collections\Collection
     */
    protected $requisites;

    /**
     * Вес товара.
     *
     * @var string
     */
    protected $weight;

    /**
     * Product constructor.
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        $this->categories = new Collection();
        $this->images = new Collection();
        $this->properties = new Collection();
        $this->taxes = new Collection();
        //$this->excises = new Collection();
        //$this->accessories = new Collection();
        //$this->analogues = new Collection();
        $this->attributes = new Collection();
        $this->requisites = new Collection();

        $this->id = (string)$xml->Ид;
        $this->name = (string)$xml->Наименование;
        if ($xml->БазоваяЕдиница) {
            $this->baseUnit = new BaseUnit($xml->БазоваяЕдиница);
        }
        $this->partnerId = (string)$xml->ИдТовараУКонтрагента;

        if ($xml->Группы) {
            foreach ($xml->Группы->Ид as $categoryId) {
                $this->categories->push((string)$categoryId);
            }
        }

        $this->description = (string)$xml->Описание;

        if ($xml->Картинка) {
            foreach ($xml->Картинка as $image) {
                $this->images->push((string)$image);
            }
        }

        //TODO изготовитель только часть, еще может быть полный Manufacturer как группа.
        if ($xml->Изготовитель) {
            $this->manufacturer = new Partner($xml->Изготовитель);
        }

        if ($xml->ЗначенияСвойств) {
            foreach ($xml->ЗначенияСвойств->ЗначенияСвойства as $property) {
                $this->properties->push(new PropertyValue($property));
            }
        }

        if ($xml->СтавкиНалогов) {
            foreach ($xml->СтавкиНалогов->СтавкаНалога as $tax) {
                $this->taxes->push(new TaxRate($tax));
            }
        }

        if ($xml->ХарактеристикиТовара) {
            foreach ($xml->ХарактеристикиТовара->ХарактеристикаТовара as $attribute) {
                $this->attributes->push(new ProductProperty($attribute));
            }
        }

        if ($xml->ЗначенияРеквизитов) {
            foreach ($xml->ЗначенияРеквизитов->ЗначениеРеквизита as $requisite) {
                $this->requisites->push(new RequisiteValue($requisite));
            }
        }

        $this->weight = (string)$xml->Вес;
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
     * Получить базовую единицу.
     *
     * @return \Noldors\CommerceMLParser\Models\Types\BaseUnit
     */
    public function getBaseUnit()
    {
        return $this->baseUnit;
    }

    /**
     * Получить id у контрагента.
     *
     * @return string
     */
    public function getPartnerId()
    {
        return $this->partnerId;
    }

    /**
     * Получить категории товара.
     *
     * @return \Noldors\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Получить описание товара.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Получить изображения товаров.
     *
     * @return \Noldors\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Получить производителя товара.
     *
     * @return \Noldors\CommerceMLParser\Models\ComplexTypes\Partner
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Получить значения свойств.
     *
     * @return \Noldors\Collections\Collection
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Получить список налогов.
     *
     * @return \Noldors\Collections\Collection
     */
    public function getTaxes()
    {
        return $this->taxes;
    }

    /**
     * Получить акцизы. TODO сделать потом.
     * @return \Noldors\Collections\Collection
     */
    public function getExcises()
    {
        return $this->excises;
    }

    /**
     * Получить комплектующие. TODO сделать потом.
     *
     * @return \Noldors\Collections\Collection
     */
    public function getAccessories()
    {
        return $this->accessories;
    }

    /**
     * Получить аналоги.  TODO сделать потом.
     *
     * @return \Noldors\Collections\Collection
     */
    public function getAnalogues()
    {
        return $this->analogues;
    }

    /**
     * Получить характеристики товара.
     *
     * @return \Noldors\Collections\Collection
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Получить реквизиты.
     *
     * @return \Noldors\Collections\Collection
     */
    public function getRequisites()
    {
        return $this->requisites;
    }

    /**
     * Получить вес товара.
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

}