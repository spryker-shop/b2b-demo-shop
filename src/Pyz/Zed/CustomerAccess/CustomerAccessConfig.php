<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccess;

use Spryker\Shared\CustomerAccess\CustomerAccessConfig as SprykerSharedCustomerAccessConfig;
use Spryker\Zed\CustomerAccess\CustomerAccessConfig as SprykerCustomerAccessConfig;

class CustomerAccessConfig extends SprykerCustomerAccessConfig
{
    /**
     * {@inheritDoc}
     *
     * @return string[]
     */
    public function getContentTypes(): array
    {
        return [
            SprykerSharedCustomerAccessConfig::CONTENT_TYPE_PRICE,
            SprykerSharedCustomerAccessConfig::CONTENT_TYPE_ORDER_PLACE_SUBMIT,
            SprykerSharedCustomerAccessConfig::CONTENT_TYPE_ADD_TO_CART,
            SprykerSharedCustomerAccessConfig::CONTENT_TYPE_WISHLIST,
            SprykerSharedCustomerAccessConfig::CONTENT_TYPE_SHOPPING_LIST,
        ];
    }

    /**
     * Returns content access by type for install.
     *
     * @return bool[]
     */
    public function getContentAccessByType(): array
    {
        return [
            SprykerSharedCustomerAccessConfig::CONTENT_TYPE_PRICE => false,
            SprykerSharedCustomerAccessConfig::CONTENT_TYPE_ORDER_PLACE_SUBMIT => false,
            SprykerSharedCustomerAccessConfig::CONTENT_TYPE_ADD_TO_CART => false,
            SprykerSharedCustomerAccessConfig::CONTENT_TYPE_WISHLIST => false,
            SprykerSharedCustomerAccessConfig::CONTENT_TYPE_SHOPPING_LIST => false,
        ];
    }

    /**
     * Gets list of content types that can be managed.
     *
     * @return array
     */
    public function getManageableContentTypes(): array
    {
        return [
            SprykerSharedCustomerAccessConfig::CONTENT_TYPE_PRICE,
            SprykerSharedCustomerAccessConfig::CONTENT_TYPE_WISHLIST,
            SprykerSharedCustomerAccessConfig::CONTENT_TYPE_SHOPPING_LIST,
        ];
    }
}
