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
 * The SpacerField class.
 *
 * @method  mixed|$this  hr(bool $value = null)
 * @method  mixed|$this  description(string $value = null)
 * @method  mixed|$this  tag(string $value = null)
 *
 * @since  2.0
 */
class SpacerField extends AbstractField
{
    /**
     * Property type.
     *
     * @var  string
     */
    protected $type = 'spacer';

    /**
     * prepareRenderInput
     *
     * @param array $attrs
     *
     * @return  array
     */
    public function prepare(&$attrs)
    {
        $attrs['id'] = $this->getAttribute('id', $this->getId());
        $attrs['class'] = $this->getAttribute('class');
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
                'hr' => 'hr',
                'description' => 'description',
                'tag' => 'tag',
            ]
        );
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
        if ($this->getBool('hr')) {
            $node = 'hr';

            $content = null;
        } else {
            $node = $this->getAttribute('tag', 'span');

            $content = $this->getAttribute('description');
        }

        return new HtmlElement($node, $content, $attrs);
    }
}
