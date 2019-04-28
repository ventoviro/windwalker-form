<?php declare(strict_types=1);
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2019 LYRASOFT.
 * @license    LGPL-2.0-or-later
 */

namespace Windwalker\Form\Field;

/**
 * The CheckboxField class.
 *
 * @since  2.0
 */
class CheckboxField extends AbstractField
{
    /**
     * Property type.
     *
     * @var  string
     */
    protected $type = 'checkbox';

    /**
     * prepareRenderInput
     *
     * @param array $attrs
     *
     * @return  array
     */
    public function prepare(&$attrs)
    {
        $value = $this->getValue();

        $attrs['type'] = 'checkbox';
        $attrs['name'] = $this->getFieldName();
        $attrs['id'] = $this->getAttribute('id', $this->getId());
        $attrs['class'] = $this->getAttribute('class');
        $attrs['readonly'] = $this->getAttribute('readonly');
        $attrs['disabled'] = $this->getAttribute('disabled');
        $attrs['onchange'] = $this->getAttribute('onchange');
        $attrs['value'] = $this->getAttribute('value');
        $attrs['checked'] = $value ? 'true' : null;
        $attrs['required'] = $this->required;
    }
}
