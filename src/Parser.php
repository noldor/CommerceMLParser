<?php

namespace Noldors\CommerceMLParser;

use Noldors\Collections\Collection;
use Noldors\CommerceMLParser\Models\Category;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Event parser
 *
 * @package Noldors\CommerceMLParser
 */
class Parser extends EventDispatcher
{
    /**
     * Xml reader instance.
     *
     * @var \XMLReader
     */
    protected $xmlReader;

    /**
     * File instance.
     *
     * @var \SplFileObject
     */
    protected $file;

    /**
     * Cached data.
     *
     * @var array
     */
    protected $cachedData = [];

    /**
     * Events.
     *
     * @var array
     */
    protected $callable = [];

    /**
     * Xml path.
     *
     * @var array
     */
    protected $path;

    /**
     * Data for categories.
     *
     * @var array
     */
    protected $categoriesData = [
        'xpath' => 'КоммерческаяИнформация/Классификатор/Группы/Группа',
        'model' => 'Noldors\CommerceMLParser\Models\Category',
        'event' => 'Noldors\CommerceMLParser\Events\CategoryEvent',
        'child' => 'Группы/Группа',
        'eventName' => 'CategoryEvent'
    ];

    /**
     * Data for products.
     *
     * @var array
     */
    protected $productData = [
        'xpath' => 'КоммерческаяИнформация/Каталог/Товары/Товар',
        'model' => 'Noldors\CommerceMLParser\Models\Product',
        'event' => 'Noldors\CommerceMLParser\Events\ProductEvent',
        'eventName' => 'ProductEvent'
    ];

    /**
     * Data for offers.
     *
     * @var array
     */
    protected $offerData = [
        'xpath' => 'КоммерческаяИнформация/ПакетПредложений/Предложения/Предложение',
        'model' => 'Noldors\CommerceMLParser\Models\Offer',
        'event' => 'Noldors\CommerceMLParser\Events\OfferEvent',
        'eventName' => 'OfferEvent'
    ];

    /**
     * Data for properties.
     *
     * @var array
     */
    protected $propertyData = [
        'xpath' => 'КоммерческаяИнформация/Классификатор/Свойства/Свойство',
        'model' => 'Noldors\CommerceMLParser\Models\Property',
        'event' => 'Noldors\CommerceMLParser\Events\PropertyEvent',
        'eventName' => 'PropertyEvent'
    ];

    /**
     * Data for prices.
     *
     * @var array
     */
    protected $priceTypeData = [
        'xpath' => 'КоммерческаяИнформация/ПакетПредложений/ТипыЦен/ТипЦены',
        'model' => 'Noldors\CommerceMLParser\Models\PriceType',
        'event' => 'Noldors\CommerceMLParser\Events\PriceTypeEvent',
        'eventName' => 'PriceTypeEvent'
    ];

    /**
     * Parser constructor.
     */
    public function __construct()
    {
        $this->cacheData();
        $this->xmlReader = new \XMLReader();

        foreach ($this->cachedData as $path => $data) {
            $this->registerXpath($path, $this->dispatchEvent());
        }
    }

    /**
     * Register all xpaths.
     *
     * @param $path
     * @param $callable
     *
     * @return $this
     */
    public function registerXpath($path, $callable)
    {
        $this->callable[$path] = $callable;

        return $this;
    }

    /**
     * Parse XML file.
     *
     * @param string $file
     */
    public function parse($file)
    {
        $this->file = new \SplFileObject($file);
        $this->path = [];

        $this->xmlReader->open($file);
        $this->read();
        $this->xmlReader->close();
    }

    /**
     * Read XML and dispatch events.
     */
    public function read()
    {
        $shop = null;
        $xml = $this->xmlReader;
        while ($xml->read()) {
            if ($xml->nodeType == \XMLReader::END_ELEMENT) {
                array_pop($this->path);
                continue;
            }


            if ($xml->nodeType == \XMLReader::ELEMENT) {
                array_push($this->path, $xml->name);
                $path = implode('/', $this->path);

                if ($xml->isEmptyElement) {
                    array_pop($this->path);
                }


                if (isset($this->callable[$path])) {
                    $model = $this->createModel($path, $this->loadElementXml());

                    call_user_func_array($this->callable[$path], [$model, $this]);
                }
            }
        }
    }

    /**
     * Dispatcher.
     *
     * @return \Closure
     */
    public function dispatchEvent()
    {
        return function ($object, $self) {
            if (!class_exists($object[1]['event'])) {
                throw new \Exception($object[1]);
            }
            $event = explode('\\', $object[1]['event']);
            $event = end($event);
            $this->dispatch($event, new $object[1]['event']($object[0], $self));
        };
    }

    /**
     * Create model.
     *
     * @param $path
     * @param $xml
     *
     * @return array
     * @throws \Exception
     */
    public function createModel($path, $xml)
    {
        if (!class_exists($this->cachedData[$path]['model'])) {
            throw new \Exception("Class {$this->cachedData[$path]['model']} not found");
        }
        $modelName = $this->cachedData[$path]['model'];
        $model = new $modelName($xml);

        if ($model instanceof Category) {
            $collection = new Collection();
            $collection->push($model);
            $this->addChild($model, $collection, $this->categoriesData['child'], $xml);
        }

        return array(
            isset($collection) ? $collection : $model,
            $this->cachedData[$path]
        );
    }

    /**
     * Add child element
     * @param \Noldors\CommerceMLParser\Models\Category $model
     * @param Collection $collection
     * @param string $path
     * @param \SimpleXMLElement $xml
     */
    public function addChild(Category $model, Collection $collection, $path, \SimpleXMLElement $xml)
    {
        foreach ($xml->getDocNamespaces() as $strPrefix => $strNamespace) {
            if (strlen($strPrefix) == 0) {
                $strPrefix = "commerceml";
            }

            $xml->registerXPathNamespace($strPrefix, $strNamespace);
        }

        foreach ($xml->xpath($this->categoriesData['child']) as $childXml) {
            $child = new $this->categoriesData['model']($childXml);
            $model->addChild($child);
            $collection->push($child);
            $this->addChild($child, $collection, $path, $childXml);
        }
    }

    /**
     * Cache data.
     *
     * @return void
     */
    public function cacheData()
    {
        $this->cachedData = [
            $this->categoriesData['xpath'] => $this->categoriesData,
            $this->productData['xpath'] => $this->productData,
            $this->offerData['xpath'] => $this->offerData,
            $this->propertyData['xpath'] => $this->propertyData,
            $this->priceTypeData['xpath'] => $this->priceTypeData
        ];
    }

    /**
     * Load xml.
     *
     * @return \SimpleXMLElement
     */
    protected function loadElementXml()
    {
        $xml = $this->xmlReader->readOuterXml();

        return simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?>' . $xml);
    }
}