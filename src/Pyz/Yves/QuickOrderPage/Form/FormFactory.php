<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\QuickOrderPage\Form;

use SprykerShop\Yves\QuickOrderPage\Form\FormFactory as SprykerFormFactory;
use Symfony\Component\Form\FormInterface;

class FormFactory extends SprykerFormFactory
{
    /**
     * @param mixed $data
     * @param array $formOptions
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getUploadOrderForm($data = null, array $formOptions = []): FormInterface
    {
        return $this->getFormFactory()->create(UploadOrderForm::class, $data, $formOptions);
    }
}
