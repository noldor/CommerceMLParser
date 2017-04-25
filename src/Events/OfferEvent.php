<?php
declare(strict_types=1);

namespace Noldors\CommerceMLParser\Events;

use Noldors\CommerceMLParser\Models\Offer;
use Symfony\Component\EventDispatcher\Event;

class OfferEvent extends Event
{
    /**
     * Offer instance.
     *
     * @var \Noldors\CommerceMLParser\Models\Offer
     */
    protected $offer;

    /**
     * OfferEvent constructor.
     *
     * @param \Noldors\CommerceMLParser\Models\Offer $offer
     */
    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    /**
     * Get offer instance.
     *
     * @return \Noldors\CommerceMLParser\Models\Offer
     */
    public function getOffer()
    {
        return $this->offer;
    }
}