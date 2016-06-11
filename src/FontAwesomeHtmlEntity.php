<?php

namespace Khill\FontAwesome;

use Khill\FontAwesome\Exceptions\InvalidTransformationClass;

/**
 * FontAwesomePHP is a library that wraps the FontAwesome icon set in easy to use php methods
 *
 * @version   1.1.0
 * @package   Khill\FontAwesome
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2016, KHill Designs
 * @link      http://github.com/kevinkhill/FontAwesomePHP GitHub Repository Page
 * @link      http://kevinkhill.github.io/FontAwesomePHP  Official Docs Site
 * @license   http://opensource.org/licenses/MIT          MIT
 */
class FontAwesomeHtmlEntity
{
    /**
     * FontAwesome transformation class map
     *
     * @var array
     */
    protected $CLASS_MAP = array(
        'lg'             => 'fa-lg',
        'x2'             => 'fa-2x',
        'x3'             => 'fa-3x',
        'x4'             => 'fa-4x',
        'x5'             => 'fa-5x',
        'fixedWidth'     => 'fa-fw',
        'fixed'          => 'fa-fw',              // Alias
        'fw'             => 'fa-fw',              // Alias
        'spin'           => 'fa-spin',
        's'              => 'fa-spin',            // Alias
        'border'         => 'fa-border',
        'b'              => 'fa-border',          // Alias
        'inverse'        => 'fa-inverse',
        'i'              => 'fa-inverse',         // Alias
        'rotate90'       => 'fa-rotate-90',
        'r90'            => 'fa-rotate-90',       // Alias
        '90'             => 'fa-rotate-90',       // Alias
        'rotate180'      => 'fa-rotate-180',
        'r180'           => 'fa-rotate-180',      // Alias
        '180'            => 'fa-rotate-180',      // Alias
        'rotate270'      => 'fa-rotate-270',
        'r270'           => 'fa-rotate-270',      // Alias
        '270'            => 'fa-rotate-270',      // Alias
        'flipHorizontal' => 'fa-flip-horizontal',
        'flipH'          => 'fa-flip-horizontal', // Alias
        'fh'             => 'fa-flip-horizontal', // Alias
        'flipVertical'   => 'fa-flip-vertical',
        'flipV'          => 'fa-flip-vertical',   // Alias
        'fv'             => 'fa-flip-vertical',   // Alias
        'left'           => 'pull-left',
        'l'              => 'pull-left',          // Alias
        'right'          => 'pull-right',
        'r'              => 'pull-right'          // Alias
    );

    /**
     * Classes to be applied
     *
     * @var array[string]
     */
    protected $classes = array();

    /**
     * Attributes to be applied
     *
     * @var array[string]
     */
    protected $attributes = array();

    /**
     * Maps method calls to their respective font awesome classes using
     * the class map
     *
     * @param $class
     * @return mixed
     */
    protected function classMapper($class)
    {
        if (array_key_exists($class, $this->CLASS_MAP)) {
            return $this->CLASS_MAP[$class];
        }

        if (in_array($class, $this->CLASS_MAP)) {
            return $class;
        }

        throw new InvalidTransformationClass();
    }

    /**
     * Magic method to assign transformation classes to the stack
     *
     * @param  string $name Method called
     * @param  array  $arguments
     * @return self
     * @throws InvalidTransformationClass
     */
    public function __call($name, $arguments)
    {
        if (isset($arguments[0]) && property_exists($this, 'icon')) {
            $this->icon = $arguments[0];
        }

        $this->classes[] = $this->classMapper($name);

        return $this;
    }

    /**
     * Outputs the FontAwesome object as an HTML string
     *
     * @return string HTML string of icon, stack, or list
     */
    public function __toString()
    {
        return (string) $this->output();
    }

    /**
     * Adds an attribute to the icon, useful for title or id
     *
     * @since 1.1.0
     * @param  string $attr Which attribute to add
     * @param  string $val The value of the attribute
     * @return self
     * @throws \InvalidArgumentException
     */
    public function addAttr($attr, $val)
    {
        if (is_string($attr) == false || is_string($val) === false) {
            throw new \InvalidArgumentException;
        }

        $this->attributes[$attr] = $val;

        return $this;
    }

    /**
     * Batch adds an attributes to the icon
     *
     * @since 1.1.0
     * @param  array $attrs Array of attributes to add
     * @return self
     * @throws InvalidArgumentException
     */
    public function addAttrs(array $attrs)
    {
        foreach ($attrs as $attr => $val) {
            $this->addAttr($attr, $val);
        }

        return $this;
    }

    /**
     * Adds an additional class to the icon, stack, or list
     *
     * @param  string $class
     * @return self
     * @throws \InvalidArgumentException
     */
    public function addClass($class)
    {
        if (is_string($class) === false) {
            throw new \InvalidArgumentException(
                'Additional classes must be non empty strings.'
            );
        }

        $this->classes[] = $class;

        return $this;
    }

    /**
     * Batch add an additional classes
     *
     * @param  array $classes
     * @return self
     * @throws \InvalidArgumentException
     */
    public function addClasses(array $classes)
    {
        foreach ($classes as $class) {
            $this->addClass($class);
        }

        return $this;
    }
}