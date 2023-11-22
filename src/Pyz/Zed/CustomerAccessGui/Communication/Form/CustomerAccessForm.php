<?php

/**
 * This file is part of the Spryker Commerce OS.
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
 * @method \Pyz\Zed\CustomerAccessGui\Communication\CustomerAccessGuiCommunicationFactory getFactory()
 * @method \Spryker\Zed\CustomerAccessGui\CustomerAccessGuiConfig getConfig()
 */
class CustomerAccessForm extends SprykerCustomerAccessForm
{
    /**
     * @var string
     */
    public const OPTION_CONTENT_TYPE_ACCESS_MANAGEABLE = 'OPTION_CONTENT_TYPE_ACCESS_MANAGEABLE';

    /**
     * @var string
     */
    public const OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE = 'OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE';

    /**
     * @var string
     */
    public const OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE_DATA = 'OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE_DATA';

    /**
     * @var string
     */
    protected const FIELD_CONTENT_TYPE_ACCESS_NON_MANAGEABLE = 'contentTypeAccessNonManageable';

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired(static::OPTION_CONTENT_TYPE_ACCESS_MANAGEABLE);
        $resolver->setRequired(static::OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE);
        $resolver->setRequired(static::OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE_DATA);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string> $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addContentTypeAccessManageable($builder, $options);
        $this->addContentTypeAccessNonManageable($builder, $options);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return $this
     */
    protected function addContentTypeAccessManageable(FormBuilderInterface $builder, array $options)
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

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return $this
     */
    protected function addContentTypeAccessNonManageable(FormBuilderInterface $builder, array $options)
    {
        $builder->add(static::FIELD_CONTENT_TYPE_ACCESS_NON_MANAGEABLE, ChoiceType::class, [
            'mapped' => false,
            'expanded' => true,
            'multiple' => true,
            'required' => false,
            'disabled' => true,
            'choice_label' => 'contentType',
            'choice_value' => 'contentType',
            'data' => $options[static::OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE_DATA],
            'choices' => $options[static::OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE],
        ]);

        return $this;
    }
}
