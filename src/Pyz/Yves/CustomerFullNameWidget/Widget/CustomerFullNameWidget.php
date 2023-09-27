<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CustomerFullNameWidget\Widget;

use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \Pyz\Yves\CustomerFullNameWidget\CustomerFullNameWidgetFactory getFactory()
 */
class CustomerFullNameWidget extends AbstractWidget
{
    /**
     * @var string
     */
    protected const PARAMETER_CUSTOMER_FULL_NAME = 'customerFullName';

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

    public function __construct()
    {
        $this->addCustomerFullNameParameter();
    }

    /**
     * @return void
     */
    protected function addCustomerFullNameParameter(): void
    {
        $customerTransfer = $this->getFactory()->getCustomerClient()->getCustomer();

        $this->addParameter(
            static::PARAMETER_CUSTOMER_FULL_NAME,
            $customerTransfer->getFirstName() . ' ' . $customerTransfer->getLastName(),
        );
    }
}
