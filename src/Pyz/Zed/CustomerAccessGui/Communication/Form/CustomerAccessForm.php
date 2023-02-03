<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccessGui\Communication\Form;

use ArrayObject;
use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method \Pyz\Zed\CustomerAccessGui\Communication\CustomerAccessGuiCommunicationFactory getFactory()
 * @method \Spryker\Zed\CustomerAccessGui\CustomerAccessGuiConfig getConfig()
 */
class CustomerAccessForm extends AbstractType
{
    /**
     * @var string
     */
    public const PYZ_OPTION_CONTENT_TYPE_ACCESS_MANAGEABLE = 'OPTION_CONTENT_TYPE_ACCESS_MANAGEABLE';

    /**
     * @var string
     */
    public const PYZ_OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE = 'OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE';

    /**
     * @var string
     */
    public const PYZ_OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE_DATA = 'OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE_DATA';

    /**
     * @var string
     */
    protected const PYZ_FIELD_CONTENT_TYPE_ACCESS_NON_MANAGEABLE = 'contentTypeAccessNonManageable';

    /**
     * @var string
     */
    public const PYZ_OPTION_CONTENT_TYPE_ACCESS = 'OPTION_CONTENT_TYPE_ACCESS';

    /**
     * @var string
     */
    public const PYZ_FIELD_CONTENT_TYPE_ACCESS = 'contentTypeAccess';

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired(static::PYZ_OPTION_CONTENT_TYPE_ACCESS_MANAGEABLE);
        $resolver->setRequired(static::PYZ_OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE);
        $resolver->setRequired(static::PYZ_OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE_DATA);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string> $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addPyzContentTypeAccessManageable($builder, $options);
        $this->addPyzContentTypeAccessNonManageable($builder, $options);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return $this
     */
    protected function addPyzContentTypeAccessManageable(FormBuilderInterface $builder, array $options)
    {
        $builder->add(static::PYZ_FIELD_CONTENT_TYPE_ACCESS, ChoiceType::class, [
            'expanded' => true,
            'multiple' => true,
            'required' => false,
            'label' => 'Content Types',
            'choice_label' => 'contentType',
            'choice_value' => 'contentType',
            'choices' => $options[static::PYZ_OPTION_CONTENT_TYPE_ACCESS_MANAGEABLE],
        ]);

        $builder
            ->get(static::PYZ_FIELD_CONTENT_TYPE_ACCESS)
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
     * @param array $options
     *
     * @return $this
     */
    protected function addPyzContentTypeAccessNonManageable(FormBuilderInterface $builder, array $options)
    {
        $builder->add(static::PYZ_FIELD_CONTENT_TYPE_ACCESS_NON_MANAGEABLE, ChoiceType::class, [
            'mapped' => false,
            'expanded' => true,
            'multiple' => true,
            'required' => false,
            'disabled' => true,
            'choice_label' => 'contentType',
            'choice_value' => 'contentType',
            'data' => $options[static::PYZ_OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE_DATA],
            'choices' => $options[static::PYZ_OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE],
        ]);

        return $this;
    }
}
