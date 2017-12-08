<?php
/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CartVariant;

use Spryker\Yves\CartVariant\CartVariantDependencyProvider as SprykerCartVariantDependencyProvider;
use Spryker\Yves\CartVariant\Dependency\Client\CartVariantToAvailabilityClientBridge;
use Spryker\Yves\Kernel\Container;

class CartVariantDependencyProvider extends SprykerCartVariantDependencyProvider
{

    /**
     * @param Container $container
     *
     * @return Container
     */
    protected function provideAvailabilityClient(Container $container)
    {
        $container[static::CLIENT_AVAILABILITY] = function (Container $container) {
            return new CartVariantToAvailabilityClientBridge($container->getLocator()->availabilityStorage()->client());
        };
        return $container;
    }

}
