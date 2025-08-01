<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\Model\Locale\Repository;

use Orm\Zed\Locale\Persistence\Map\SpyLocaleTableMap;
use Orm\Zed\Locale\Persistence\SpyLocaleQuery;

class LocaleRepository implements LocaleRepositoryInterface
{
    /**
     * @var array<string, int>
     */
    protected static $localeMap;

    /**
     * @param string $locale
     *
     * @return int
     */
    public function getIdLocaleByLocale(string $locale): int
    {
        if (!static::$localeMap) {
            $this->loadLocaleMap();
        }

        return static::$localeMap[$locale];
    }

    /**
     * @return void
     */
    private function loadLocaleMap(): void
    {
        /** @var array<array<string, mixed>> $localeCollection */
        $localeCollection = SpyLocaleQuery::create()
            ->select([SpyLocaleTableMap::COL_ID_LOCALE, SpyLocaleTableMap::COL_LOCALE_NAME])
            ->find();

        foreach ($localeCollection as $locale) {
            static::$localeMap[(string)$locale[SpyLocaleTableMap::COL_LOCALE_NAME]] = $locale[SpyLocaleTableMap::COL_ID_LOCALE];
        }
    }
}
