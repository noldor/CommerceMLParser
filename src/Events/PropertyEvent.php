<?php
declare(strict_types=1);

namespace Noldors\CommerceMLParser\Events;

use Noldors\CommerceMLParser\Models\Property;
use Symfony\Component\EventDispatcher\Event;

class PropertyEvent extends Event
{
    /**
     * Property instance.
     *
     * @var \Noldors\CommerceMLParser\Models\Property
     */
    protected $property;

    /**
     * PropertyEvent constructor.
     *
     * @param \Noldors\CommerceMLParser\Models\Property $property
     */
    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    /**
     * Get property instance.
     *
     * @return \Noldors\CommerceMLParser\Models\Property
     */
    public function getProperty()
    {
        return $this->property;
    }
}