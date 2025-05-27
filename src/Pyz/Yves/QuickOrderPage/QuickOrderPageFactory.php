<?php

namespace Pyz\Yves\QuickOrderPage;

use Pyz\Yves\QuickOrderPage\Form\FormFactory;
use SprykerShop\Yves\QuickOrderPage\QuickOrderPageFactory as SprykerQuickOrderPageFactory;

class QuickOrderPageFactory extends SprykerQuickOrderPageFactory
{
    /**
     * @return \SprykerShop\Yves\QuickOrderPage\Form\FormFactory
     */
    public function createQuickOrderFormFactory(): FormFactory
    {
        return new FormFactory();
    }
}
