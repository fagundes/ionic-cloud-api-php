<?php

namespace Ionic;

/**
 * This class defines attributes, valid values, and usage which is generated
 * from a given json schema.
 * http://tools.ietf.org/html/draft-zyp-json-schema-03#section-5
 */
class Model implements \ArrayAccess
{
    /**
     * If you need to specify a NULL JSON value, use \Ionic\Model::NULL_VALUE
     * instead - it will be replaced when converting to JSON with a real null.
     */
    const NULL_VALUE = "{}api-php-null";

    protected $internal_api_mappings = [];
    protected $modelData             = [];
    protected $modelMetadata         = [];
    protected $processed             = [];

    /**
     * @var Metadata
     */
    protected $metadata;

    /**
     * Polymorphic - accepts a variable number of arguments dependent
     * on the type of the model subclass.
     */
    final public function __construct()
    {
        if (func_num_args() == 1 && is_array(func_get_arg(0))) {
            // Initialize the model with the array's contents.
            $array = func_get_arg(0);
            $this->mapTypes($array);
        } else if (func_num_args() == 2 && is_array(func_get_arg(0))) {
            // Initialize the model with the array's contents.
            $array = func_get_arg(0);
            $this->mapTypes($array);

            $meta = func_get_arg(1);
            $this->mapMetadata($meta);
        }
        $this->apiInit();
    }

    /**
     * Getter that handles passthrough access to the data array, and lazy object creation.
     * @param string $key Property name.
     * @return mixed The value if any, or null.
     */
    public function __get($key)
    {
        $keyTypeName = $this->keyType($key);
        $keyDataType = $this->dataType($key);
        if (isset($this->$keyTypeName) && !isset($this->processed[$key])) {
            if (isset($this->modelData[$key])) {
                $val = $this->modelData[$key];
            } else if (isset($this->$keyDataType) &&
                ($this->$keyDataType == 'array' || $this->$keyDataType == 'map')
            ) {
                $val = [];
            } else {
                $val = null;
            }
            if ($this->isAssociativeArray($val)) {
                if (isset($this->$keyDataType) && 'map' == $this->$keyDataType) {
                    foreach ($val as $arrayKey => $arrayItem) {
                        $this->modelData[$key][$arrayKey] =
                            $this->createObjectFromName($keyTypeName, $arrayItem);
                    }
                } else {
                    $this->modelData[$key] = $this->createObjectFromName($keyTypeName, $val);
                }
            } else if (is_array($val)) {
                $arrayObject = [];
                foreach ($val as $arrayIndex => $arrayItem) {
                    $arrayObject[$arrayIndex] =
                        $this->createObjectFromName($keyTypeName, $arrayItem);
                }
                $this->modelData[$key] = $arrayObject;
            }
            $this->processed[$key] = true;
        }
        return isset($this->modelData[$key]) ? $this->modelData[$key] : null;
    }

    /**
     * Initialize this object's properties from an array.
     *
     * @param array $array Used to seed this object's properties.
     * @return void
     */
    protected function mapTypes($array)
    {
        // Hard initialise simple types, lazy load more complex ones.
        foreach ($array as $key => $val) {


            if (!property_exists($this, $this->keyType($key)) &&
                property_exists($this, $key)
            ) {
                $this->$key = $val;
                unset($array[$key]);
            } elseif (property_exists($this, $camelKey = $this->camelCase($key))) {
                // This checks if property exists as camelCase, leaving it in array as snake_case
                // in case of backwards compatibility issues.
                $this->$camelKey = $val;
            }
        }

        $this->modelData = $array;
    }

    /**
     * Initialize the metadata object's properties from an array.
     *
     * @param array $metaArray Used to seed the metadata object's properties.
     * @return void
     */
    protected function mapMetadata($metaArray)
    {
        $metadata = new Metadata();

        // Hard initialise simple types, lazy load more complex ones.
        foreach ($metaArray as $key => $val) {
            if (!property_exists($metadata, $metadata->keyType($key)) &&
                property_exists($metadata, $key)
            ) {
                $metadata->$key = $val;
                unset($metaArray[$key]);
            } elseif (property_exists($metadata, $camelKey = $this->camelCase($key))) {
                // This checks if property exists as camelCase, leaving it in array as snake_case
                // in case of backwards compatibility issues.
                $metadata->$camelKey = $val;
            }
        }

        $this->metadata      = $metadata;
        $this->modelMetadata = $metaArray;
    }

    /**
     * @return Metadata
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @return bool
     */
    public function hasMetadata()
    {
        return $this->metadata != null;
    }

    /**
     * Blank initialiser to be used in subclasses to do  post-construction initialisation - this
     * avoids the need for subclasses to have to implement the variadics handling in their
     * constructors.
     */
    protected function apiInit()
    {
        return;
    }

    /**
     * Create a simplified object suitable for straightforward
     * conversion to JSON. This is relatively expensive
     * due to the usage of reflection, but shouldn't be called
     * a whole lot, and is the most straightforward way to filter.
     */
    public function toSimpleObject()
    {
        $object = new \stdClass();
        // Process all other data.
        foreach ($this->modelData as $key => $val) {
            $result = $this->getSimpleValue($val);
            if ($result !== null) {
                $object->$key = $this->nullPlaceholderCheck($result);
            }
        }

        $props = $this->getPublicPropertiesAndGetters();

        foreach ($props as $member) {
            $name   = $member->getName();
            $result = $this->getSimpleValue($this->$name);
            if ($result !== null) {
                $name          = $this->getMappedName($name);
                $object->$name = $this->nullPlaceholderCheck($result);
            }
        }
        return $object;
    }


    /**
     * Process all public properties (not recommended) and
     * all public getters method (recommended).
     */
    private function getPublicPropertiesAndGetters()
    {
        // Process all public properties.
        $reflect = new \ReflectionObject($this);
        $props   = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC);

        // Process all getters
        $methods = $reflect->getMethods(\ReflectionMethod::IS_PUBLIC);
        foreach ($methods as $method) {
            $methodName = $method->getName();

            // method starts with 'get' or 'is' and has respective non-public property
            if ((substr($methodName, 0, 3) == 'get' && $reflect->hasProperty($propName = $this->lower_under(substr($methodName, 3)))
                    || substr($methodName, 0, 2) == 'is' && $reflect->hasProperty($propName = $this->lower_under(substr($methodName, 2)))
                )
                && ($prop = $reflect->getProperty($propName))
                && !$prop->isPublic()
            ) {
                $props[] = $prop;
            }
        }

        return $props;
    }

    /**
     * Handle different types of values, primarily
     * other objects and map and array data types.
     */
    private function getSimpleValue($value)
    {
        if ($value instanceof Model) {
            return $value->toSimpleObject();
        } else if (is_array($value)) {
            $return = [];
            foreach ($value as $key => $a_value) {
                $a_value = $this->getSimpleValue($a_value);
                if ($a_value !== null) {
                    $key          = $this->getMappedName($key);
                    $return[$key] = $this->nullPlaceholderCheck($a_value);
                }
            }
            return $return;
        }
        return $value;
    }

    /**
     * Check whether the value is the null placeholder and return true null.
     */
    private function nullPlaceholderCheck($value)
    {
        if ($value === self::NULL_VALUE) {
            return null;
        }
        return $value;
    }

    /**
     * If there is an internal name mapping, use that.
     */
    private function getMappedName($key)
    {
        if (isset($this->internal_api_mappings) &&
            isset($this->internal_api_mappings[$key])
        ) {
            $key = $this->internal_api_mappings[$key];
        }
        return $key;
    }

    /**
     * Returns true only if the array is associative.
     * @param array $array
     * @return bool True if the array is associative.
     */
    protected function isAssociativeArray($array)
    {
        if (!is_array($array)) {
            return false;
        }
        $keys = array_keys($array);
        foreach ($keys as $key) {
            if (is_string($key)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Given a variable name, discover its type.
     *
     * @param $name
     * @param $item
     * @return object The object from the item.
     */
    private function createObjectFromName($name, $item)
    {
        $type = $this->$name;
        return new $type($item);
    }

    /**
     * Verify if $obj is an array.
     * @throws Exception Thrown if $obj isn't an array.
     * @param array $obj Items that should be validated.
     * @param string $method Method expecting an array as an argument.
     */
    public function assertIsArray($obj, $method)
    {
        if ($obj && !is_array($obj)) {
            throw new Exception(
                "Incorrect parameter type passed to $method(). Expected an array."
            );
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->$offset) || isset($this->modelData[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->$offset) ?
            $this->$offset :
            $this->__get($offset);
    }

    public function offsetSet($offset, $value)
    {
        if (property_exists($this, $offset)) {
            $this->$offset = $value;
        } else {
            $this->modelData[$offset] = $value;
            $this->processed[$offset] = true;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->modelData[$offset]);
    }

    protected function keyType($key)
    {
        return $key . "Type";
    }

    protected function dataType($key)
    {
        return $key . "DataType";
    }

    public function __isset($key)
    {
        return isset($this->modelData[$key]);
    }

    public function __unset($key)
    {
        unset($this->modelData[$key]);
    }

    /**
     * Convert a string to camelCase
     * @param  string $value
     * @return string
     */
    private function camelCase($value)
    {
        $value    = ucwords(str_replace(['-', '_'], ' ', $value));
        $value    = str_replace(' ', '', $value);
        $value[0] = strtolower($value[0]);
        return $value;
    }

    protected function lower_under($value)
    {
        return preg_replace(
            '/(^|[a-z])([A-Z])/e',
            'strtolower(strlen("\\1") ? "\\1_\\2" : "\\2")',
            $value
        );
    }
}