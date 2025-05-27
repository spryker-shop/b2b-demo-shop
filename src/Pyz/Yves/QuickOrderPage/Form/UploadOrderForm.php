<?php

namespace Pyz\Yves\QuickOrderPage\Form;

use SprykerShop\Yves\QuickOrderPage\Form\UploadOrderForm as SprykerUploadOrderForm;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

class UploadOrderForm extends SprykerUploadOrderForm
{

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addFileUploadOrderField(FormBuilderInterface $builder)
    {
        $builder->add(
            static::FIELD_FILE_UPLOAD_ORDER,
            FileType::class,
            [
                'label' => false,
                'constraints' => [
                    $this->getFactory()->createUploadOrderCorrectConstraint(),
                ],
                'attr' => [
                    'maxCount' => 1,
                    'maxTotalSize' => '5 MB',
                    'accept' => 'text/csv',
                    'acceptExtensions' => 'csv',
                ],
            ],
        );

        return $this;
    }
}
