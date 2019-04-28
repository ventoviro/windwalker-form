<?php declare(strict_types=1);
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2019 LYRASOFT.
 * @license    LGPL-2.0-or-later
 */

namespace Windwalker\Form\Test\Stub;

use Windwalker\Form\Field\AbstractField;

/**
 * The StubField class.
 *
 * @since  2.0
 */
class StubField extends AbstractField
{
    /**
     * Property type.
     *
     * @var  string
     */
    protected $type = 'stub';

    /**
     * prepareRenderInput
     *
     * @param array &$attrs
     *
     * @return  array
     */
    public function prepare(&$attrs)
    {
        $attrs['type'] = 'text';
        $attrs['name'] = $this->getFieldName();
        $attrs['id'] = $this->getAttribute('id', $this->getId());
        $attrs['class'] = $this->getAttribute('class');
        $attrs['size'] = $this->getAttribute('size');
        $attrs['maxlength'] = $this->getAttribute('size');
        $attrs['readonly'] = $this->getAttribute('readonly');
        $attrs['disabled'] = $this->getAttribute('disabled');
        $attrs['onchange'] = $this->getAttribute('onchange');
        $attrs['value'] = $this->getValue();

        $attrs = array_merge($attrs, (array) $this->getAttribute('attribs'));
    }
}
