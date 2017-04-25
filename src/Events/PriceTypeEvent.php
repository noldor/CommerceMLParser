<?php
declare(strict_types=1);

namespace Noldors\CommerceMLParser\Events;

use Noldors\CommerceMLParser\Models\PriceType;
use Symfony\Component\EventDispatcher\Event;

class PriceTypeEvent extends Event
{
    /**
     * PriceType instance.
     *
     * @var \Noldors\CommerceMLParser\Models\PriceType
     */
    protected $priceType;

    /**
     * PriceTypeEvent constructor.
     *
     * @param \Noldors\CommerceMLParser\Models\PriceType $priceType
     */
    public function __construct(PriceType $priceType)
    {
        $this->priceType = $priceType;
    }

    /**
     * Get price type instance.
     *
     * @return \Noldors\CommerceMLParser\Models\PriceType
     */
    public function getPriceType()
    {
        return $this->priceType;
    }
}