<?php
/**
 * Part of Windwalker project Test files.
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Windwalker\Form\Test;

use Windwalker\Form\FilterHelper;

/**
 * Test class of FilterHelper
 *
 * @since {DEPLOY_VERSION}
 */
class FilterHelperTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * setUp
	 *
	 * @return  void
	 */
	protected function setUp()
	{
		FilterHelper::reset();
	}

	/**
	 * tearDown
	 *
	 * @return  void
	 */
	protected function tearDown()
	{
		FilterHelper::reset();
	}

	/**
	 * Method to test create().
	 *
	 * @return void
	 *
	 * @covers Windwalker\Form\FilterHelper::create
	 */
	public function testCreate()
	{
		$filter = FilterHelper::create('mock');

		$this->assertInstanceOf('Windwalker\\Form\\Filter\\MockFilter', $filter);

		$filter = FilterHelper::create('email');

		$this->assertInstanceOf('Windwalker\\Form\\Filter\\DefaultFilter', $filter);

		FilterHelper::addNamespace('Windwalker\\Form\\Test\\Stub');

		$filter = FilterHelper::create('stub');

		$this->assertInstanceOf('Windwalker\\Form\\Test\\Stub\\StubFilter', $filter);
	}

	/**
	 * testCreateByClassName
	 *
	 * @return  void
	 */
	public function testCreateByClassName()
	{
		$filter = FilterHelper::create('Windwalker\\Form\\Test\\Stub\\StubFilter');

		$this->assertInstanceOf('Windwalker\\Form\\Test\\Stub\\StubFilter', $filter);
	}
}
