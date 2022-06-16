<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccess\Business\CustomerAccess;

use Generated\Shared\Transfer\ContentTypeAccessTransfer;
use Generated\Shared\Transfer\CustomerAccessTransfer;
use Pyz\Zed\CustomerAccess\Persistence\CustomerAccessRepositoryInterface;

class CustomerAccessReader implements CustomerAccessReaderInterface
{
    /**
     * @var \Spryker\Zed\CustomerAccess\Persistence\CustomerAccessRepositoryInterface
     */
    protected $customerAccessRepository;

    /**
     * @param \Pyz\Zed\CustomerAccess\Persistence\CustomerAccessRepositoryInterface $customerAccessRepository
     */
    public function __construct(CustomerAccessRepositoryInterface $customerAccessRepository)
    {
        $this->customerAccessRepository = $customerAccessRepository;
    }

    /**
     * @param string $contentType
     *
     * @return \Generated\Shared\Transfer\ContentTypeAccessTransfer|null
     */
    public function findCustomerAccessByContentType(string $contentType): ?ContentTypeAccessTransfer
    {
        return $this->customerAccessRepository->findCustomerAccessByContentType($contentType);
    }

    /**
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function getUnrestrictedContentTypes(): CustomerAccessTransfer
    {
        return $this->customerAccessRepository->getUnrestrictedContentTypes();
    }

    /**
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function getAllContentTypes(): CustomerAccessTransfer
    {
        return $this->customerAccessRepository->getAllContentTypes();
    }

    /**
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function getRestrictedContentTypes(): CustomerAccessTransfer
    {
        return $this->customerAccessRepository->getRestrictedContentTypes();
    }
}
