<?php

namespace Noldors\CommerceMLParser\Models;

class Category
{
    /**
     * Category xml id.
     *
     * @var string
     */
    protected $id;

    /**
     * Category name.
     *
     * @var string
     */
    protected $name;

    /**
     * Описание категории.
     *
     * @var string
     */
    protected $description;

    /**
     * Parent category.
     * @var \Noldors\CommerceMLParser\Models\Category
     */
    protected $parent;

    /**
     * Category constructor.
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (is_null($xml)) {
            return;
        }

        $this->id = (string) $xml->Ид;
        $this->name = (string) $xml->Наименование;
        $this->description = (string) $xml->Описание;
    }

    /**
     * Get category xml id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get category name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get category description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get parent category.
     *
     * @return \Noldors\CommerceMLParser\Models\Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set parent category.
     *
     * @param \Noldors\CommerceMLParser\Models\Category $category
     */
    public function setParent(Category $category)
    {
        $this->parent = $category->id;
    }

    /**
     * Add child category.
     *
     * @param \Noldors\CommerceMLParser\Models\Category $category
     */
    public function addChild(Category $category)
    {
        $category->parent = $this->id;
    }
}