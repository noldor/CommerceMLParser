<?php

namespace Noldors\CommerceMLParser\Models;

use Noldors\Collections\Collection;

/**
 * Тип свойство.
 *
 * @package Noldors\CommerceMLParser\Models\ComplexTypes
 */
class Property
{
    /**
     * Xml id.
     *
     * @var string
     */
    protected $id;

    /**
     * Название свойства.
     *
     * @var string
     */
    protected $name;

    /**
     * Описание свойства.
     *
     * @var string
     */
    protected $description;

    /**
     * Обязательное поле или нет.
     *
     * @var string
     */
    protected $required;

    /**
     * Множественное поле или нет.
     *
     * @var bool
     */
    protected $multiple;

    /**
     * Один из следующих типов: Строка (по умолчанию), Число,  ДатаВремя, Справочник.
     *
     * @var string
     */
    protected $type;

    /**
     * Содержит коллекцию вариантов значений свойства.
     *
     * @var
     */
    protected $variants;

    /**
     * Property constructor.
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
        $this->description = (string)$xml->Описание;
        $this->required = (string)$xml->Обязательное;
        $this->multiple = (string)$xml->Множественное;

        if ($xml->ВариантыЗначений && $xml->ТипЗначений === 'Справочник') {
            $this->addReferences($xml->ВариантыЗначений);
        }

        if ($xml->ВариантыЗначений && $xml->ТипЗначений !== 'Справочник') {
            $this->addVariants($xml->ВариантыЗначений);
        }
    }

    /**
     * Добавление значений типа "Справочник".
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function addReferences(\SimpleXMLElement $xml = null)
    {
        $this->variants = new Collection();
        foreach ($xml->Справочник as $reference) {
            $this->variants->push(array(
                'id' => $reference->ИдЗначения,
                'value' => $reference->Значение
            ));
        }
    }

    /**
     * Добавление значений простого типа.
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function addVariants(\SimpleXMLElement $xml = null)
    {
        $this->variants = new Collection();
        foreach ($xml->Значение as $reference) {
            $this->variants->push(array(
                'value' => $reference
            ));
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
     * Получить описание.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Обязательное поле или нет.
     *
     * @return string
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * Множественное поле или нет.
     *
     * @return bool
     */
    public function isMultiple()
    {
        return $this->multiple;
    }

    /**
     * Получить тип свойства.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Получить варианты свойства.
     *
     * @return mixed
     */
    public function getVariants()
    {
        return $this->variants;
    }
}