<?php

namespace Pyz\Yves\CustomerFullNameWidget\Widget;


use Pyz\Yves\CustomerFullNameWidget\CustomerFullNameWidgetFactory;
use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method CustomerFullNameWidgetFactory getFactory()
 */
class CustomerFullNameWidget extends AbstractWidget
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'CustomerFullNameWidget';
    }

    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@CustomerFullNameWidget/views/customer-full-name-widget/customer-full-name-widget.twig';
    }

    /**
     * CustomerFullNameWidget constructor.
     */
    public function __construct()
    {
        $this->addParameter('fullName', $this->getCustomerFullName());
    }

    /**
     * @return string
     */
    protected function getCustomerFullName(): string
    {
        $customerTransfer = $this->getFactory()->getCustomerClient()->getCustomer();

        return $customerTransfer->getFirstName() . ' ' . $customerTransfer->getLastName();
    }
}
