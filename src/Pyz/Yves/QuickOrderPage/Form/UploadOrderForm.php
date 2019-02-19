<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\QuickOrderPage\Form;

use SprykerShop\Yves\QuickOrderPage\Form\UploadOrderForm as SprykerUploadOrderForm;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @method \SprykerShop\Yves\QuickOrderPage\QuickOrderPageFactory getFactory()
 * @method \SprykerShop\Yves\QuickOrderPage\QuickOrderPageConfig getConfig()
 */
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
                    'accept' => implode(', ', $this->getAcceptedFileExtensions()),
                ],
            ]
        );

        return $this;
    }

    /**
     * @return array
     */
    protected function getAcceptedFileExtensions(): array
    {
        $fileExtensions = [];
        $fileTemplatePlugins = $this->getFactory()->getQuickOrderFileTemplatePlugins();

        foreach ($fileTemplatePlugins as $fileTemplatePlugin) {
            $fileExtensions[] = '.' . $fileTemplatePlugin->getFileExtension();
        }

        return $fileExtensions;
    }
}
