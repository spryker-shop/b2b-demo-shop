<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\StepEngine\Dependency\Form;

interface SubFormInterface
{
    /**
     * @var string
     */
    public const OPTIONS_FIELD_NAME = 'select_options';

    /**
     * @return string
     */
    public function getPropertyPath(): string;

    /**
     * @return string
     */
    public function getName(): string;
}
