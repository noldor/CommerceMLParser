<?php

namespace Noldors\CommerceMLParser\Models\ComplexTypes;

/**
 * Тип представитель.
 *
 * @package Noldors\CommerceMLParser\Models\ComplexTypes
 */
class Representative extends Contractor
{
    /**
     * Описывает отношение (связь) представителя и контрагента. Примеры значений: "Контактное лицо", "Филиал".
     *
     * @var string
     */
    protected $attitude;

    /**
     * Partner constructor.
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        parent::__construct($xml);

        $this->attitude = (string)$xml->Отношение;
    }

    /**
     * Получить значение отношения.
     *
     * @return string
     */
    public function getAttitude()
    {
        return $this->attitude;
    }
}