<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccess\Business\CustomerAccess;

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
        $filteredCustomerAccessTransfer = new CustomerAccessTransfer();
        $manageableContentTypes = $this->customerAccessConfig->getManageableContentTypes();

        foreach ($customerAccessTransfer->getContentTypeAccess() as $contentTypeAccess) {
            if (!$this->isManageable($contentTypeAccess->getContentType(), $manageableContentTypes)) {
                continue;
            }
            $filteredCustomerAccessTransfer->addContentTypeAccess($contentTypeAccess);
        }

        return $filteredCustomerAccessTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerAccessTransfer $customerAccessTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function filterNonManageableContentTypes(CustomerAccessTransfer $customerAccessTransfer): CustomerAccessTransfer
    {
        $filteredCustomerAccessTransfer = new CustomerAccessTransfer();
        $manageableContentTypes = $this->customerAccessConfig->getManageableContentTypes();

        foreach ($customerAccessTransfer->getContentTypeAccess() as $contentTypeAccess) {
            if ($this->isManageable($contentTypeAccess->getContentType(), $manageableContentTypes)) {
                continue;
            }
            $filteredCustomerAccessTransfer->addContentTypeAccess($contentTypeAccess);
        }

        return $filteredCustomerAccessTransfer;
    }

    /**
     * @param string|null $contentType
     * @param array<mixed> $manageableContentTypes
     *
     * @return bool
     */
    protected function isManageable(?string $contentType, array $manageableContentTypes): bool
    {
        return in_array($contentType, $manageableContentTypes);
    }
}
