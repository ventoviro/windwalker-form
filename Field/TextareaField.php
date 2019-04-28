<?php declare(strict_types=1);
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2019 LYRASOFT.
 * @license    LGPL-2.0-or-later
 */

namespace Windwalker\Form\Field;

use Windwalker\Dom\HtmlElement;

/**
 * The TextareaField class.
 *
 * @method  mixed|$this  cols(string $value = null)
 * @method  mixed|$this  rows(string $value = null)
 *
 * @since  2.0
 */
class TextareaField extends TextField
{
    /**
     * Property type.
     *
     * @var  string
     */
    protected $type = 'textarea';

    /**
     * Property element.
     *
     * @var  string
     */
    protected $element = 'textarea';

    /**
     * prepareRenderInput
     *
     * @param array $attrs
     *
     * @return  void
     */
    public function prepare(&$attrs)
    {
        $attrs['name'] = $this->getFieldName();
        $attrs['id'] = $this->getAttribute('id', $this->getId());
        $attrs['class'] = $this->getAttribute('class');
        $attrs['readonly'] = $this->getAttribute('readonly');
        $attrs['disabled'] = $this->getAttribute('disabled');
        $attrs['onchange'] = $this->getAttribute('onchange');
        $attrs['onfocus'] = $this->getAttribute('onfocus');
        $attrs['onblur'] = $this->getAttribute('onblur');
        $attrs['placeholder'] = $this->getAttribute('placeholder');
        $attrs['maxlength'] = $this->getAttribute('maxlength');
        $attrs['required'] = $this->required;

        $attrs['cols'] = $this->getAttribute('cols');
        $attrs['rows'] = $this->getAttribute('rows');
    }

    /**
     * buildInput
     *
     * @param array $attrs
     *
     * @return  mixed
     */
    public function buildInput($attrs)
    {
        return new HtmlElement($this->element, $this->getValue(), $attrs);
    }

    /**
     * getAccessors
     *
     * @return  array
     *
     * @since   3.1.2
     */
    protected function getAccessors()
    {
        return array_merge(
            parent::getAccessors(),
            [
                'cols' => 'cols',
                'rows' => 'rows',
            ]
        );
    }
}
