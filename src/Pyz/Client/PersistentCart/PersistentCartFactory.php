<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\PersistentCart;

use Pyz\Client\PersistentCart\Zed\PersistentCartStub;
use Spryker\Client\PersistentCart\PersistentCartFactory as SprykerPersistentCartFactory;
use Spryker\Client\PersistentCart\Zed\PersistentCartStubInterface;

class PersistentCartFactory extends SprykerPersistentCartFactory
{
    /**
     * @return \Spryker\Client\PersistentCart\Zed\PersistentCartStubInterface
     */
    public function createZedPersistentCartStub(): PersistentCartStubInterface
    {
        return new PersistentCartStub($this->getZedRequestClient());
    }
}
