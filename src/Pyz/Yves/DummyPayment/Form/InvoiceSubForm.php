<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\DummyPayment\Form;

use Generated\Shared\Transfer\DummyPaymentTransfer;
use Pyz\Yves\StepEngine\Dependency\Form\SubFormProviderNameInterface;
use Spryker\Shared\DummyPayment\DummyPaymentConfig;
use Spryker\Shared\DummyPayment\DummyPaymentConstants;
use Spryker\Yves\Kernel\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class InvoiceSubForm extends AbstractType implements SubFormProviderNameInterface
{
    /**
     * @var string
     */
    public const PYZ_PAYMENT_METHOD = 'invoice';

    /**
     * @var string
     */
    public const PYZ_TEMPLATE_PATH = 'template_path';

    /**
     * @var string
     */
    public const PYZ_FIELD_DATE_OF_BIRTH = 'date_of_birth';

    /**
     * @var string
     */
    public const PYZ_MIN_BIRTHDAY_DATE_STRING = '-18 years';

    /**
     * @return string
     */
    public function getPyzName(): string
    {
        return DummyPaymentConfig::PAYMENT_METHOD_INVOICE;
    }

    /**
     * @return string
     */
    public function getPyzPropertyPath(): string
    {
        return DummyPaymentConfig::PAYMENT_METHOD_INVOICE;
    }

    /**
     * @return string
     */
    public function getPyzTemplatePath(): string
    {
        return DummyPaymentConfig::PROVIDER_NAME . '/' . static::PYZ_PAYMENT_METHOD;
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DummyPaymentTransfer::class,
        ])->setRequired(static::PYZ_OPTIONS_FIELD_NAME);
    }

    /**
     * @deprecated Use {@link configureOptions()} instead.
     *
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function setPyzDefaultOptions(OptionsResolver $resolver): void
    {
        $this->configureOptions($resolver);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addPyzDateOfBirthField($builder);
    }

    /**
     * @return string
     */
    public function getPyzProviderName(): string
    {
        return DummyPaymentConstants::PROVIDER_NAME;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addPyzDateOfBirthField(FormBuilderInterface $builder)
    {
        $builder->add(
            static::PYZ_FIELD_DATE_OF_BIRTH,
            BirthdayType::class,
            [
                'label' => 'dummyPaymentInvoice.date_of_birth',
                'required' => true,
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy',
                'html5' => false,
                'input' => 'string',
                'attr' => [
                    'placeholder' => 'customer.birth_date',
                ],
                'constraints' => [
                    $this->createPyzNotBlankConstraint(),
                    $this->createPyzBirthdayConstraint(),
                ],
            ],
        );

        return $this;
    }

    /**
     * @return \Symfony\Component\Validator\Constraints\NotBlank
     */
    protected function createPyzNotBlankConstraint(): NotBlank
    {
        return new NotBlank(['groups' => $this->getPyzPropertyPath()]);
    }

    /**
     * @return \Symfony\Component\Validator\Constraints\Callback
     */
    protected function createPyzBirthdayConstraint(): Callback
    {
        return new Callback([
            'callback' => function ($date, ExecutionContextInterface $context): void {
                if (strtotime($date) > strtotime(static::PYZ_MIN_BIRTHDAY_DATE_STRING)) {
                    $context->addViolation('checkout.step.payment.must_be_older_than_18_years');
                }
            },
            'groups' => $this->getPyzPropertyPath(),
        ]);
    }

    /**
     * @param \Symfony\Component\Form\FormView $view The view
     * @param \Symfony\Component\Form\FormInterface $form The form
     * @param array $options The options
     *
     * @return void
     */
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        parent::buildView($view, $form, $options);

        $view->vars[static::PYZ_TEMPLATE_PATH] = $this->getPyzTemplatePath();
    }
}
