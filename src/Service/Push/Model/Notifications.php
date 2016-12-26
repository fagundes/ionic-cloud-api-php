<?php

namespace Ionic\Service\Push\Model;

use Ionic\Collection;

/**
 * Class Notifications
 *
 * @property Notification[] items
 *
 * @package Ionic\Service\Notifications\Model
 */
class Notifications extends Collection
{
    protected $collectionKey = 'items';
    protected $itemsType     = Notification::class;
    protected $itemsDataType = 'array';

    /**
     * @return Notification[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param Notification[] $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

}