<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Zed\CmsGui\PageObject;

class CmsListPage
{
    /**
     * @var string
     */
    public const URL = '/cms-gui/list-page';

    /**
     * @var string
     */
    public const PAGE_LIST_TABLE_XPATH = '//*[@class="dataTables_scrollBody"]/table/tbody/tr[1]/td[1]';
}
