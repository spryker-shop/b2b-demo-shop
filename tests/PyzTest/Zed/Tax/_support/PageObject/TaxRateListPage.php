<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Zed\Tax\PageObject;

class TaxRateListPage
{
    /**
     * @var string
     */
    public const URL = '/tax/rate/list';

    /**
     * @var string
     */
    public const SELECTOR_DATA_TABLE = '.dataTables_wrapper';

    /**
     * @var string
     */
    public const SELECTOR_SEARCH = 'input.form-control.input-sm';

    /**
     * @var string
     */
    public const SELECTOR_DELETE = 'Delete';

    /**
     * @var string
     */
    public const SELECTOR_EDIT = 'i.fa.fa-pencil-square-o';

    /**
     * @var string
     */
    public const MESSAGE_EMPTY_TABLE = 'No matching records found';
}
