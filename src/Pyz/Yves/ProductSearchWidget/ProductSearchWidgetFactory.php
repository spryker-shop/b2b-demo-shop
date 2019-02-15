<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\ProductSearchWidget;

use SprykerShop\Yves\ProductSearchWidget\Form\ProductQuickAddForm;
use Symfony\Component\Form\FormInterface;
use SprykerShop\Yves\ProductSearchWidget\ProductSearchWidgetFactory as SprykerProductSearchWidgetFactory;

class ProductSearchWidgetFactory extends SprykerProductSearchWidgetFactory
{
    protected const OPTION_ALLOW_EXTRA_FIELDS = 'allow_extra_fields';
    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getProductQuickAddForm(): FormInterface
    {
        return $this->getFormFactory()->create(ProductQuickAddForm::class, null, [static::OPTION_ALLOW_EXTRA_FIELDS => true]);
    }
}
