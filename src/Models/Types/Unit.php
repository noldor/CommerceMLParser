<?php

namespace Noldors\CommerceMLParser\Models\Types;

/**
 * Тип единица измерения.
 *
 * @package Noldors\CommerceMLParser\Models\Types
 */
class Unit
{
    /**
     * Наименование единицы.
     *
     * @var string
     */
    protected $unit;

    /**
     * Коэффициент.
     *
     * @var string
     */
    protected $factor;

    /**
     * Дополнительные данные.
     *
     * @var \Noldors\CommerceMLParser\Models\ComplexTypes\RequisiteValue
     */
    protected $additional;

    /**
     * Unit constructor.
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (is_null($xml)) {
            return;
        }
        //TODO не все так просто с дополнительными данными.
        $this->unit = (string)$xml->Единица;
        $this->factor = (string)$xml->Коэффициент;
        $this->additional = (string)$xml->ДополнительныеДанные;
    }
}