<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\ConfigurableBundleWidget;

use Spryker\Yves\Kernel\AbstractBundleConfig as SprykerConfigurableBundleWidgetConfig;

class ConfigurableBundleWidgetConfig extends SprykerConfigurableBundleWidgetConfig
{
    /**
     * @return bool
     */
    public function isQuantityChangeable(): bool
    {
        return true;
    }
}
