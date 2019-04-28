<?php declare(strict_types=1);
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2019 LYRASOFT.
 * @license    LGPL-2.0-or-later
 */

namespace Windwalker\Form\Test\Stub;

use Windwalker\Form\Filter\FilterInterface;

/**
 * The StubFilter class.
 *
 * @since  2.0
 */
class StubFilter implements FilterInterface
{
    /**
     * clean
     *
     * @param string $text
     *
     * @return  mixed
     */
    public function clean($text)
    {
        return filter_var($text, FILTER_SANITIZE_NUMBER_INT);
    }
}
