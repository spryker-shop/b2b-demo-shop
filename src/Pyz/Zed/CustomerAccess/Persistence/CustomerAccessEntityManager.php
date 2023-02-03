<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccess\Persistence;

use ArrayObject;
use Generated\Shared\Transfer\ContentTypeAccessTransfer;
use Generated\Shared\Transfer\CustomerAccessTransfer;
use Orm\Zed\CustomerAccess\Persistence\SpyUnauthenticatedCustomerAccess;
use Spryker\Zed\CustomerAccess\Persistence\CustomerAccessEntityManager as SprykerCustomerAccessEntityManager;

/**
 * @method \Pyz\Zed\CustomerAccess\Persistence\CustomerAccessPersistenceFactory getFactory()
 */
class CustomerAccessEntityManager extends SprykerCustomerAccessEntityManager implements CustomerAccessEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerAccessTransfer $customerAccessTransfer
     *
     * @return void
     */
    public function setPyzContentTypesToAccessible(CustomerAccessTransfer $customerAccessTransfer): void
    {
        foreach ($customerAccessTransfer->getContentTypeAccess() as $contentTypeAccess) {
            $customerAccessEntity = $this->findPyzCustomerAccessEntityByContentType($contentTypeAccess);
            $customerAccessEntity = $customerAccessEntity ?: $this->createPyzCustomerAccessEntity($contentTypeAccess);
            $customerAccessEntity->setIsRestricted(false);
            $customerAccessEntity->save();
        }
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerAccessTransfer $customerAccessTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function setPyzContentTypesToInaccessible(CustomerAccessTransfer $customerAccessTransfer): CustomerAccessTransfer
    {
        $updatedContentTypeAccessCollection = new ArrayObject();
        foreach ($customerAccessTransfer->getContentTypeAccess() as $contentTypeAccess) {
            $customerAccessEntity = $this->findPyzCustomerAccessEntityByContentType($contentTypeAccess);
            $customerAccessEntity = $customerAccessEntity ?: $this->createPyzCustomerAccessEntity($contentTypeAccess);
            $customerAccessEntity->setIsRestricted(true);
            $customerAccessEntity->save();
            $updatedContentTypeAccessCollection->append(
                $this->getFactory()
                    ->createPyzCustomerAccessMapper()
                    ->mapCustomerAccessEntityToContentTypeAccessTransfer($customerAccessEntity, new ContentTypeAccessTransfer()),
            );
        }
        $customerAccessTransfer->setContentTypeAccess($updatedContentTypeAccessCollection);

        return $customerAccessTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ContentTypeAccessTransfer $contentTypeAccessTransfer
     *
     * @return \Orm\Zed\CustomerAccess\Persistence\SpyUnauthenticatedCustomerAccess|null
     */
    protected function findPyzCustomerAccessEntityByContentType(ContentTypeAccessTransfer $contentTypeAccessTransfer): ?SpyUnauthenticatedCustomerAccess
    {
        return $this->getFactory()
            ->getPyzUnauthenticatedCustomerAccessQuery()
            ->filterByContentType($contentTypeAccessTransfer->getContentType())
            ->findOne();
    }

    /**
     * @param \Generated\Shared\Transfer\ContentTypeAccessTransfer $contentTypeAccessTransfer
     *
     * @return \Orm\Zed\CustomerAccess\Persistence\SpyUnauthenticatedCustomerAccess
     */
    protected function createPyzCustomerAccessEntity(ContentTypeAccessTransfer $contentTypeAccessTransfer): SpyUnauthenticatedCustomerAccess
    {
        $unauthenticatedCustomerAccessEntity = new SpyUnauthenticatedCustomerAccess();
        $unauthenticatedCustomerAccessEntity->setContentType($contentTypeAccessTransfer->getContentType());

        return $unauthenticatedCustomerAccessEntity;
    }
}
