<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Zed\NavigationGui\PageObject;

class NavigationPage
{
    /**
     * @var string
     */
    public const URL = '/navigation-gui';

    /**
     * @var string
     */
    public const PAGE_LIST_TABLE_XPATH = '//*[@class="dataTables_scrollBody"]/table/tbody/tr[1]/td[1]';

    /**
     * @var string
     */
    public const URL_EN_CREATE_NAVIGATION_CATEGORY = '/en/stationery/paper';

    /**
     * @var string
     */
    public const URL_DE_CREATE_NAVIGATION_CATEGORY = '/de/bürobedarf/papier';

    /**
     * @var string
     */
    public const MESSAGE_SUCCESS_NAVIGATION_TREE_UPDATED = 'Navigation tree updated successfully.';
}
