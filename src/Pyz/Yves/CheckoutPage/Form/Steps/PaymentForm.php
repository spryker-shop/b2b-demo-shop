<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CheckoutPage\Form\Steps;

use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Pyz\Yves\StepEngine\Dependency\Form\SubFormInterface as PyzSubFormInterface;
use Pyz\Yves\StepEngine\Dependency\Form\SubFormProviderNameInterface as PyzSubFormProviderNameInterface;
use Spryker\Yves\Kernel\Form\AbstractType;
use Spryker\Yves\StepEngine\Dependency\Form\SubFormProviderNameInterface as SprykerSubFormProviderNameInterface;
use Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginCollection;
use Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginInterface;
use SprykerShop\Yves\CheckoutPage\Form\StepEngine\ExtraOptionsSubFormInterface;
use SprykerShop\Yves\CheckoutPage\Form\StepEngine\StandaloneSubFormInterface;
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
    public const PAYMENT_PROPERTY_PATH = QuoteTransfer::PAYMENT;

    /**
     * @var string
     */
    public const PAYMENT_SELECTION = PaymentTransfer::PAYMENT_SELECTION;

    /**
     * @var string
     */
    public const PAYMENT_SELECTION_PROPERTY_PATH = self::PAYMENT_PROPERTY_PATH . '.' . self::PAYMENT_SELECTION;

    /**
     * @var string
     */
    protected const VALIDATION_NOT_BLANK_MESSAGE = 'validation.not_blank';

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return 'paymentForm';
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<mixed> $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addPaymentMethods($builder, $options);
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

                $paymentSelectionFormData = $form->get(self::PAYMENT_SELECTION)->getData();
                if (is_string($paymentSelectionFormData)) {
                    $validationGroups[] = $paymentSelectionFormData;
                }

                return $validationGroups;
            },
            'attr' => [
                'novalidate' => 'novalidate',
            ],
        ]);

        $resolver->setRequired(PyzSubFormInterface::OPTIONS_FIELD_NAME);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<\Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface|\Pyz\Yves\StepEngine\Dependency\Form\SubFormInterface> $paymentMethodSubForms
     * @param array<mixed> $options
     *
     * @return $this
     */
    protected function addPaymentMethodSubForms(FormBuilderInterface $builder, array $paymentMethodSubForms, array $options)
    {
        foreach ($paymentMethodSubForms as $paymentMethodSubForm) {
            $paymentMethodSubFormOptions = $this->getPaymentMethodSubFormOptions($paymentMethodSubForm);

            $builder->add(
                $this->getSubFormName($paymentMethodSubForm),
                get_class($paymentMethodSubForm),
                ['select_options' => $options['select_options']] + $paymentMethodSubFormOptions,
            );
        }

        return $this;
    }

    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface|\Pyz\Yves\StepEngine\Dependency\Form\SubFormInterface $paymentMethodSubForm
     *
     * @return array<mixed>
     */
    protected function getPaymentMethodSubFormOptions($paymentMethodSubForm): array
    {
        $defaultOptions = [
            'property_path' => static::PAYMENT_PROPERTY_PATH . '.' . $this->getSubFormPropertyPath($paymentMethodSubForm),
            'error_bubbling' => true,
            'label' => false,
        ];

        if (!$paymentMethodSubForm instanceof ExtraOptionsSubFormInterface) {
            return $defaultOptions;
        }

        return $defaultOptions + $paymentMethodSubForm->getExtraOptions();
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<mixed> $options
     *
     * @return $this
     */
    protected function addPaymentMethods(FormBuilderInterface $builder, array $options)
    {
        $paymentMethodSubForms = $this->getPaymentMethodSubForms();

        $this->addPaymentMethodChoices($builder, $paymentMethodSubForms)
            ->addPaymentMethodSubForms($builder, $paymentMethodSubForms, $options);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<\Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface|\Pyz\Yves\StepEngine\Dependency\Form\SubFormInterface> $paymentMethodSubForms
     *
     * @return $this
     */
    protected function addPaymentMethodChoices(FormBuilderInterface $builder, array $paymentMethodSubForms)
    {
        $builder->add(
            static::PAYMENT_SELECTION,
            ChoiceType::class,
            [
                'choices' => $this->getPaymentMethodChoices($paymentMethodSubForms),
                'choice_name' => function ($choice, $key) use ($paymentMethodSubForms) {
                    $paymentMethodSubForm = $paymentMethodSubForms[$key];

                    return $this->getSubFormName($paymentMethodSubForm);
                },
                'choice_label' => function ($choice, $key) use ($paymentMethodSubForms) {
                    $paymentMethodSubForm = $paymentMethodSubForms[$key];

                    if ($paymentMethodSubForm instanceof StandaloneSubFormInterface) {
                        return $paymentMethodSubForm->getLabelName();
                    }

                    return $this->getSubFormName($paymentMethodSubForm);
                },
                'group_by' => function ($choice, $key) use ($paymentMethodSubForms) {
                    $paymentMethodSubForm = $paymentMethodSubForms[$key];

                    if ($paymentMethodSubForm instanceof StandaloneSubFormInterface) {
                        return $paymentMethodSubForm->getGroupName();
                    }

                    if ($paymentMethodSubForm instanceof SprykerSubFormProviderNameInterface) {
                        return sprintf('checkout.payment.provider.%s', $paymentMethodSubForm->getProviderName());
                    }

                    if ($paymentMethodSubForm instanceof PyzSubFormProviderNameInterface) {
                        return sprintf('checkout.payment.provider.%s', $paymentMethodSubForm->getProviderName());
                    }

                    return '';
                },
                'label' => false,
                'required' => true,
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'property_path' => static::PAYMENT_SELECTION_PROPERTY_PATH,
                'constraints' => [
                    $this->createNotBlankConstraint(),
                ],
            ],
        );

        return $this;
    }

    /**
     * @return array<\Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface|\Pyz\Yves\StepEngine\Dependency\Form\SubFormInterface>
     */
    protected function getPaymentMethodSubForms(): array
    {
        $paymentMethodSubForms = [];

        $availablePaymentMethodsTransfer = $this->getFactory()->createPaymentMethodReader()
            ->getAvailablePaymentMethods();

        $availablePaymentMethodSubFormPlugins = $this->getFactory()->getPaymentMethodSubForms();
        $availablePaymentMethodSubFormPlugins = $this->filterOutNotAvailableForms(
            $availablePaymentMethodSubFormPlugins,
            $availablePaymentMethodsTransfer,
        );
        $availablePaymentMethodSubFormPlugins = $this->extendPaymentCollection(
            $availablePaymentMethodSubFormPlugins,
            $availablePaymentMethodsTransfer,
        );
        $filteredPaymentMethodSubFormPlugins = $this->filterPaymentMethodSubFormPlugins($availablePaymentMethodSubFormPlugins);

        foreach ($filteredPaymentMethodSubFormPlugins as $paymentMethodSubFormPlugin) {
            $paymentMethodSubForm = $this->createSubForm($paymentMethodSubFormPlugin);
            $paymentMethodSubForms[$this->getSubFormName($paymentMethodSubForm)] = $paymentMethodSubForm;
        }

        return $paymentMethodSubForms;
    }

    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginCollection $paymentSubFormPluginCollection
     * @param \Generated\Shared\Transfer\PaymentMethodsTransfer $paymentMethodsTransfer
     *
     * @return \Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginCollection
     */
    protected function extendPaymentCollection(
        SubFormPluginCollection $paymentSubFormPluginCollection,
        PaymentMethodsTransfer $paymentMethodsTransfer,
    ): SubFormPluginCollection {
        $paymentCollectionExtenderPlugins = $this->getFactory()->getPaymentCollectionExtenderPlugins();

        foreach ($paymentCollectionExtenderPlugins as $paymentCollectionExtenderPlugin) {
            $paymentSubFormPluginCollection = $paymentCollectionExtenderPlugin->extendCollection(
                $paymentSubFormPluginCollection,
                $paymentMethodsTransfer,
            );
        }

        return $paymentSubFormPluginCollection;
    }

    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginCollection $paymentMethodSubFormPlugins
     * @param \Generated\Shared\Transfer\PaymentMethodsTransfer $availablePaymentMethodsTransfer
     *
     * @return \Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginCollection
     */
    protected function filterOutNotAvailableForms(
        SubFormPluginCollection $paymentMethodSubFormPlugins,
        PaymentMethodsTransfer $availablePaymentMethodsTransfer,
    ): SubFormPluginCollection {
        $paymentMethodNames = $this->getAvailablePaymentMethodNames($availablePaymentMethodsTransfer);
        $paymentMethodNames = array_combine($paymentMethodNames, $paymentMethodNames);

        foreach ($paymentMethodSubFormPlugins as $key => $subFormPlugin) {
            $subFormName = $this->getSubFormName($subFormPlugin->createSubForm());

            if (!isset($paymentMethodNames[$subFormName])) {
                unset($paymentMethodSubFormPlugins[$key]);
            }
        }

        $paymentMethodSubFormPlugins->reset();

        return $paymentMethodSubFormPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentMethodsTransfer $availablePaymentMethodsTransfer
     *
     * @return array<string>
     */
    protected function getAvailablePaymentMethodNames(PaymentMethodsTransfer $availablePaymentMethodsTransfer): array
    {
        $paymentMethodNames = [];
        foreach ($availablePaymentMethodsTransfer->getMethods() as $paymentMethodTransfer) {
            $paymentMethodNames[] = $paymentMethodTransfer->getMethodName();
        }

        return $paymentMethodNames;
    }

    /**
     * @param array<\Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface|\Pyz\Yves\StepEngine\Dependency\Form\SubFormInterface> $paymentMethodSubForms
     *
     * @return array<string, string>
     */
    protected function getPaymentMethodChoices(array $paymentMethodSubForms): array
    {
        $choices = [];

        foreach ($paymentMethodSubForms as $paymentMethodSubForm) {
            $choices[$this->getSubFormName($paymentMethodSubForm)] = $this->getSubFormPropertyPath($paymentMethodSubForm);
        }

        return $choices;
    }

    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginCollection $availablePaymentMethodSubFormPlugins
     *
     * @return \Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginCollection
     */
    protected function filterPaymentMethodSubFormPlugins(SubFormPluginCollection $availablePaymentMethodSubFormPlugins): SubFormPluginCollection
    {
        return $this->getFactory()
            ->createSubFormFilter()
            ->filterFormsCollection($availablePaymentMethodSubFormPlugins);
    }

    /**
     * @return \Symfony\Component\Validator\Constraints\NotBlank
     */
    protected function createNotBlankConstraint(): NotBlank
    {
        return new NotBlank(['message' => static::VALIDATION_NOT_BLANK_MESSAGE]);
    }

    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginInterface $paymentMethodSubForm
     *
     * @return \Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface|\Pyz\Yves\StepEngine\Dependency\Form\SubFormInterface
     */
    protected function createSubForm(SubFormPluginInterface $paymentMethodSubForm)
    {
        /** @var \Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface|\Pyz\Yves\StepEngine\Dependency\Form\SubFormInterface $paymentSubForm */
        $paymentSubForm = $paymentMethodSubForm->createSubForm();

        return $paymentSubForm;
    }

    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface|\Pyz\Yves\StepEngine\Dependency\Form\SubFormInterface $paymentSubForm
     *
     * @return string
     */
    protected function getSubFormName($paymentSubForm): string
    {
        if ($paymentSubForm instanceof PyzSubFormInterface) {
            return $paymentSubForm->getName();
        }

        return $paymentSubForm->getName();
    }

    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface|\Pyz\Yves\StepEngine\Dependency\Form\SubFormInterface $paymentSubForm
     *
     * @return string
     */
    protected function getSubFormPropertyPath($paymentSubForm): string
    {
        if ($paymentSubForm instanceof PyzSubFormInterface) {
            return $paymentSubForm->getPropertyPath();
        }

        return $paymentSubForm->getPropertyPath();
    }
}
