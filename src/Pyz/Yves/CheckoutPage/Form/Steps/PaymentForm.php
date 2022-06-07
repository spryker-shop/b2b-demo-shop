<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CheckoutPage\Form\Steps;

use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Pyz\Yves\StepEngine\Dependency\Form\SubFormInterface;
use Pyz\Yves\StepEngine\Dependency\Form\SubFormProviderNameInterface;
use Spryker\Yves\Kernel\Form\AbstractType;
use Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginCollection;
use Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @method \SprykerShop\Yves\CheckoutPage\CheckoutPageFactory getFactory()
 * @method \Pyz\Yves\CheckoutPage\CheckoutPageConfig getConfig()
 */
class PaymentForm extends AbstractType
{
    /**
     * @var string
     */
    public const PYZ_PAYMENT_PROPERTY_PATH = QuoteTransfer::PAYMENT;

    /**
     * @var string
     */
    public const PYZ_PAYMENT_SELECTION = PaymentTransfer::PAYMENT_SELECTION;

    /**
     * @var string
     */
    public const PYZ_PAYMENT_SELECTION_PROPERTY_PATH = self::PYZ_PAYMENT_PROPERTY_PATH . '.' . self::PYZ_PAYMENT_SELECTION;

    /**
     * @var string
     */
    protected const PYZ_VALIDATION_NOT_BLANK_MESSAGE = 'validation.not_blank';

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return 'paymentForm';
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addPyzPaymentMethods($builder, $options);
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'validation_groups' => function (FormInterface $form) {
                $validationGroups = [Constraint::DEFAULT_GROUP];

                $paymentSelectionFormData = $form->get(self::PYZ_PAYMENT_SELECTION)->getData();
                if (is_string($paymentSelectionFormData)) {
                    $validationGroups[] = $paymentSelectionFormData;
                }

                return $validationGroups;
            },
            'attr' => [
                'novalidate' => 'novalidate',
            ],
        ]);

        $resolver->setRequired(SubFormInterface::PYZ_OPTIONS_FIELD_NAME);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param \Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface[] $paymentMethodSubForms
     * @param array $options
     *
     * @return $this
     */
    protected function addPyzPaymentMethodSubForms(FormBuilderInterface $builder, array $paymentMethodSubForms, array $options)
    {
        foreach ($paymentMethodSubForms as $paymentMethodSubForm) {
            if ($paymentMethodSubForm instanceof SubFormInterface) {
                $builder->add(
                    $paymentMethodSubForm->getPyzName(),
                    get_class($paymentMethodSubForm),
                    [
                        'property_path' => self::PYZ_PAYMENT_PROPERTY_PATH . '.' . $paymentMethodSubForm->getPyzPropertyPath(),
                        'error_bubbling' => true,
                        'select_options' => $options['select_options'],
                        'label' => false,
                    ]
                );

                continue;
            }

            $builder->add(
                $paymentMethodSubForm->getName(),
                get_class($paymentMethodSubForm),
                [
                    'property_path' => self::PYZ_PAYMENT_PROPERTY_PATH . '.' . $paymentMethodSubForm->getPropertyPath(),
                    'error_bubbling' => true,
                    'select_options' => $options['select_options'],
                    'label' => false,
                ]
            );
        }

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return $this
     */
    protected function addPyzPaymentMethods(FormBuilderInterface $builder, array $options)
    {
        $paymentMethodSubForms = $this->getPyzPaymentMethodSubForms();
        $paymentMethodChoices = $this->getPyzPaymentMethodChoices($paymentMethodSubForms);

        $this->addPyzPaymentMethodChoices($builder, $paymentMethodChoices)
            ->addPyzPaymentMethodSubForms($builder, $paymentMethodSubForms, $options);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $paymentMethodChoices
     *
     * @return $this
     */
    protected function addPyzPaymentMethodChoices(FormBuilderInterface $builder, array $paymentMethodChoices)
    {
        $builder->add(
            self::PYZ_PAYMENT_SELECTION,
            ChoiceType::class,
            [
                'choices' => $paymentMethodChoices,
                'label' => false,
                'required' => true,
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'property_path' => self::PYZ_PAYMENT_SELECTION_PROPERTY_PATH,
                'constraints' => [
                    new NotBlank(['message' => self::PYZ_VALIDATION_NOT_BLANK_MESSAGE]),
                ],
            ]
        );

        return $this;
    }

    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginCollection|\Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface[]
     */
    protected function getPyzPaymentMethodSubForms()
    {
        $paymentMethodSubForms = [];

        $availablePaymentMethodSubFormPlugins = $this->getFactory()->getPaymentMethodSubForms();
        $availablePaymentMethodSubFormPlugins = $this->filterPyzOutNotAvailableForms($availablePaymentMethodSubFormPlugins);
        $filteredPaymentMethodSubFormPlugins = $this->filterPyzPaymentMethodSubFormPlugins($availablePaymentMethodSubFormPlugins);

        foreach ($filteredPaymentMethodSubFormPlugins as $paymentMethodSubFormPlugin) {
            $paymentMethodSubForms[] = $paymentMethodSubFormPlugin->createSubForm();
        }

        return $paymentMethodSubForms;
    }

    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginCollection $paymentMethodSubFormPlugins
     *
     * @return \Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginCollection
     */
    protected function filterPyzOutNotAvailableForms(SubFormPluginCollection $paymentMethodSubFormPlugins): SubFormPluginCollection
    {
        $paymentMethodNames = $this->getPyzAvailablePaymentMethodNames();
        $paymentMethodNames = array_combine($paymentMethodNames, $paymentMethodNames);

        foreach ($paymentMethodSubFormPlugins as $key => $subFormPlugin) {
            $subFormName = $this->getPyzSubFormName($subFormPlugin);

            if (!isset($paymentMethodNames[$subFormName])) {
                unset($paymentMethodSubFormPlugins[$key]);
            }
        }

        $paymentMethodSubFormPlugins->reset();

        return $paymentMethodSubFormPlugins;
    }

    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginInterface $subFormPlugin
     *
     * @return string
     */
    protected function getPyzSubFormName(SubFormPluginInterface $subFormPlugin): string
    {
        $subForm = $subFormPlugin->createSubForm();
        if ($subForm instanceof SubFormInterface) {
            return $subForm->getPyzName();
        }

        return $subForm->getName();
    }

    /**
     * @return string[]
     */
    protected function getPyzAvailablePaymentMethodNames(): array
    {
        $quoteTransfer = $this->getFactory()->getQuoteClient()->getQuote();
        $paymentMethodsTransfer = $this->getFactory()->getPaymentClient()->getAvailableMethods($quoteTransfer);

        $paymentMethodNames = [];
        foreach ($paymentMethodsTransfer->getMethods() as $paymentMethodTransfer) {
            $paymentMethodNames[] = $paymentMethodTransfer->getMethodName();
        }

        return $paymentMethodNames;
    }

    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface[] $paymentMethodSubForms
     *
     * @return array
     */
    protected function getPyzPaymentMethodChoices(array $paymentMethodSubForms): array
    {
        $choices = [];

        foreach ($paymentMethodSubForms as $paymentMethodSubForm) {
            if (!$paymentMethodSubForm instanceof SubFormProviderNameInterface) {
                $subFormName = ucfirst($paymentMethodSubForm->getName());
                $choices[$subFormName] = $paymentMethodSubForm->getPropertyPath();

                continue;
            }
            $subFormName = ucfirst($paymentMethodSubForm->getPyzName());

            if (!isset($choices[$paymentMethodSubForm->getPyzProviderName()])) {
                $choices[$paymentMethodSubForm->getPyzProviderName()] = [];
            }

            $choices[$paymentMethodSubForm->getPyzProviderName()][$subFormName] = $paymentMethodSubForm->getPyzPropertyPath();
        }

        return $choices;
    }

    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginCollection $availablePaymentMethodSubFormPlugins
     *
     * @return \Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginCollection
     */
    protected function filterPyzPaymentMethodSubFormPlugins(SubFormPluginCollection $availablePaymentMethodSubFormPlugins): SubFormPluginCollection
    {
        return $this->getFactory()
            ->createSubFormFilter()
            ->filterFormsCollection($availablePaymentMethodSubFormPlugins);
    }
}
