<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\ErrorPage;

use SprykerShop\Yves\ErrorPage\ErrorPageDependencyProvider as SprykerErrorPageDependencyProvider;
use SprykerShop\Yves\ErrorPage\Plugin\ExceptionHandler\SubRequestExceptionHandlerPlugin;

class ErrorPageDependencyProvider extends SprykerErrorPageDependencyProvider
{
    /**
     * @return \SprykerShop\Yves\ErrorPage\Dependency\Plugin\ExceptionHandlerPluginInterface[]
     */
    protected function getExceptionHandlerPlugins()
    {
        return [
            new SubRequestExceptionHandlerPlugin(),
        ];
    }
}
