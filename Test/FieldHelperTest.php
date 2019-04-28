<?php declare(strict_types=1);
/**
 * Part of Windwalker project Test files.  @codingStandardsIgnoreStart
 *
 * @copyright  Copyright (C) 2019 LYRASOFT Taiwan, Inc.
 * @license    LGPL-2.0-or-later
 */

namespace Windwalker\Form\Test;

use Windwalker\Form\FieldHelper;

/**
 * Test class of FieldHelper
 *
 * @since 2.0
 */
class FieldHelperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * setUp
     *
     * @return  void
     */
    protected function setUp(): void
    {
        FieldHelper::reset();
    }

    /**
     * tearDown
     *
     * @return  void
     */
    protected function tearDown(): void
    {
        FieldHelper::reset();
    }

    /**
     * Method to test create().
     *
     * @return void
     *
     * @covers \Windwalker\Form\FieldHelper::create
     */
    public function testCreate()
    {
        $xml = <<<XML
<field
    name="flower"
    type="text"
    label="Flower"
    description=""
    class="stub-flower"
    default="default-value"
    />
XML;

        $field = FieldHelper::create($xml);

        $this->assertInstanceOf('Windwalker\\Form\\Field\\TextField', $field);

        // Add namespace
        $xml = <<<XML
<field
    name="flower"
    type="stub"
    label="Flower"
    description=""
    class="stub-flower"
    default="default-value"
    />
XML;

        // Get default
        $field = FieldHelper::create($xml);

        $this->assertInstanceOf('Windwalker\\Form\\Field\\TextField', $field);

        // Get custom
        FieldHelper::addNamespace('Windwalker\\Form\\Test\\Stub');

        $field = FieldHelper::create($xml);

        $this->assertInstanceOf('Windwalker\\Form\\Test\\Stub\\StubField', $field);
    }
}
