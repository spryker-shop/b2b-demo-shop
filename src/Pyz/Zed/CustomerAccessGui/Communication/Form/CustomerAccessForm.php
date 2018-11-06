<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccessGui\Communication\Form;

use ArrayObject;
use Spryker\Zed\CustomerAccessGui\Communication\Form\CustomerAccessForm as SprykerCustomerAccessForm;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method \Spryker\Zed\CustomerAccessGui\Communication\CustomerAccessGuiCommunicationFactory getFactory()
 */
class CustomerAccessForm extends SprykerCustomerAccessForm
{
    public const OPTION_CONTENT_TYPE_ACCESS_MANAGEABLE = 'OPTION_CONTENT_TYPE_ACCESS_MANAGEABLE';
    public const OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE = 'OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE';

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired(static::OPTION_CONTENT_TYPE_ACCESS_MANAGEABLE);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param string[] $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addContentTypeAccessManageable($builder, $options);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return $this
     */
    protected function addContentTypeAccessManageable(FormBuilderInterface $builder, array $options): self
    {
        $builder->add(static::FIELD_CONTENT_TYPE_ACCESS, ChoiceType::class, [
            'expanded' => true,
            'multiple' => true,
            'required' => false,
            'label' => 'Content Types',
            'choice_label' => 'contentType',
            'choice_value' => 'contentType',
            'choices' => $options[static::OPTION_CONTENT_TYPE_ACCESS_MANAGEABLE],
        ]);

        $builder
            ->get(static::FIELD_CONTENT_TYPE_ACCESS)
            ->addModelTransformer(new CallbackTransformer(function ($customerAccess): array {
                if ($customerAccess) {
                    return (array)$customerAccess;
                }

                return [];
            }, function ($customerAccess): ArrayObject {
                return new ArrayObject($customerAccess);
            }));

        return $this;
    }
}
