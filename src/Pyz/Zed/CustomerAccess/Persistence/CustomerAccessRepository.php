<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccess\Persistence;

use Generated\Shared\Transfer\ContentTypeAccessTransfer;
use Generated\Shared\Transfer\CustomerAccessTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\CustomerAccess\Persistence\CustomerAccessPersistenceFactory getFactory()
 */
class CustomerAccessRepository extends AbstractRepository implements CustomerAccessRepositoryInterface
{
    /**
     * @param string $contentType
     *
     * @return \Generated\Shared\Transfer\ContentTypeAccessTransfer|null
     */
    public function findCustomerAccessByContentType($contentType): ?ContentTypeAccessTransfer
    {
        $customerAccessEntity = $this->getFactory()
            ->getPyzUnauthenticatedCustomerAccessQuery()
            ->filterByContentType($contentType)
            ->findOne();

        if (!$customerAccessEntity) {
            return null;
        }

        return $this->getFactory()
            ->createPyzCustomerAccessMapper()
            ->mapCustomerAccessEntityToContentTypeAccessTransfer($customerAccessEntity, new ContentTypeAccessTransfer());
    }

    /**
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function getUnrestrictedContentTypes(): CustomerAccessTransfer
    {
        $unauthenticatedCustomerAccessEntity = $this->getFactory()
            ->getPyzUnauthenticatedCustomerAccessQuery()
            ->filterByIsRestricted(false)
            ->find();

        return $this->getFactory()
            ->createPyzCustomerAccessMapper()
            ->mapEntitiesToCustomerAccessTransfer($unauthenticatedCustomerAccessEntity, new CustomerAccessTransfer());
    }

    /**
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function getAllContentTypes(): CustomerAccessTransfer
    {
        $unauthenticatedCustomerAccessEntity = $this->getFactory()
            ->getPyzUnauthenticatedCustomerAccessQuery()
            ->orderByIdUnauthenticatedCustomerAccess()
            ->find();

        return $this->getFactory()
            ->createPyzCustomerAccessMapper()
            ->mapEntitiesToCustomerAccessTransfer($unauthenticatedCustomerAccessEntity, new CustomerAccessTransfer());
    }

    /**
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function getRestrictedContentTypes(): CustomerAccessTransfer
    {
        $unauthenticatedCustomerAccessEntity = $this->getFactory()
            ->getPyzUnauthenticatedCustomerAccessQuery()
            ->filterByIsRestricted(true)
            ->find();

        return $this->getFactory()
            ->createPyzCustomerAccessMapper()
            ->mapEntitiesToCustomerAccessTransfer($unauthenticatedCustomerAccessEntity, new CustomerAccessTransfer());
    }
}
