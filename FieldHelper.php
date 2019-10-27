<?php declare(strict_types=1);
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2019 LYRASOFT.
 * @license    LGPL-2.0-or-later
 */

namespace Windwalker\Form;

use Windwalker\Dom\SimpleXml\XmlHelper;
use Windwalker\Form\Field\AbstractField;

/**
 * The FieldHelper class.
 *
 * @since  2.0
 */
class FieldHelper extends AbstractFormElementHelper
{
    /**
     * Property fieldNamespaces.
     *
     * @var  \SplPriorityQueue
     */
    protected static $namespaces = null;

    /**
     * Property defaultNamespace.
     *
     * @var string
     */
    protected static $defaultNamespace = 'Windwalker\\Form\\Field';

    /**
     * createField
     *
     * @param string|AbstractField|\SimpleXMLElement $field
     * @param \SplPriorityQueue                      $namespaces
     *
     * @throws \InvalidArgumentException
     *
     * @return  AbstractField
     */
    public static function create($field, \SplPriorityQueue $namespaces = null)
    {
        if ($field instanceof \SimpleXMLElement) {
            $field = static::createByXml($field, $namespaces);
        } elseif (is_string($field) && class_exists($field)) {
            $field = new $field();
        } elseif (is_string($field)) {
            $xml = new \SimpleXMLElement($field);

            $field = static::createByXml($xml, $namespaces);
        } elseif (!($field instanceof AbstractField)) {
            throw new \InvalidArgumentException(
                'Windwalker\\Form\\Form::addField() need AbstractField or SimpleXMLElement.'
            );
        }

        return $field;
    }

    /**
     * createByXml
     *
     * @param \SimpleXmlElement $xml
     * @param \SplPriorityQueue $namespaces
     *
     * @return  AbstractField
     */
    public static function createByXml(\SimpleXMLElement $xml, \SplPriorityQueue $namespaces = null)
    {
        $type = (string) XmlHelper::get($xml, 'type', 'text');

        if (class_exists($type)) {
            $class = $type;
        } else {
            $class = (string) static::findFieldClass($type, $namespaces);
        }

        if (!class_exists($class)) {
            // Fallback to TextField
            $class = static::$defaultNamespace . '\\TextField';
        }

        return new $class($xml);
    }

    /**
     * findFieldClass
     *
     * @param string            $name
     * @param \SplPriorityQueue $namespaces
     *
     * @return  string|bool
     */
    public static function findFieldClass($name, \SplPriorityQueue $namespaces = null)
    {
        $namespaces = $namespaces ?: static::getNamespaces();

        foreach ($namespaces as $namespace) {
            $class = trim($namespace, '\\') . '\\' . ucfirst($name) . 'Field';

            if (class_exists($class)) {
                return $class;
            }
        }

        return false;
    }

    /**
     * clearAttribute
     *
     * @param string $string
     *
     * @return  string
     *
     * @since  3.5.14
     */
    public static function clearAttribute(string $string): string
    {
        return preg_replace('/[\[\]\s\"\'=\.:\/\\\\]+/', '-', $string);
    }
}
