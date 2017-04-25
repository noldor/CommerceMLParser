<?php

namespace Noldors\CommerceMLParser\Models\ComplexTypes;

use Noldors\Collections\Collection;

/**
 * Тип контрагент
 *
 * @package Noldors\CommerceMLParser\Models\ComplexTypes
 */
class Partner extends Contractor
{
    /**
     * Представители.
     *
     * @var \Noldors\CommerceMLParser\Models\ComplexTypes\Representative[]
     */
    protected $representatives;

    /**
     * Partner constructor.
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        parent::__construct($xml);
        if ($xml->Представители) {
            $this->representatives = new Collection();

            foreach ($xml->Представители as $representative) {
                $this->representatives->push(new Representative($representative));
            }
        }
    }

    /**
     * Получить список представителей.
     *
     * @return \Noldors\CommerceMLParser\Models\ComplexTypes\Representative[]
     */
    public function getRepresentatives()
    {
        return $this->representatives;
    }
}