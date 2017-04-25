<?php

namespace Noldors\CommerceMLParser\Models\ComplexTypes;

use Noldors\Collections\Collection;

/**
 * Тип контактная информация.
 *
 * @package Noldors\CommerceMLParser\Models\ComplexTypes
 */
class Contact
{
    /**
     * Массив контактов.
     *
     * @var \Noldors\Collections\Collection
     */
    protected $contacts;

    /**
     * Contact constructor.
     *
     * @param \SimpleXMLElement $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (is_null($xml)) {
            return;
        }

        $contacts = new Collection();

        /** @var \SimpleXMLElement $element */
        foreach ($xml->Контакт as $element) {
            $contacts->add($element->Тип, array(
                'type' => $element->Тип,
                'value' => $element->Значение,
                'comment' => $element->Комментарий
            ));
        }

        $this->contacts = $contacts;
    }

    /**
     * Получить коллекцию контактов.
     *
     * @return \Noldors\Collections\Collection
     */
    public function getContacts()
    {
        return $this->contacts;
    }
}