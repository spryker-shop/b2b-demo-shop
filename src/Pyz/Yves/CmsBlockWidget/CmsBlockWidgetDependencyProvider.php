<?php
/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CmsBlockWidget;

use Spryker\Yves\CmsBlock\Twig\Plugin\TwigCmsBlock;
use Spryker\Yves\CmsBlock\Twig\Plugin\TwigCmsBlockPlaceholder;
use SprykerShop\Yves\CmsBlockWidget\CmsBlockWidgetDependencyProvider as SprykerCmsBlockWidgetDependencyProvider;

class CmsBlockWidgetDependencyProvider extends SprykerCmsBlockWidgetDependencyProvider
{

    /**
     * @return \Spryker\Yves\Twig\Plugin\TwigFunctionPluginInterface[]
     */
    protected function getTwigFunctionPlugins()
    {
        return [
            new TwigCmsBlock(),
            new TwigCmsBlockPlaceholder()
        ];
    }

}
