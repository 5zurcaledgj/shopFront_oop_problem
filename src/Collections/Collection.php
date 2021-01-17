<?php

namespace AirlinePassengerManifest\Collections;

/**
 * The class that allows creating collections of objects.
 *
 * @package Tygh\Template
 */
abstract class Collection
{
    protected $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Collection
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /** @var array  */
    protected $items = array();

    /**
     * Collection constructor.
     *
     * @param array $items List of items.
     */
    public function __construct(array $items = array())
    {
        foreach ($items as $name => $variable) {
            $this->add($name, $variable);
        }
    }

    /**
     * Add item to collection.
     *
     * @param string    $name       Item name.
     * @param mixed     $item       Instance of item.
     */
    public function add(ICollectionItem $item)
    {
        $this->items[$item->getName()] = $item;
    }

    /**
     * Remove item from collection.
     *
     * @param string $name Item name.
     */
    public function remove($name)
    {
        unset($this->items[$name]);
    }

    /**
     * Check contains item in collection.
     *
     * @param string $name Item name.
     *
     * @return bool
     */
    public function contains($name)
    {
        return array_key_exists($name, $this->items);
    }

    /**
     * Gets item from collection.
     *
     * @param string $name Item name.
     *
     * @return null|mixed
     */
    public function get($name)
    {
        return $this->contains($name) ? $this->items[$name] : null;
    }

    /**
     * Gets all items from collection.
     *
     * @return array
     */
    public function getAll()
    {
        return $this->items;
    }
}
