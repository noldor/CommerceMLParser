<?php

namespace Noldors\CommerceMLParser\Models\ComplexTypes;

use Noldors\CommerceMLParser\Helpers\Str;

/**
 * Тип скидка.
 *
 * @package Noldors\CommerceMLParser\Models\ComplexTypes
 */
class Discount
{
    /**
     * Наименование.
     *
     * @var string
     */
    protected $name;

    /**
     * Сумма.
     *
     * @var float
     */
    protected $summary;

    /**
     * Процент.
     *
     * @var string
     */
    protected $percent;

    /**
     * Учтено в сумме.
     *
     * @var bool
     */
    protected $accepted;

    /**
     * Комментарий.
     *
     * @var string
     */
    protected $comment;

    /**
     * Discount constructor.
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (is_null($xml)) {
            return;
        }

        $this->name = (string)$xml->Наименование;
        $this->summary = (float)$xml->Сумма;
        $this->percent = (string)$xml->Процент;
        $this->accepted = Str::toBool($xml->УчтеноВСумме);
        $this->comment = (string)$xml->Комментарий;
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
     * Получить сумму.
     *
     * @return float
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Получить процент.
     *
     * @return string
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * Учтено ли в сумме.
     *
     * @return bool
     */
    public function isAccepted()
    {
        return $this->accepted;
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

}