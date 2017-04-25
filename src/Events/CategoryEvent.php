<?php

namespace Noldors\CommerceMLParser\Events;

use Noldors\Collections\Collection;
use Symfony\Component\EventDispatcher\Event;

class CategoryEvent extends Event
{
    /**
     * Categories collection.
     *
     * @var \Noldors\Collections\Collection
     */
    protected $categories;

    /**
     * CategoryEvent constructor.
     *
     * @param \Noldors\Collections\Collection $categories
     */
    public function __construct(Collection $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Get category collection.
     *
     * @return \Noldors\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }
}