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
    protected function addFileUploadOrderField(FormBuilderInterface $builder): UploadOrderForm
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
                    'maxCount' => $this->getConfig()->getMaxFileCount(),
                    'maxTotalSize' => $this->getConfig()->getMaxTotalFileSize(),
                    'accept' => implode(',', $this->getConfig()->getAllowedCsvFileMimeTypes()),
                    'acceptExtensions' => $this->getConfig()->getDisplayAllowedFileTypesText(),
                ],
            ],
        );

        return $this;
    }
}
