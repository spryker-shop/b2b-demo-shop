<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\BusinessOnBehalfWidget\Widget;

use SprykerShop\Yves\BusinessOnBehalfWidget\Widget\BusinessOnBehalfStatusWidget as SprykerBusinessOnBehalfStatusWidget;
/**
 * @method \SprykerShop\Yves\BusinessOnBehalfWidget\BusinessOnBehalfWidgetFactory getFactory()
 */
class BusinessOnBehalfStatusWidget extends SprykerBusinessOnBehalfStatusWidget
{
    protected const PAGE_KEY = 'change-company-user';

    /**
     * @param string|null $activePage
     */
    public function __construct(string $activePage = null)
    {
        parent::__construct();

        $this->addParameter('isActivePage', $this->isPageActive($activePage));
    }

    /**
     * @param string $activePage
     *
     * @return bool
     */
    protected function isPageActive(string $activePage): bool
    {
        return $activePage === static::PAGE_KEY;
    }
}
