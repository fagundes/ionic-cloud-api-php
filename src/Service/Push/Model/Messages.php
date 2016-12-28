<?php

namespace Ionic\Service\Push\Model;

use Ionic\Collection;

/**
 * Class Messages
 *
 * @property Message[] items
 */
class Messages extends Collection
{
    protected $collectionKey = 'items';
    protected $itemsType     = Message::class;
    protected $itemsDataType = 'array';

    /**
     * @return Message[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param Message[] $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }
}