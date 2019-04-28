<?php declare(strict_types=1);
/**
 * Part of Windwalker project Test files.  @codingStandardsIgnoreStart
 *
 * @copyright  Copyright (C) 2019 LYRASOFT Taiwan, Inc.
 * @license    LGPL-2.0-or-later
 */

namespace Windwalker\Form\Test\Field;

use Windwalker\Dom\HtmlElement;
use Windwalker\Dom\Test\AbstractDomTestCase;
use Windwalker\Form\Field\CustomHtmlField;
use Windwalker\Form\Field\TextField;

/**
 * Test class of TextField
 *
 * @since 2.0
 */
class CustomHtmlTest extends AbstractDomTestCase
{
    /**
     * Test instance.
     *
     * @var TextField
     */
    protected $instance;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->instance = new CustomHtmlField(
            'flower',
            'Flower'
        );

        $this->instance->setAttribute('content', new HtmlElement('div', 'Sakura', ['data-test-element' => true]));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown(): void
    {
    }

    /**
     * Method to test prepareAttributes().
     *
     * @return void
     *
     * @covers \Windwalker\Form\Field\TextField::prepareAttributes
     */
    public function testRender()
    {
        $html = <<<HTML
<div data-test-element>Sakura</div>
HTML;

        $this->assertHtmlFormatEquals($html, $this->instance->renderInput());
    }
}
