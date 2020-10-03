<?php

/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2019 LYRASOFT.
 * @license    MIT
 */

declare(strict_types=1);

namespace Windwalker\Form\Attributes;

use Windwalker\Attributes\AttributeHandler;
use Windwalker\Attributes\AttributeInterface;
use Windwalker\Form\Form;

/**
 * The Fieldset class.
 */
#[\Attribute]
class Fieldset implements AttributeInterface
{
    public string $name;

    protected ?string $title;

    /**
     * Fieldset constructor.
     *
     * @param  string       $name
     * @param  string|null  $title
     */
    public function __construct(string $name, ?string $title = '')
    {
        $this->name = $name;
        $this->title = $title;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(AttributeHandler $handler): callable
    {
        return function () use ($handler) {
            $resolver = $handler->getResolver();

            /** @var Form $form */
            $form = $resolver->getOption('form');

            $fieldset = $form->fieldset($this->name, $handler);

            $fieldset->title($this->title);
        };
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param  string  $name
     *
     * @return  static  Return self to support chaining.
     */
    public function name(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param  string|null  $title
     *
     * @return  static  Return self to support chaining.
     */
    public function title(?string $title)
    {
        $this->title = $title;

        return $this;
    }
}
