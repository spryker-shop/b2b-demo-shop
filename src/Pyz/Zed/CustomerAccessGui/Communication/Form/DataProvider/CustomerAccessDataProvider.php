<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccessGui\Communication\Form\DataProvider;

use ArrayObject;
use Generated\Shared\Transfer\ContentTypeAccessTransfer;
use Generated\Shared\Transfer\CustomerAccessTransfer;
use Pyz\Zed\CustomerAccess\Business\CustomerAccessFacadeInterface;
use Pyz\Zed\CustomerAccessGui\Communication\Form\CustomerAccessForm;

class CustomerAccessDataProvider
{
    /**
     * @var \Pyz\Zed\CustomerAccess\Business\CustomerAccessFacadeInterface
     */
    protected $customerAccessFacade;

    /**
     * @param \Pyz\Zed\CustomerAccess\Business\CustomerAccessFacadeInterface $customerAccessFacade
     */
    public function __construct(
        CustomerAccessFacadeInterface $customerAccessFacade,
    ) {
        $this->customerAccessFacade = $customerAccessFacade;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        $allContentTypes = $this->customerAccessFacade->getAllContentTypes();
        $nonManageableContentTypes = $this->customerAccessFacade->filterPyzNonManageableContentTypes($allContentTypes)->getContentTypeAccess();

        return [
            'data_class' => CustomerAccessTransfer::class,
            CustomerAccessForm::PYZ_OPTION_CONTENT_TYPE_ACCESS_MANAGEABLE
                => $this->customerAccessFacade->filterPyzManageableContentTypes($allContentTypes)->getContentTypeAccess(),
            CustomerAccessForm::PYZ_OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE
                => $nonManageableContentTypes,
            CustomerAccessForm::PYZ_OPTION_CONTENT_TYPE_ACCESS_NON_MANAGEABLE_DATA
                => $this->filterPyzContentTypesData($nonManageableContentTypes),
        ];
    }

    /**
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function getData(): CustomerAccessTransfer
    {
        return $this->customerAccessFacade->getRestrictedContentTypes();
    }

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\ContentTypeAccessTransfer> $contentTypes
     *
     * @return array<\Generated\Shared\Transfer\ContentTypeAccessTransfer>
     */
    protected function filterPyzContentTypesData(ArrayObject $contentTypes): array
    {
        return array_filter(
            $contentTypes->getArrayCopy(),
            function (ContentTypeAccessTransfer $entity) {
                return $entity->getIsRestricted();
            },
        );
    }
}
