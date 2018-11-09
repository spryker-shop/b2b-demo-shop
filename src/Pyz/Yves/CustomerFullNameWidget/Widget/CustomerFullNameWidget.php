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
        $this->addParameter('customerFullName', $this->getCustomerFullName());
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
