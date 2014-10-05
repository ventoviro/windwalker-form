<?php
/**
 * Part of Windwalker project Test files.
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Windwalker\Form\Test\Field;

use Windwalker\Form\Field\TextField;
use Windwalker\Test\TestCase\DomTestCase;

/**
 * Test class of TextField
 *
 * @since {DEPLOY_VERSION}
 */
class TextFieldTest extends DomTestCase
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
	protected function setUp()
	{
		$this->instance = new TextField(
			'flower',
			'Flower',
			array(
				'class' => 'stub-flower'
			)
		);

		$this->instance->setAttribute('id',          'test-field');
		$this->instance->setAttribute('placeholder', 'th');
		$this->instance->setAttribute('size',        60);
		$this->instance->setAttribute('maxlength',   10);
		$this->instance->setAttribute('readonly',    true);
		$this->instance->setAttribute('disabled',    true);
		$this->instance->setAttribute('onchange',    'javascript:void(0);');
		$this->instance->setAttribute('value',       'sakura');
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @return void
	 */
	protected function tearDown()
	{
	}

	/**
	 * Method to test prepareAttributes().
	 *
	 * @return void
	 *
	 * @covers Windwalker\Form\Field\TextField::prepareAttributes
	 */
	public function testRender()
	{
		$html = <<<HTML
<input type="text" name="flower" id="test-field" class="stub-flower" placeholder="th" size="60" maxlength="10" readonly="true" disabled="true" onchange="javascript:void(0);" />
HTML;

		$this->assertDomStringEqualsDomString($html, $this->instance->renderInput());
	}
}
