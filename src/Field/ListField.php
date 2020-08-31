<?php

/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2019 LYRASOFT.
 * @license    MIT
 */

declare(strict_types=1);

namespace Windwalker\Form\Field;

use Windwalker\Data\Collection;
use Windwalker\DOM\DOMElement;

use Windwalker\DOM\HTMLFactory;

use function Windwalker\DOM\h;
use function Windwalker\value_compare;

/**
 * The ListField class.
 *
 * @method  $this  size(int $value)
 * @method  mixed  getSize()
 * @method  $this  multiple(bool $value = null)
 * @method  mixed  isMultiple()
 *
 * @since  2.0
 */
class ListField extends AbstractField
{
    /**
     * Property options.
     *
     * @var  DOMElement[]
     */
    protected array $options = [];

    /**
     * Property currentGroup.
     *
     * @var  string
     */
    protected ?string $currentGroup = null;

    /**
     * @inheritDoc
     */
    public function prepareInput(DOMElement $input): DOMElement
    {
        return $input;
    }

    /**
     * buildInput
     *
     * @param  DOMElement  $input
     * @param  array       $options
     *
     * @return DOMElement
     */
    public function buildInput(DOMElement $input, array $options = []): string
    {
        $select = h('select', $input->getAttributes(true));

        foreach ($this->getOptions() as $key => $option) {
            $this->appendOption($select, $option, (string) $key);
        }

        if ($this->isMultiple()) {
            $select['name'] = $this->getInputName('[]');
        }

        return $select->render();
    }

    private function appendOption(DOMElement $select, DOMElement|array $option, ?string $group = null): void
    {
        if (is_array($option)) {
            $select->appendChild($optGroup = h('optgroup', ['label' => $group]));

            foreach ($option as $opt) {
                $this->appendOption($optGroup, $opt);
            }

            return;
        }

        $option = clone $option;
        $value = $this->getValue();

        if (!$this->isMultiple()) {
            if (value_compare($option['value'], $value, '==')) {
                $option->setAttribute('selected', 'selected');
            }
        } elseif (value_compare($option['value'], $value, 'in')) {
            $option->setAttribute('selected', 'selected');
        }

        $select->appendChild($option);
    }

    /**
     * getValue
     *
     * @return  array|string
     */
    public function getValue()
    {
        $value = parent::getValue();

        if (!is_array($value) && $this->isMultiple()) {
            $value = Collection::explode(',', (string) $value)
                ->map('trim')
                ->filter('strlen')
                ->dump();
        } else {
            $value = (string) $value;
        }

        return $value;
    }

    /**
     * getOptions
     *
     * @return  array|DOMElement[]
     */
    public function getOptions(): array
    {
        return array_merge($this->options, $this->prepareOptions());
    }

    /**
     * setOptions
     *
     * @param array|DOMElement[] $options
     * @param null|string    $group
     *
     * @return  static
     */
    public function setOptions(array $options, ?string $group = null)
    {
        $this->resetOptions();
        $this->addOptions($options, $group);

        return $this;
    }

    /**
     * addOptions
     *
     * @param array|DOMElement[] $options
     * @param null|string    $group
     *
     * @return  $this
     *
     * @since  3.5.19
     */
    public function addOptions(array $options, ?string $group = null)
    {
        if ($group) {
            $options = [$group => $options];
        }

        $this->options = array_merge($this->options, $options);

        return $this;
    }

    /**
     * resetOptions
     *
     * @return  $this
     *
     * @since  3.5.19
     */
    public function resetOptions()
    {
        $this->options = [];

        return $this;
    }

    /**
     * register
     *
     * @param callable $handler
     *
     * @return  static
     *
     * @since  3.5.2
     */
    public function register(callable $handler): self
    {
        $handler($this);

        return $this;
    }

    /**
     * registerOptions
     *
     * @param array    $options
     * @param callable $handler
     *
     * @return  static
     *
     * @since  3.5.2
     */
    public function registerOptions(array $options, callable $handler): self
    {
        foreach ($options as $name => $option) {
            if (is_numeric($name)) {
                // Option
                $handler($this, $option, null);
            } else {
                // Group
                $handler($this, $option, $name);
            }
        }

        return $this;
    }

    /**
     * addOption
     *
     * @param DOMElement $option
     * @param string $group
     *
     * @return  static
     */
    public function addOption(DOMElement $option, ?string $group = null)
    {
        $options = [$option];

        if ($group === null) {
            $group = $this->currentGroup;
        }

        $this->addOptions($options, $group);

        return $this;
    }

    /**
     * option
     *
     * @param  string|null  $text
     * @param  string|null  $value
     * @param  array        $attrs
     * @param  string|null  $group
     *
     * @return static
     */
    public function option(\DOMNode|string|null $text = null, ?string $value = null, array $attrs = [], ?string $group = null)
    {
        $attrs['value'] = $value;

        $this->addOption(static::createOption($text, $value, $attrs), $group);

        return $this;
    }

    public static function createOption(\DOMNode|string|null $text = null, ?string $value = null, array $attrs = []): DOMElement
    {
        $attrs['value'] = $value;

        return HTMLFactory::option($attrs, $text);
    }

    /**
     * optionGroup
     *
     * @param  string    $name
     * @param  callable  $callback
     *
     * @return  static
     */
    public function group(string $name, callable $callback)
    {
        $this->currentGroup = $name;

        $callback($this);

        $this->currentGroup = null;

        return $this;
    }

    /**
     * prepareOptions
     *
     * @return  array|DOMElement[]
     */
    protected function prepareOptions(): array
    {
        return [];
    }
}
