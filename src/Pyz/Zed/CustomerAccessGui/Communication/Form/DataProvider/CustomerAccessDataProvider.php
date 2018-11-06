<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccessGui\Communication\Form\DataProvider;

use Generated\Shared\Transfer\CustomerAccessTransfer;
use Pyz\Zed\CustomerAccessGui\Communication\Form\CustomerAccessForm;
use Spryker\Zed\CustomerAccessGui\Communication\Form\DataProvider\CustomerAccessDataProvider as SprykerCustomerAccessDataProvider;

class CustomerAccessDataProvider extends SprykerCustomerAccessDataProvider
{
    /**
     * @var \Pyz\Zed\CustomerAccess\Business\CustomerAccessFacadeInterface
     */
    protected $customerAccessFacade;

    /**
     * @return array
     */
    public function getOptions(): array
    {
        $allContentTypes = $this->customerAccessFacade->getAllContentTypes();

        return [
            'data_class' => CustomerAccessTransfer::class,
            CustomerAccessForm::OPTION_CONTENT_TYPE_ACCESS_MANAGEABLE
                => $this->customerAccessFacade->filterManageableContentTypes($allContentTypes)->getContentTypeAccess(),
        ];
    }
}
