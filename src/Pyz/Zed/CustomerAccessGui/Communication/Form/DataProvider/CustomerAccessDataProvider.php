<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccessGui\Communication\Form\DataProvider;

use ArrayObject;
use Generated\Shared\Transfer\ContentTypeAccessTransfer;
use Generated\Shared\Transfer\CustomerAccessTransfer;
use Pyz\Zed\CustomerAccessGui\Communication\Form\CustomerAccessForm;
use Spryker\Zed\CustomerAccessGui\Communication\Form\DataProvider\CustomerAccessDataProvider as SprykerCustomerAccessDataProvider;

/**
 * @property \Pyz\Zed\CustomerAccess\Business\CustomerAccessFacadeInterface $customerAccessFacade
 */
class CustomerAccessDataProvider extends SprykerCustomerAccessDataProvider
{
   /**
    * @return array<string, mixed>
    */
    public function getOptions(): array
    {
        $allContentTypes = $this->customerAccessFacade->getAllContentTypes();
        $nonManageableContentTypes = $this->customerAccessFacade->filterNonManageableContentTypes($allContentTypes)->getContentTypeAccess();

        return [
            'data_class' => CustomerAccessTransfer::class,
            CustomerAccessForm::OPTION_CONTENT_TYPE_ACCESS_MANAGEABLE
            => $this->customerAccessFacade->filterManageableContentTypes($allContentTypes)->getContentTypeAccess(),
            CustomerAccessForm::OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE
            => $nonManageableContentTypes,
            CustomerAccessForm::OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE_DATA
            => $this->filterContentTypesData($nonManageableContentTypes),
        ];
    }

    /**
     * @param \ArrayObject<array-key, \Generated\Shared\Transfer\ContentTypeAccessTransfer> $contentTypes
     *
     * @return array<\Generated\Shared\Transfer\ContentTypeAccessTransfer>
     */
    protected function filterContentTypesData(ArrayObject $contentTypes): array
    {
        return array_filter(
            $contentTypes->getArrayCopy(),
            function (ContentTypeAccessTransfer $entity) {
                return $entity->getIsRestricted();
            },
        );
    }
}
