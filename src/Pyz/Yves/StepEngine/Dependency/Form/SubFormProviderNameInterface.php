<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\StepEngine\Dependency\Form;

interface SubFormProviderNameInterface extends SubFormInterface
{
    /**
     * @return string
     */
    public function getProviderName(): string;
}
