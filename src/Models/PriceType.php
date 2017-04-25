<?php

namespace Noldors\CommerceMLParser\Models;

use Noldors\Collections\Collection;
use Noldors\CommerceMLParser\Models\ComplexTypes\Tax;

/**
 * Тип тип цены.
 *
 * @package Noldors\CommerceMLParser\Models\ComplexTypes
 */
class PriceType
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
     * Валюта. (ISO 4217)
     * @var string
     */
    protected $currency;

    /**
     * Описание.
     *
     * @var string
     */
    protected $description;

    /**
     * Налог.
     *
     * @var Collection
     */
    protected $tax;

    /**
     * PriceType constructor.
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
        $this->currency = (string)$xml->Валюта;
        $this->description = (string)$xml->Описание;
        if ($xml->Налог) {
            $this->tax = new Collection();
            foreach ($xml->Налог as $tax) {
                $this->tax->push(new Tax($tax));
            }
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
     * Получить название.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Получить валюту.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Получить описание.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Получить налог.
     *
     * @return Collection
     */
    public function getTax()
    {
        return $this->tax;
    }
}