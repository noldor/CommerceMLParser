<?php

namespace Noldors\CommerceMLParser\Models\ComplexTypes;

use Noldors\CommerceMLParser\Helpers\Str;

/**
 * Тип налог.
 *
 * @package Noldors\CommerceMLParser\Models\ComplexTypes
 */
class Tax
{
    /**
     * Наименование налога.
     *
     * @var string
     */
    protected $name;

    /**
     * Учтено в сумме.
     *
     * @var bool
     */
    protected $accepted;

    /**
     * Акциз.
     *
     * @var bool
     */
    protected $excise;

    /**
     * Tax constructor.
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (is_null($xml)) {
            return;
        }

        $this->name = (string)$xml->Наименование;
        $this->accepted = Str::toBool($xml->УчтеноВСумме);
        $this->excise = Str::toBool($xml->Акциз);
    }

    /**
     * Получить название налога.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Проверить учтен ли налог в сумме.
     *
     * @return bool
     */
    public function isAccepted()
    {
        return $this->accepted;
    }

    /**
     * Проверить является ли налог акцизом.
     *
     * @return bool
     */
    public function isExcise()
    {
        return $this->excise;
    }
}