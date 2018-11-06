<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccess\Business\CustomerAccess;

use ArrayObject;
use Generated\Shared\Transfer\CustomerAccessTransfer;
use Pyz\Zed\CustomerAccess\CustomerAccessConfig;

class CustomerAccessFilter implements CustomerAccessFilterInterface
{
    /**
     * @var \Pyz\Zed\CustomerAccess\CustomerAccessConfig
     */
    protected $customerAccessConfig;

    /**
     * @param \Pyz\Zed\CustomerAccess\CustomerAccessConfig $customerAccessConfig
     */
    public function __construct(CustomerAccessConfig $customerAccessConfig)
    {
        $this->customerAccessConfig = $customerAccessConfig;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerAccessTransfer $customerAccessTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function filterManageableContentTypes(CustomerAccessTransfer $customerAccessTransfer): CustomerAccessTransfer
    {
        $filteredContentTypeAccess = [];
        $manageableContentTypes = $this->customerAccessConfig->getManageableContentTypes();

        foreach ($customerAccessTransfer->getContentTypeAccess() as $contentTypeAccess) {
            if (!in_array($contentTypeAccess->getContentType(), $manageableContentTypes)) {
                continue;
            }

            $filteredContentTypeAccess[] = $contentTypeAccess;
        }

        $customerAccessTransfer->setContentTypeAccess(new ArrayObject($filteredContentTypeAccess));

        return $customerAccessTransfer;
    }
}
