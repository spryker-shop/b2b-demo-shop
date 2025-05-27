<?php

namespace Pyz\Yves\QuickOrderPage\Form;

use Pyz\Yves\QuickOrderPage\Form\UploadOrderForm as UploadOrderForm;
use SprykerShop\Yves\QuickOrderPage\Form\FormFactory as SprykerFormFactory;
use Symfony\Component\Form\FormInterface;

class FormFactory extends SprykerFormFactory
{
    /**
     * @param mixed $data
     * @param array<string, mixed> $formOptions
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getUploadOrderForm($data = null, array $formOptions = []): FormInterface
    {
        return $this->getFormFactory()->create(UploadOrderForm::class, $data, $formOptions);
    }
}
