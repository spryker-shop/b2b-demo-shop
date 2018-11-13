<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
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
    public function __construct(?string $activePage = null)
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
