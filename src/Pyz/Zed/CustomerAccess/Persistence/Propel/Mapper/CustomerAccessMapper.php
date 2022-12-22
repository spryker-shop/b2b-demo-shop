<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccess\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ContentTypeAccessTransfer;
use Generated\Shared\Transfer\CustomerAccessTransfer;
use Orm\Zed\CustomerAccess\Persistence\SpyUnauthenticatedCustomerAccess;
use Propel\Runtime\Collection\ObjectCollection;

class CustomerAccessMapper
{
    /**
     * @param \Orm\Zed\CustomerAccess\Persistence\SpyUnauthenticatedCustomerAccess $customerAccessEntity
     * @param \Generated\Shared\Transfer\ContentTypeAccessTransfer $contentTypeAccessTransfer
     *
     * @return \Generated\Shared\Transfer\ContentTypeAccessTransfer
     */
    public function mapCustomerAccessEntityToContentTypeAccessTransfer(
        SpyUnauthenticatedCustomerAccess $customerAccessEntity,
        ContentTypeAccessTransfer $contentTypeAccessTransfer
    ): ContentTypeAccessTransfer {
        return $contentTypeAccessTransfer->fromArray($customerAccessEntity->toArray(), true);
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $customerAccessEntities
     * @param \Generated\Shared\Transfer\CustomerAccessTransfer $customerAccessTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function mapEntitiesToCustomerAccessTransfer(
        ObjectCollection $customerAccessEntities,
        CustomerAccessTransfer $customerAccessTransfer
    ): CustomerAccessTransfer {
        foreach ($customerAccessEntities as $customerAccessEntity) {
            $customerAccessTransfer->addContentTypeAccess(
                $this->mapCustomerAccessEntityToContentTypeAccessTransfer($customerAccessEntity, new ContentTypeAccessTransfer()),
            );
        }

        return $customerAccessTransfer;
    }

    /**
     * @param \Orm\Zed\CustomerAccess\Persistence\SpyUnauthenticatedCustomerAccess $customerAccessEntity
     * @param \Generated\Shared\Transfer\CustomerAccessTransfer $customerAccessTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function mapEntityToCustomerAccessTransfer(
        SpyUnauthenticatedCustomerAccess $customerAccessEntity,
        CustomerAccessTransfer $customerAccessTransfer
    ): CustomerAccessTransfer {
        return $customerAccessTransfer->addContentTypeAccess(
            (new ContentTypeAccessTransfer())->fromArray($customerAccessEntity->toArray(), true),
        );
    }
}
