<?php

namespace Noldors\CommerceMLParser\Models\Types;

/**
 * Базовая единица.
 *
 * @package Noldors\CommerceMLParser\Models\Types
 */
class BaseUnit
{
    /**
     * Значение базовой единицы.
     *
     * @var string
     */
    protected $value;

    /**
     * Код.
     *
     * @var string
     */
    protected $code;

    /**
     * Полное наименование.
     *
     * @var string
     */
    protected $fullName;

    /**
     * Сокращенное наименование.
     *
     * @var string
     */
    protected $shortName;

    /**
     * Международное сокращение.
     *
     * @var string
     */
    protected $abbreviation;

    /**
     * BaseUnit constructor.
     *
     * @param \SimpleXMLElement $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (is_null($xml)) {
            return;
        }

        $this->value = (string)$xml;
        $this->code = (string)$xml['Код'];
        $this->fullName = (string)$xml['НаименованиеПолное'];
        $this->shortName = (string)$xml['НаименованиеКраткое'];
        $this->abbreviation = (string)$xml['МеждународноеСокращение'];
    }

    /**
     * Получить значение базовой единицы.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Получить код.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Получить полное наименование.
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Получить краткое наименование.
     *
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * Получить международное сокращение.
     *
     * @return string
     */
    public function getAbbreviation()
    {
        return $this->abbreviation;
    }
}