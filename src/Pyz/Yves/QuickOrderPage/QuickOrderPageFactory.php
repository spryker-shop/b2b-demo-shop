<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\QuickOrderPage;

use Pyz\Yves\QuickOrderPage\Form\FormFactory;
use SprykerShop\Yves\QuickOrderPage\Form\FormFactory as SprykerFormFactory;
use SprykerShop\Yves\QuickOrderPage\QuickOrderPageFactory as SprykerQuickOrderPageFactory;

/**
 * @method \SprykerShop\Yves\QuickOrderPage\QuickOrderPageConfig getConfig()
 */
class QuickOrderPageFactory extends SprykerQuickOrderPageFactory
{
    /**
     * @return \SprykerShop\Yves\QuickOrderPage\Form\FormFactory
     */
    public function createQuickOrderFormFactory(): SprykerFormFactory
    {
        return new FormFactory();
    }
}
