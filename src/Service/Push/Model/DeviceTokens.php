<?php

namespace Ionic\Service\Push\Model;

use Ionic\Collection;

/**
 * Class DeviceTokens
 *
 * @property DeviceToken[] items
 */
class DeviceTokens extends Collection
{

    protected $collectionKey = 'items';
    protected $itemsType     = DeviceToken::class;
    protected $itemsDataType = 'array';

    /**
     * @return DeviceToken[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param DeviceToken[] $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }
}