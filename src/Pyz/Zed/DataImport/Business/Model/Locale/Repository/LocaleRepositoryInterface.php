<?php



declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\Model\Locale\Repository;

interface LocaleRepositoryInterface
{
    /**
     * @param string $locale
     *
     * @return int
     */
    public function getIdLocaleByLocale(string $locale): int;
}
