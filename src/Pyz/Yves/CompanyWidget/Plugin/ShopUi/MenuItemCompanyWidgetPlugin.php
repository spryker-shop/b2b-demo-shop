<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CompanyWidget\Plugin\ShopUi;

use Pyz\Yves\CompanyWidget\Widget\MenuItemCompanyWidget;
use Spryker\Yves\Kernel\Widget\AbstractWidgetPlugin;
use SprykerShop\Yves\ShopUi\Dependency\Plugin\CompanyWidget\MenuItemCompanyWidgetPluginInterface;

/**
 * @deprecated User \Pyz\Yves\CompanyWidget\Widget\MultiItemCompanyWidget instead.
 *
 * @method \SprykerShop\Yves\CompanyWidget\CompanyWidgetFactory getFactory()
 */
class MenuItemCompanyWidgetPlugin extends AbstractWidgetPlugin implements MenuItemCompanyWidgetPluginInterface
{
    /**
     * @return void
     */
    public function initialize(): void
    {
        $widget = new MenuItemCompanyWidget();
        $this->parameters = $widget->getParameters();
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @return string
     */
    public static function getName(): string
    {
        return static::NAME;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @return string
     */
    public static function getTemplate(): string
    {
        return MenuItemCompanyWidget::getTemplate();
    }
}
