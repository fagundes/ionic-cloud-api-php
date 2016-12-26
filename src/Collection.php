<?php

namespace Ionic;

class Collection extends Model implements \Iterator, \Countable
{
    protected $collectionKey = 'items';

    protected function mapTypes($array)
    {
        $newArray[$this->collectionKey] = $array;

        parent::mapTypes($newArray);
    }

    public function rewind()
    {
        if (isset($this->modelData[$this->collectionKey])
            && is_array($this->modelData[$this->collectionKey])
        ) {
            reset($this->modelData[$this->collectionKey]);
        }
    }

    public function current()
    {
        $this->coerceType($this->key());
        if (is_array($this->modelData[$this->collectionKey])) {
            return current($this->modelData[$this->collectionKey]);
        }
    }

    public function key()
    {
        if (isset($this->modelData[$this->collectionKey])
            && is_array($this->modelData[$this->collectionKey])
        ) {
            return key($this->modelData[$this->collectionKey]);
        }
    }

    public function next()
    {
        return next($this->modelData[$this->collectionKey]);
    }

    public function valid()
    {
        $key = $this->key();
        return $key !== null && $key !== false;
    }

    public function count()
    {
        if (!isset($this->modelData[$this->collectionKey])) {
            return 0;
        }
        return count($this->modelData[$this->collectionKey]);
    }

    public function offsetExists($offset)
    {
        if (!is_numeric($offset)) {
            return parent::offsetExists($offset);
        }
        return isset($this->modelData[$this->collectionKey][$offset]);
    }

    public function offsetGet($offset)
    {
        if (!is_numeric($offset)) {
            return parent::offsetGet($offset);
        }
        $this->coerceType($offset);
        return $this->modelData[$this->collectionKey][$offset];
    }

    public function offsetSet($offset, $value)
    {
        if (!is_numeric($offset)) {
            return parent::offsetSet($offset, $value);
        }
        $this->modelData[$this->collectionKey][$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        if (!is_numeric($offset)) {
            return parent::offsetUnset($offset);
        }
        unset($this->modelData[$this->collectionKey][$offset]);
    }

    private function coerceType($offset)
    {
        $typeKey = $this->keyType($this->collectionKey);
        if (isset($this->$typeKey) && !is_object($this->modelData[$this->collectionKey][$offset])) {
            $type                                           = $this->$typeKey;
            $this->modelData[$this->collectionKey][$offset] =
                new $type($this->modelData[$this->collectionKey][$offset]);
        }
    }
}