<?php

namespace Noldors\CommerceMLParser\Events;

use Noldors\CommerceMLParser\Models\Product;
use Symfony\Component\EventDispatcher\Event;

class ProductEvent extends Event
{
    /**
     * Product instance.
     *
     * @var \Noldors\CommerceMLParser\Models\Product
     */
    protected $product;

    /**
     * ProductEvent constructor.
     *
     * @param \Noldors\CommerceMLParser\Models\Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get product instance.
     *
     * @return \Noldors\CommerceMLParser\Models\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}