<?php

namespace Noldors\CommerceMLParser\Models\Types;

/**
 * Удостоверение личности.
 *
 * @package Noldors\CommerceMLParser\Models\Types
 */
class Credential
{
    /**
     * Вид документа, удостоверяющего личность. Например: паспорт.
     *
     * @var string
     */
    protected $type;

    /**
     * Серия.
     *
     * @var string
     */
    protected $series;

    /**
     * Номер.
     *
     * @var string
     */
    protected $number;

    /**
     * ДатаВыдачи
     *
     * @var string
     */
    protected $issueDate;

    /**
     * Кем Выдан
     *
     * @var string
     */
    protected $issuedBy;

    /**
     * Credential constructor.
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (is_null($xml)) {
            return;
        }

        $this->type = (string)$xml->ВидДокумента;
        $this->series = (string)$xml->Серия;
        $this->number = (string)$xml->Номер;
        $this->issueDate = (string)$xml->ДатаВыдачи;
        $this->issuedBy = (string)$xml->КемВыдан;
    }

    /**
     * Получить вид документа.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Получить серию документа.
     *
     * @return string
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * Получить номер документа.
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Получить дату выдачи документа.
     *
     * @return string
     */
    public function getIssueDate()
    {
        return $this->issueDate;
    }

    /**
     * Получить название органа, выдавшего документ.
     *
     * @return string
     */
    public function getIssuedBy()
    {
        return $this->issuedBy;
    }
}